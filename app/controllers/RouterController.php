<?php

namespace App;  

use App\Route;

/**
 * RouteController
**/
class RouterController {

    private $url;
    private $routes = [];

    public function __construct($url) {
        $this->url = $url;
    }

    public function get($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function post($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function run() {
        
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            echo 'REQUEST_METHOD does not exist';
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->match($this->url)){
                return $route->call();  
            }
        }

        // $view = new View("/../views/common/404.php", []);
        // $view->render();
    }

}