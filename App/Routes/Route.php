<?php
    namespace App\Routes;

    class Route{
        protected $routes = [];

        public function get($url, $callback, $middleware = []){
            return $this->routes['GET'][$url] = ['callback' => $callback, 'middleware' => $middleware];
        }

        public function post($url, $callback, $middleware = []){
            return $this->routes['POST'][$url] = ['callback' => $callback, 'middleware' => $middleware];
        }

        public function dispatch(){
            if(empty($_GET['url'])){
                return redirect('/home');
            }
            $path = '/' . trim($_GET['url'], '/');
            $method = $_SERVER['REQUEST_METHOD'];

            foreach($this->routes[$method] as $route => $datas){
                
                if($path == $route){

                    foreach($datas['middleware'] as $mw){
                        $class = 'Middleware\\' . ucfirst($mw) . 'Middleware';
                        $class::handling();
                    }
                    return call_user_func($datas['callback']);
                }
            }

            echo "<h3> Error 404, Page Not Found";
            exit;
        }
    }