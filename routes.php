<?php
    require 'autoload.php';
    use App\Routes\Route;
    use App\Databases\Seeders\UsersSeeder;

    $route = new Route();
    
    $route->get('/home', function(){
        echo 'halo';die;
    });

    $route->get('/seeder-user', [new UsersSeeder, 'index']);
    $route->dispatch();
    