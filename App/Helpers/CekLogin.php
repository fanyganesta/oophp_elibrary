<?php
    session_start();
    function CekLogin($role){
        if(!isset($_SESSION['user'])){
            return false;
        }elseif($_SESSION['user']['role'] == $role){
            return true;
        }
    }