<?php 
    // Redirect('/path);
    function redirect($url){
        $url = trim($url, '/');
        if(empty(explode('?', $url)[0])){
            header("Location: /$url");
            exit;
        }else{
            header("Location: /oophp_elibrary/$url");
            exit;
        }
    }