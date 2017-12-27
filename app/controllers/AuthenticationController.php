<?php

namespace App;

use App\View;
use App\ValidatorController;
use App\QueriesController;

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
        $validator->isEmail('email', "Veuillez remplir le champ email");     
        $validator->existsField('email', "Veuillez remplir le champ email");

        if ($validator->isValid())
        {
            $q = new QueriesController();
            $res = $q->login($_POST['email'], $_POST['code']);

            if ($res['error'] == false) {
                echo "SUPER !";                 
            }
            else {
                $view = new View(__DIR__ . "/../views/login/login.view.php", ['errors' => $res['message']]);
                $view->render();
            }
        }
        else 
        {
            $errorMsg = $validator->getErrors();
            $view = new View(__DIR__ . "/../views/login/login.view.php", ['errors' => $errorMsg ]);
            $view->render();
        }

    }
}