<?php

namespace App;  

use App\Route;

/**
 * Cette classe a pour but de gérer l'éxécution d'un certain code suivant l'URL qui est tapée par l'utilisateur
**/
class RouterController {

    private $url;   // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = [];   // Contiendra la liste des routes


    public function __construct($url) {
        $this->url = $url;
    }

    // Création des fonctions correspondantes aux différentes méthodes HTTP (GET, POST) 
    
    //get: Cette méthode prend deux paramètres -> L'URL à capturer, et a méthode à appeller lorsque cette URL est capturé 

    public function get($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route; 
    }

    //post: Cette méthode prend deux paramètres -> L'URL à capturer, et a méthode à appeller lorsque cette URL est capturé 
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

    }

}