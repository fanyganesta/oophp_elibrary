<?php
    require 'autoload.php';
    use App\Routes\Route;
    use App\Controllers\UserController;

    $route = new Route();
    
    $route->get('/home',[new UserController, 'getLogin']);
    $route->get('/seeder-user', [new UserController, 'seeder']);
    $route->get('/drop-users', [new UserController, 'drop']);
    $route->get('/login', [new UserController, 'getLogin']);
    $route->post('/login', [new UserController, 'login']);
    $route->get('/logout', [new UserController, 'logout']);
    $route->get('/register', [new UserController, 'getRegister']);
    $route->post('/register', [new UserController, 'register']);



    $route->dispatch();
    