<?php

namespace App;

/**
 * La classe Route va représenter une route et permettra d'ajouter des URLs à capturer.
 * 
**/
class Route {

    /**
     * création des variables:path représente le chemin(l'url), callable represente la méthode a appelé lorsque le path est capturé
     */
    private $path;
    private $callable;
    private $matches = []; 

    public function __construct($path, $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    //la méthode match($url) permet de s'avoir si la route valide l'URL.

    public function match($url) {

        // permet d'enlever les "/" de debut et de fin de l'url:
        $url = trim($url, '/'); 

        //ligne 34 à l35: va permettre de remplacer le parametre de l'url (ex admin/:id -> id est un paramètre) par une expression régulière s'il y en a:


        //remplace tout les caratère de type ":([\w]+)"(=:caractère alphanumérique répété plusieurs fois) par "([^/]+)"(= tout sauf un slash) rencontrer dans le path
        $path = preg_replace('#:([\w]+)#', '([^/]+)' , $this->path); 

        // expression régulière qui correspond e tout notre path en prenant en compte les majuscules
        $regex = "#^$path$#i";

        //reg_match($regex, $url, $matches) -> Analyse l'url pour trouver l'expression qui correspond à regex. Ces matchs seront stocké dans $matches
        if (!preg_match($regex, $url, $matches)){
            return false;
        }

        //s'il y a des matchs on retire le première element du tableau qui va correspondre à l'url 
        array_shift($matches);

        $this->matches = $matches;
        return true;
    }

    // permet d'appeler le callable avec les paramètres matches
    public function call() {
        $fct = __NAMESPACE__ . $this->callable;
        return call_user_func_array($fct, $this->matches);
    }

}