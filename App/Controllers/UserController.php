<?php 
    namespace App\Controllers;
    use App\Databases\Database;
    use App\Databases\Seeders\UsersSeeder;

    class UserController{
        protected $conn,$seeder;

        public function __CONSTRUCT(){
            $this->conn = Database::getInstance();
            $this->seeder = UsersSeeder::getInstance();
        }

        public function index(){
            
        }

        public function seeder(){
            $this->seeder->insert();
        }

        public function drop(){
            $this->seeder->dropTable();
        }

        public function getLogin(){
            return view('Users/login');
        }

        public function login(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rememberme = $_POST['rememberme'] ?? null;

            //cari username
            $sql = "SELECT * FROM users WHERE username = ?";
            $result = $this->conn->getOne($sql, [$username]);

            if(!$result){
                return redirect('/login?error=Username atau Password salah!');
            }

            $dbPassword = $result['password'];

            if(!password_verify($password, $dbPassword)){
                return redirect('/login?error=Username atau Password salah!');
            }

            if($rememberme != null){
                setcookie('key', $result['ID'], time()+3600);
                setcookie('token', $result['password'], time()+3600);
            }

            session_start();
            $_SESSION['user'] = $result;

            if(isset($_SESSION['user'])){
                // return redirect('/library?message=Selamat Datang');
                echo "berhasil login";die;
            }else{
                return redirect('/login?error=Gagal login. Coba lagi atau hubungi admin!');
            }
        }

        public function logout(){
            session_start();
            $_SESSION['user'] = '';
            session_destroy();

            setcookie('key', '', time()-3600);
            setcookie('token', '', time()-3600);
            return redirect('/login?message=Berhasil logout!');
        }

        public function getRegister(){
            return view('/Users/register');
        }

        public function register(){
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $role = htmlspecialchars($_POST['role']);

            $sql = "SELECT * FROM users WHERE username = ?";
            $datas = [$username];
            $registered = $this->conn->getOne($sql, $datas) ?? null;

            if($password != $confirmPassword){
                return redirect('/register?error=Password dan Konfirmasi Password tidak sama!');
            }elseif(!empty($registered)){
                return redirect('/register?error=Username sudah pernah digunakan');
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO users (username, email, role, password) VALUES(?, ?, ?, ?)";
            $datas = [$username, $email, $role, $password];

            $result = $this->conn->run($insert, $datas);

            if($result){
                return redirect('/login?message=Berhasil mendaftar!');
            }else{
                return redirect('/login?error=Gagal mendaftar, hubungi admin!');
            }
        }
    }