<?php
    namespace App\Databases;

    class Database{
        private static $conn, $instance = [];

        public function __CONSTRUCT(){
            $host = 'localhost';
            $dbName = 'oophp_elibrary';
            $charset = 'utf8mb4';
            $username = 'root';
            $password = '';

            $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
            $option = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            ];

            self::$conn = new \PDO($dsn, $username, $password, $option);

        }

        public static function getInstance(){
            if(empty(self::$instance)){
                self::$instance = new Database();
            }
            return self::$instance;
        }

        public function run($sql, $datas = []){
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($datas);
            return $stmt;
        }

        public function getOne($sql, $datas = []){
            return $this->run($sql, $datas)->fetch();
        }

        public function getAll($sql, $datas = []){
            return $this->run($sql, $datas)->fetchAll();
        }

        public function fileProcessing($datas){
            $fileName = $datas['name'];
            $tmp_name = $datas['tmp_name'];
            $fileSize = $datas['size'];

            $arrName = explode('.', $fileName);
            $name = $arrName[0];
            $ext = end($arrName);

            if(strtolower($ext) != 'webp'){
                return redirect('/library?error=File tidak diperbolehkan!');
            }elseif($fileSize >= 100000){
                return redirect('/library?error=Ukuran gambar terlalu besar');
            }

            $newName = time().'-'.uniqid($name).$ext;
            move_uploaded_file($tmp_name, 'App/Components/img/'.$newName);

            return $newName;
        }
    }