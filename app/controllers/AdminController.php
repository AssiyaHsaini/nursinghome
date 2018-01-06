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
            $tasks = $query->getTasks();
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

        $q = new QueriesController();
        $data;


        if ($_POST['postMethod'] == "delete")
        {
            //echo "delete ".$_POST['personId'];
            $q->deleteNursing($_POST['personId']);
            $nursings = $q->getNursings();
            //$view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings]);
            $data = ['nursings' => $nursings];
            
        }

        if ($_POST['postMethod'] == "create")
        {
            $validator = new ValidatorController($_POST);
            $validator->isNotEmpty('lastname', "Veuillez remplir le champ");
            $validator->isNotEmpty('firstname', "Veuillez remplir le champ");
            $validator->isEmail('email', "Veuillez remplir le champ email");     
            $validator->isNotEmpty('role', "Veuillez remplir le champ email");

    
            if ($validator->isValid())
            {
                $person= new Person($_POST['lastname'],$_POST['firstname'],$_POST['role'],$_POST['email']);
                $res = $q->addNursing($person);
                $nursings = $q->getNursings();     

                if ($res==false)
                {
                    //$view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings]);
                    $data = ['nursings' => $nursings];
                    
                }
                else 
                {
                    //$view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings, "errors" => "L'ajout a échoué"]);
                    $data =['nursings' => $nursings, "errors" => "L'ajout a échoué"];
                }
                
            }
            else {
                $nursings = $q->getNursings();
                $data = ['errors'=>$validator->getErrors(), 'nursings' => $nursings];
                
            }
        }
        $view = new View(__DIR__ . "/../views/admin/nursings.view.php", $data);
        $view->render();


    }

    static function tasksAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();
        $nursings = $q->getNursings();
        $nursingsw = $q->getNursingsWithTask();
        $allTasks= $q->getAllTasks();
        $allRooms=$q->getAllRooms();
        $tasks = [];

        foreach ($nursingsw as $nurse)
        {
            $tasks[$nurse['id']] = $q->getTasksNursing($nurse['id']);
        }


        
        $view = new View(__DIR__ . "/../views/admin/tasks.view.php", ['nursingsw' => $nursingsw, 'tasks' => $tasks, 'allTasks' => $allTasks, 'rooms' => $allRooms, 'nursings' => $nursings]);
        $view->render();
    }
    

    /*static function tasksAction()
    {
        $q = new QueriesController();
        $nursingsw = $q->getNursingsWithTask();
        $view = new View(__DIR__ . "/../views/admin/tasks.view.php", ['nursingsw' => $nursingsw]);
        $view->render();

        
        
    }*/

    static function tasksPostsAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();

        //var_dump($_POST);
        //die();
        if ($_POST['postMethod'] == "add")
        {
             $q->addTask($_POST['personId'],$_POST['rooms'],$_POST['tasks'],$_POST['date']);
             self::tasksAction();
        }
        if ($_POST['postMethod'] == "delete")
        {
            $q->deleteTask($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
            self::tasksAction();
        }


    }

        
    static function validerPostsAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();
        $date =  $q->getDaysExpiration($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
        //var_dump($date);
        //die();
        if ($date<0) 
        {
            $tasks = $q->getTasks();
            $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, "errors" => "Le delai de cette tache est expiré"]); 
        }
        else {
            $q->validerTask($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
            $tasks = $q->getTasks();
            $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, "message" => "Tâche faite"]); 
        }
        $view->render();
    }


    static function didAction()
    {
        ValidatorController::checkSession();
         $q = new QueriesController();
         $tasks= $q->getTasksNotDid();
         $view = new View(__DIR__ . "/../views/admin/tasksNotDid.view.php", ['tasks' => $tasks]);
         $view->render();
        
    }

    static function resetAction()
    {
          ValidatorController::checkSession();
         $view = new View(__DIR__ . "/../views/admin/reset.view.php", []);
         $view->render();
                 
    }

    static function resetPostsAction()
    {
         ValidatorController::checkSession();
         $q = new QueriesController();
         $q->reset();
         $tab["message"]= "Toutes les tâches ont été effacés";
         $tab["error"]= 0;
         echo json_encode ($tab);
    }

}