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

         
    }