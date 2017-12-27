<?php

namespace App;

use App\View;
use App\ValidatorController;

class AuthenticationController {

    public static $error;
    public static $message;

    static function indexAction(){
        
        $view = new View(__DIR__ . "/../views/login/login.view.php", []);
        $view->render();
    }

    static function indexPostAction(){

        $validator = new ValidatorController($_POST);
        $validator->existsField('code', "Veuillez remplir le champ");
        $validator->isNotEmpty('code', "Veuillez remplir le champ");

        if ($validator->isValid())
        {
            // pdo.... session... redirection vers une autre page...
            echo "SUPER !"; 
        }
        else 
        {
            $errorMsg = $validator->getErrors();
            $view = new View(__DIR__ . "/../views/login/login.view.php", ['errors' => $errorMsg ]);
            $view->render();
        }

    }
}