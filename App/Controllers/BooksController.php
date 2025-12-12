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

            $all = "SELECT * FROM books";
            $countAll = count(self::$db->getAll($all));

            $index = $halamanAktif * $limit - $limit;
            $sql = $all . " WHERE judul LIKE ? OR penerbit LIKE ? OR tahunTerbit LIKE ? OR rating LIKE ? LIMIT $index, $limit";

            $cari = (isset($_GET['cari'])) ? '%'.$_GET['cari'].'%' : '%%';
            $datas = [$cari, $cari, $cari, $cari];
            $rows = self::$db->getAll($sql, $datas);

            return view('Library/index', compact('rows'));
        }
    }