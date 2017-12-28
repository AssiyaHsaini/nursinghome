<?php

namespace App;

use App\View;
use App\ValidatorController;
use App\QueriesController;
use App\Person;


class AdminController {

    public static $error;
    public static $message;

    static function indexAction(){

        ValidatorController::checkSession();

        if ($_SESSION['role']==0){
           $view = new View(__DIR__ . "/../views/admin/cadreSante.view.php", []);            
        }
        else {
            $query = new QueriesController(); 
            $tasks = $query->getTasks()->fetchAll();
            $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks]);            
        }
        $view->render();
    }

    static function nursingsAction()
    {
        ValidatorController::checkSession();
        $query = new QueriesController(); 
        $nursings = $query->getNursings();
        $view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings]);
        $view->render();
    }

    static function nursingsPostsAction(){

        if ($_POST['postMethod'] == "delete")
            echo "delete ".$_POST['personId'];
        if ($_POST['postMethod'] == "create")
        {
            $validator = new ValidatorController($_POST);
            $validator->isNotEmpty('lastname', "Veuillez remplir le champ");
            $validator->isNotEmpty('firstname', "Veuillez remplir le champ");
            $validator->isEmail('email', "Veuillez remplir le champ email");     
            $validator->isNotEmpty('role', "Veuillez remplir le champ email");

            $q = new QueriesController();

            if ($validator->isValid())
            {
                $person= new Person($_POST['lastname'],$_POST['firstname'],$_POST['role'],$_POST['email']);
                $res = $q->addNursing($person);
                $nursings = $q->getNursings();

                if ($res==false)
                {
                    $view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings]);
                    $view->render();
                }
                else 
                {
                    $view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings, "errors" => "L'ajout a échoué"]);
                    $view->render();

                }
                
            }
        }


    }





}