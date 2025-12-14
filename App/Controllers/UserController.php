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
            $sql = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ? OR role LIKE ?";

            $cari = (isset($_GET['cari'])) ? '%' . $_GET['cari'] . '%' : '%%';
            $datas = [$cari, $cari, $cari];

            $all = $this->conn->getAll($sql, $datas);
            $allData = count($all);

            $limit = 5;
            $jumlahHalaman = ceil($allData / $limit);

            if(!isset($_GET['halaman']) || $_GET['halaman'] < 1){
                $halamanAktif = 1;
            }else{
                $halamanAktif = $_GET['halaman'];
            }

            $index = $halamanAktif * $limit - $limit;
            $withLimit = $sql." LIMIT $index, $limit";

            $rows = $this->conn->getAll($withLimit, $datas);

            return view('Users/index', compact('rows', 'jumlahHalaman', 'halamanAktif'));
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
                return redirect('/library?message=Selamat Datang');
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
                session_start();
                if(isset($_SESSION['user'])){
                    return redirect('/user-list?message=User baru berhasil ditambah');
                }
                return redirect('/login?message=Berhasil mendaftar! Silahkan login');
            }else{
                return redirect('/login?error=Gagal mendaftar, hubungi admin!');
            }
        }

        public function delete(){
            $ID = $_GET['ID'];
            $sql = "DELETE FROM users WHERE ID = ?";
            $data = [$ID];

            $result = $this->conn->run($sql, $data);
            if($result){
                return redirect('/user-list?message=Data berhasil dihapus!');
            }else{
                return redirect('/user-list?error=Data gagal dihapus!');
            }
        }

        public function getEdit(){
            $ID = $_GET['ID'];
            $sql = "SELECT * FROM users WHERE ID = ?";
            $data = [$ID];

            $row = $this->conn->getOne($sql, $data);
            if($row){
                return view('Users/edit', compact('row'));
            }else{
                return redirect('/user-list?error=Data tidak ditemukan');
            }
        }

        public function edit(){
            $ID = $_POST['ID'];
            $oldPassword = $_POST['oldPassword'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $newPassword = (isset($_POST['newPassword']) ? $_POST['newPassword'] : null);
            $confirmPassword = (isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : null);

            if($newPassword != null){
                if($newPassword != $confirmPassword){
                    return redirect('/edit-user?error=Password baru dan Konfirmasi Password tidak sama');
                }else{
                    $password = password_hash($newPassword, PASSWORD_DEFAULT);
                }
            }else{
                $password = $oldPassword;
            }

            $sql = "UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE ID = ?";
            $datas = [$username, $email, $role, $password, $ID];
            $result = $this->conn->run($sql, $datas);
            if($result){
                return redirect("/user-edit?ID={$ID}&message=Data berhasil diupdate!'");
            }else{
                return redirect("/user-edit?ID={$ID}&error=Gagal update user!");
            }
        }
    }