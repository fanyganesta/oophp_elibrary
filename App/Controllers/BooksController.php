<?php 
    namespace App\Controllers;
    use App\Databases\Database;

    class BooksController{
        public static $db;

        public function __CONSTRUCT(){
            if(self::$db == null){
                self::$db = Database::getInstance();
            }
        }

        public function index(){
            $limit = 10;
            if(!isset($_GET['halaman']) || $_GET['halaman'] < 1){
                $halamanAktif = 1;
            }else{
                $halamanAktif = $_GET['halaman'];
            }

            
            $index = $halamanAktif * $limit - $limit;
            $all = "SELECT * FROM books WHERE judul LIKE ? OR penerbit LIKE ? OR tahunTerbit LIKE ? OR rating LIKE ?";

            $cari = (isset($_GET['cari'])) ? '%'.$_GET['cari'].'%' : '%%';
            $datas = [$cari, $cari, $cari, $cari];

            $countAll = count(self::$db->getAll($all, $datas));

            $jumlahHalaman = ceil($countAll/$limit);

            $sql = $all . " LIMIT $index, $limit";
            $rows = self::$db->getAll($sql, $datas);

            return view('Library/index', compact('rows', 'halamanAktif', 'jumlahHalaman'));
        }

        public function getEdit(){
            $sql = "SELECT * FROM books WHERE ID = ?";
            $ID = $_GET['ID'];
            $datas = [$ID];
            $row = self::$db->getOne($sql, $datas);
            return view('Library/edit', compact('row'));
        }

        public function edit(){
            $judul = $_POST['judul'];
            $penerbit = $_POST['penerbit'];
            $tahunTerbit = $_POST['tahunTerbit'];
            $rating = $_POST['rating'];
            $ID = $_POST['ID'];
            if($_FILES['cover']['error'] == 4 && $_POST['oldImage'] == ''){
                $foto = null;
            } elseif($_FILES['cover']['error'] == 4){
                $foto = $_POST['oldImage'];
            }else{
                $foto = self::$db->fileProcessing($_FILES['cover']);
            }

            $sql = "UPDATE books SET judul = ?, penerbit = ?, tahunTerbit = ?, rating = ?, foto = ? WHERE ID = ?";
            $datas = [$judul, $penerbit, $tahunTerbit, $rating, $foto, $ID];
            $result = self::$db->run($sql, $datas);
            if($result){
                return redirect("/library-edit?message=Data berhasil di-Update&ID=$ID");
            }else{
                return redirect("/library-edit?error=Gagal update data!&ID=$ID");
            }
        }

        public function delete(){
            $ID = $_GET['ID'];
            $sql = "DELETE FROM books WHERE ID = ?";
            $result = self::$db->run($sql, [$ID]);
            if($result){
                return redirect('/library?message=Data berhasil dihapus!');
            }else{
                return redirect('/lirary?error=Gagal menghapus data');
            }
        }

        public function getTambah(){
            return view('Library/tambah');
        }

        public function tambah(){
            $judul = htmlspecialchars($_POST['judul']);
            $penerbit = htmlspecialchars($_POST['penerbit']);
            $tahunTerbit = htmlspecialchars($_POST['tahunTerbit']);
            $rating = htmlspecialchars($_POST['rating']);
            $foto = self::$db->fileProcessing($_FILES['cover']);

            $sql = "INSERT INTO books (judul, penerbit, tahunTerbit, rating, foto) VALUES (?, ?, ?, ?, ?)";
            $datas = [$judul, $penerbit, $tahunTerbit, $rating, $foto];
            $return = self::$db->run($sql, $datas);
            if($return){
                return redirect('/library?message=Data berhasil ditambahkan!');
            }else{
                return redirect('/library?error=Gagal menambah data!');
            }
        }
    }