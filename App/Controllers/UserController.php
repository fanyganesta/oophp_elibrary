<?php 
    namespace Controllers;
    use Databases\Database;

    class UserController{
        protected $conn;

        public function __CONSTRUCT(){
            $this->conn = Database::getInstance();
        }

        public function index(){
            $sql = "SELECT * FROM users";
            var_dump($this->conn);die;
            // $this->conn->run($sql, $datas);

        }
    }