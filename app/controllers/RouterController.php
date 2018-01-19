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

    
    //Afin d'améliorer les performances lors du matching on groupera les routes par méthodes afin de ne pas parcourir
    // tout le tableau lors du parcours des URLs.
    // Création des fonctions correspondantes aux différentes méthodes HTTP (GET, POST) 



    //get: Cette méthode prend deux paramètres -> L'URL à capturer, et a méthode à appeller lorsque cette URL est capturé 
    public function get($path, $callable) {
        $route = new Route($path, $callable); // Appel de la classe Route qui sert à instancier une route.
        $this->routes['GET'][] = $route; // On insère "route" dans le tableau "routes" 
    }

    //post: idem
    public function post($path, $callable) {
        $route = new Route($path, $callable); 
        $this->routes['POST'][] = $route; 
    }


    //Cette fonction va parcourir les différentes routes préalablement enregistrées et 
    //vérifier si la route correspond à l'URL qui est passé au contructeur, ceci gràce à la fonction match() de notre classe Route

    public function run() {
        
        // on verifie si notre tableau à l'index "REQUEST_METHOD"(=> Méthode de requête utilisée pour accéder à la page )est vide. 
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) { 
            echo 'REQUEST_METHOD does not exist';
        }

        // sinon on parcours notre tableau afin de vérifier si notre url match avec une url de notre tableau.
        //si une des routes du tableau match avec l'url courante alors on appelle la méthode call de la classe route.
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->match($this->url)){
                return $route->call();  
            }
        }

    }

}