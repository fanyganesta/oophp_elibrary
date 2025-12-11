<?php
    require 'autoload.php';
    use App\Routes\Route;

    $route = new Route();
    
    $route->get('/home', function(){
        echo 'halo';die;
    });
    $route->dispatch();
    