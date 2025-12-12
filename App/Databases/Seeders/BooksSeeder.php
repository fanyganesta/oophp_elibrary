<?php
    namespace App\Databases\Seeders;
    use App\Databases\Database;

    class BooksSeeder{
        private $conn;

        public function __CONSTRUCT(){
            $this->conn = Database::getInstance();
        }

        public function seeder(){
            $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'oophp_elibrary' AND table_name = 'books'";
            $result = $this->conn->getOne($sql);

            if(empty($result)){
                $createTbl = "CREATE TABLE books (
                ID INT PRIMARY KEY AUTO_INCREMENT,
                judul VARCHAR(100),
                penerbit VARCHAR(100),
                tahunTerbit VARCHAR(100),
                rating VARCHAR(100),
                foto VARCHAR(255)
                )";
            
                $result = $this->conn->run($createTbl);
                if(!$result){
                    return redirect('/login?error=Gagal membuat table');
                }
            }

            $books = [];
            for($i = 1; $i <= 15; $i++){
                $books[] = "('', 'buku ke-$i', 'penerbit $i', '199$i', '4.$i', '')";
            }

            for($i = 0; $i < 15; $i++){
                if($i != 14){

                   $books[$i] = $books[$i] . ',';
                }
            }

            $sql = "INSERT INTO books VALUES";

            foreach($books as $book){
                $sql = $sql . $book;
            }

            $result = $this->conn->run($sql.';');
            if($result){
                return redirect('/login?message=Data berhasil ditambah!');
            }else{
                return redirect('/login?error=Gagal datambah data!');
            }
        }
    }