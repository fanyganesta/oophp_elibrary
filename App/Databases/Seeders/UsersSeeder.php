<?php 
    namespace App\Databases\Seeders;
    use App\Databases\Database;

    class UsersSeeder{
        private static $db, $instance = [];
        
        public function __CONSTRUCT(){
            self::$db = Database::getInstance();
        }

        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new UsersSeeder;
            }
            return self::$instance;
        }

        public function insert(){
            $table = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'oophp_elibrary' AND table_name = 'users'";
            $result = self::$db->getOne($table);

            if(!$result){
                $createTbl = "CREATE TABLE users (
                ID INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(100),
                email VARCHAR(100),
                role VARCHAR(100),
                password VARCHAR(255)
                )";

                $result = self::$db->run($createTbl);
            }

            $password = password_hash('123', PASSWORD_DEFAULT);

            $users = "INSERT INTO users VALUES
            ('', 'admin1', 'admin1@gmail.com', 'admin', '$password'),
            ('', 'admin2', 'admin2@gmail.com', 'admin', '$password'),
            ('', 'admin3', 'admin3@gmail.com', 'admin', '$password'),
            ('', 'admin4', 'admin4@gmail.com', 'admin', '$password'),
            ('', 'admin5', 'admin5@gmail.com', 'admin', '$password'),
            ('', 'guest1', 'guest1@gmail.com', 'guest', '$password'),
            ('', 'guest2', 'guest2@gmail.com', 'guest', '$password'),
            ('', 'guest3', 'guest3@gmail.com', 'guest', '$password'),
            ('', 'guest4', 'guest4@gmail.com', 'guest', '$password'),
            ('', 'guest5', 'guest5@gmail.com', 'guest', '$password')
            ";

            $result = self::$db->run($users);
            if($result){
                return redirect('/home?message=Berhasil tambah data!');
            }else{
                return redirect('/home?error=Gagal tambah data');
            }

        }

        public function dropTable(){
            $sql = "DROP TABLE users";
            $result = self::$db->run($sql);
            if($result){
                return redirect('/home?message=Berhasil drop table users');
            }else{
                return redirec('/home?error=Gagal drop table users');
            }
        }
    }
