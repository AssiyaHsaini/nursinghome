<?php

namespace App;

use App\View;
use App\ValidatorController;
use App\QueriesController;

/**
 * Contrôleur qui s'occupe de la connexion au site 
 */

class AuthenticationController {

    public static $error;
    public static $message;

    /*
        Fonction qui dirige l'utilisateur vers la page de connexion 
    */
    static function indexAction(){
        
        $view = new View(__DIR__ . "/../views/login/login.view.php", []);
        $view->render();
    }

    /*
        Fonction qui vérifie que les données taper dans la page de connexion sont valides 
    */
    static function indexPostAction(){

        $validator = new ValidatorController($_POST);
        $validator->existsField('code', "Veuillez remplir le champ"); 
        $validator->isNotEmpty('code', "Veuillez remplir le champ");
        $validator->isEmail('email', "Veuillez remplir le champ email");     
        $validator->existsField('email', "Veuillez remplir le champ email");


        $q = new QueriesController();

        if ($validator->isValid())
        {
            
            $res = $q->login($_POST['email'], $_POST['code']); // on verifie que l'utilisateur est bien dans notre BDD et s'il ne s'est pas tromper de code 

            if ($res['error'] == false) // s'il est bien dans notre BDD on le dirige vers la vue suivante
            {
                header("Location: /nursinghome/admin/");
            }
            else { // sinon on le renvoit vers la vue de connexion avec un message d'erreur

                $view = new View(__DIR__ . "/../views/login/login.view.php", ['errors' => $res['message']]);
                $view->render();
            }
        }
        else // si les données entrées par l'utilisateur ne sont pas valides, on le renvoit vers la vue de connexion avec un message d'erreur
        {
            $errorMsg = $validator->getErrors();
            $view = new View(__DIR__ . "/../views/login/login.view.php", ['errors' => $errorMsg ]);
            $view->render();
        }

    }

    /*
        Fonction qui permet à l'utilisateur de se déconnecter. 
    */
    static function logoutAction()
    {
        session_destroy();
        header("Location: /nursinghome/");
    }
}