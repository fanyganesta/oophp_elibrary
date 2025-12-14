<?php 
    namespace App\Middleware;

    class AdminMiddleware{
        public static function handling(){
            if($_SESSION['user']['role'] != 'admin'){
                return redirect('/library?error=Anda tidak memiliki akses!');
            }else{
                return true;
            }
        }
    }