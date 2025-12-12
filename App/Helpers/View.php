<?php 
    function view($file, $datas = []){
        if(empty($datas)){
            ob_start();
            require "App/View/" . $file . ".php";
            echo ob_get_clean();
        }else{
            ob_start();
            extract($datas);
            require "App/View/" . $file . ".php";
            echo ob_get_clean();
        }
    }