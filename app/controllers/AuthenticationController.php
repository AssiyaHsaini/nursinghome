<?php

namespace App;

use App\View;

class AuthenticationController {

    public static $error;
    public static $message;

    static function indexAction(){
        
        $view = new View(__DIR__ . "/../views/login/login.view.php", ['title' => "Page de login" ]);
        $view->render();
    }

    static function indexPostAction(){
        var_dump($_POST);
        // $view = new View(__DIR__ . "/../views/login/login.view.php", ['title' => "Page de login" ]);
        // $view->render();
    }
}