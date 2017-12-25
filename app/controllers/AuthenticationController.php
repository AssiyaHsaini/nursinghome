<?php

namespace App;

use App\View;

class AuthenticationController {

    public static $error;
    public static $message;

    static function indexAction(){
        $view = new View("/../views/login/login.view.php", ['title' => "Page de login" ]);
        $view->render();
    }
}