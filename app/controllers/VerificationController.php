<?php

namespace App;

use App\View;

class VerificationController {

    public static $error;
    public static $message;

    static function indexAction(){
        
        $code = $_POST['code'];
        echo $code;
        $view = new View(__DIR__ . "/../views/login/login.view.php", ['title' => "Page de login" ]);
        $view->render();
    }
}