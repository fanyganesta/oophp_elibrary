<?php
    spl_autoload_register(function( $class ){
        $file = str_replace('\\','/', $class) . '.php';
        if(file_exists($file)){
            require_once $file;
        }
    });

    $helpers = [
        'Redirect.php',
        'View.php',
        'Link.php'
    ];

    foreach($helpers as $helper){
        require_once "App/Helpers/" . $helper;
    }