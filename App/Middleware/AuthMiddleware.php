<?php
    namespace App\Middleware;

    class AuthMiddleware{

        public static function handling(){
            if(!isset($_SESSION['user'])){
                return redirect('/login?error=Anda harus login terlebih dahulu!');
            }else{
                return true;
            }
        }
    }