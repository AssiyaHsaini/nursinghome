<?php

namespace App;

/**
 * Route Class
**/
class Route {

    private $path;
    private $callable;
    private $matches = []; 

    public function __construct($path, $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function match($url) {

        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call() {
        $fct = __NAMESPACE__ . $this->callable;
        return call_user_func_array($fct, $this->matches);
    }

}