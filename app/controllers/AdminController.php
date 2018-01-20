<?php

namespace App;

use App\View;
use App\ValidatorController;
use App\QueriesController;
use App\Person;
use App\EmailController;


/**
 * Cette classe est un contrôleur qui s'oocupe de plusieurs tâches. 
 */
class AdminController {

    public static $error; // les erreurs 
    public static $message; // le message associé à l'erreur 


    /*
        Fonction qui vérifie le rôle de l'utilisateur lors de sa connexion
    */
    static function indexAction(){

        ValidatorController::checkSession(); // vérifie si la session est valide

        if ($_SESSION['role']==0)// si le rôle vaut "0", alors il s'agit d'une cadre santé. 
        {
           $view = new View(__DIR__ . "/../views/admin/cadreSante.view.php", []); // on dirigie l'utilisateur vers la vue principale de la cadre santé.           
        }
        else { // sinon, il s'agit d'une aide soignante.

            $query = new QueriesController(); // on crée une instance de QueriesController pour utiliser la fonction getTasks()
            $tasks = $query->getTasks(); // on stock dans $tasks les valeur retournées par cette requête. Celle-ci retourne les tâches affectées à l'aide soingnante connecté
            $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks]); // on dirigie l'utilisateur vers la vue de l'aide soignante avec le tableau $tasks (le contenue de ce tableau sera traité dans la vue)         
        }
        $view->render(); // on affiche la vue grâce a l'include.
    }


    /*
        Fonction qui permet à la cadre santé de voir la liste des aides soignates existantes 
    */
    static function nursingsAction()
    {
        ValidatorController::checkSession();
        $query = new QueriesController(); 
        $nursings = $query->getNursings(); // $nursings contient la liste des informations des aides soigantes inscrites 
        $view = new View(__DIR__ . "/../views/admin/nursings.view.php", ['nursings' => $nursings]); // on passe $nursings à la vue pour qu'elle affiche les informations
        $view->render();
    }

    /*
        Fonction qui permet à la cadre santé d'ajouter ou de supprimer des aides soignantes grâce à un formulaire
    */
    static function nursingsPostsAction(){

        $q = new QueriesController();
        $data; // tableau qui va contenir differentes données selon la situation, puis sera donné à la vue

        // deux formulaires sont presents dans la vue, un se charge de supprimer une aide soignante, l'autre d'ajouter une aide soigante

        // Ainsi, s'il s'agit du formulaire pour supprimer, on appellera la méthode "deleteNursing" de QueriesController
        if ($_POST['postMethod'] == "delete")
        {
            $q->deleteNursing($_POST['personId']); // $_POST['personId'] est récupéré a partir du formulaire
            $nursings = $q->getNursings();
            $data = ['nursings' => $nursings]; // ici $data va contenir les informations des aides soigantes inscrites 
            
        }


        // s'il s'agit du formulaire pour ajouter, on appellera la méthode "addNursing" de QueriesController
        if ($_POST['postMethod'] == "create")
        {
            $validator = new ValidatorController($_POST);
            // on verifie que les valeurs entrées par la cadre santé sont valides
            $validator->isNotEmpty('lastname', "Veuillez remplir le champ"); 
            $validator->isNotEmpty('firstname', "Veuillez remplir le champ");
            $validator->isEmail('email', "Veuillez remplir le champ email");     
            $validator->isNotEmpty('role', "Veuillez remplir le champ email");
            $validator->isUniqueEmail('email', "Veuillez changer le champ email");

            
            if ($validator->isValid())
            {
                // Generation du code de l'aide soignante
                $newCode = EmailController::generateCode();
                
                // création de l'aide soignante à partir des données du formulaire
                $person= new Person($_POST['lastname'],$_POST['firstname'],$_POST['role'],$_POST['email'], $newCode);

                // ajout de l'aide soignante dans la BDD
                $res = $q->addNursing($person);

                // recuperation des informations des aides soigantes inscrites (en prenants en compte la nouvelle crée precedemment)
                $nursings = $q->getNursings();
                
                // Envoi du code par email
                EmailController::sendCode($_POST['email'], $newCode);

                // si l'ajout de l'aide soignante dans la BDD a echoué
                if ($res==false)
                {
                    $data = ['nursings' => $nursings]; // ici $data va contenir les informations des aides soigantes inscrites 
            
                }
                else 
                {
                    $data =['nursings' => $nursings, "errors" => "L'ajout a échoué"]; // ici $data va contenir les informations des aides soigantes inscrites, et le message d'erreur indiquant l'ajout a échoué
        
                }
                
            }

            // si les valeurs entrées par la cadre santé sont invalides, on donne a la vu les informations des aides soigantes inscrites, et les messages d'erreurs indiquant que les données entrées sont invalides. 
        
            else 
            {
                $nursings = $q->getNursings();
                $data = ['errors'=>$validator->getErrors(), 'nursings' => $nursings]; // $validator->getErrors() va contenir les messages donné en second paramètre des fonctions de la ligne 79 à 83
            }
        }

        $view = new View(__DIR__ . "/../views/admin/nursings.view.php", $data); // on dirige la cadre santé dans la même vue afin de mettre a jour les données. Cela va lui permettre de voir les ajouts ou les supressions d'aides soignantes qu'elle aura effectué
        $view->render();
    }


    /*
        Fonction qui permet à la cadre santé de voir la liste des aides soignantes ayant des tâches, ainsi que leurs tâches respectives
    */
    static function tasksAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();
        $nursings = $q->getNursings(); // toutes les aides soignantes inscrites 
        $nursingsw = $q->getNursingsWithTask(); // toutes les aides soignantes qui ont des tâches 
        $allTasks= $q->getAllTasks(); // toutes les tâches 
        $allRooms=$q->getAllRooms(); // toutes les salles 
        $allService=$q->getAllService(); // tout les services
        
    
        $tasks = [];

        foreach ($nursingsw as $nurse)
        {
            $tasks[$nurse['id']] = $q->getTasksNursing($nurse['id']); // ce tableau contient en index l'id de l'aide soignante, et a pour valeur les données des tâches qui lui sont affectées. Ce tableau ne concerne que les aides soignantes qui ont des tâches
    
        }

        // on passe les differents tableau crées precedemment à la vue 
        $view = new View(__DIR__ . "/../views/admin/tasks.view.php", ['service' => $allService ,'nursingsw' => $nursingsw, 'tasks' => $tasks, 'allTasks' => $allTasks, 'rooms' => $allRooms, 'nursings' => $nursings]);
        $view->render();
    }

    
    /*
        Fonction qui permet à la cadre santé d'affecté ou de supprimer une tâche à une aide soignante. Mâme principe que pour "nursingsPostsAction"
    */
    static function tasksPostsAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();

        if ($_POST['postMethod'] == "add")
        {
             $q->addTask($_POST['personId'],$_POST['roomName'],$_POST['tasks'],$_POST['date'],$_POST['service']);
             self::tasksAction(); 
        }
        if ($_POST['postMethod'] == "delete")
        {
            $q->deleteTask($_POST['personId'],$_POST['taskId'],$_POST['roomId'],$_POST['serviceId']);
            self::tasksAction();
        }


    }


    /*
        Fonction qui permet à la cadre santé de voir les tâches non faites ainsi que les informations des aides soignantes en charge de ces tâches
    */
    static function didAction()
    {
        ValidatorController::checkSession();
         $q = new QueriesController();
         $tasks= $q->getTasksNotDid();
         $view = new View(__DIR__ . "/../views/admin/tasksNotDid.view.php", ['tasks' => $tasks]);
         $view->render();
        
    }

    /*
        Fonction qui dirige la cadre santé vers la vue qui permet la mise a jour des tâches 
    */ 
     static function resetAction()
    {
          ValidatorController::checkSession();
         $view = new View(__DIR__ . "/../views/admin/reset.view.php", []);
         $view->render();
                 
    }

    /*
        Fonction qui permet à la cadre santé de supprimer toutes les tâches affectées à toutes les aides soignantes grâce à un bouton 
    */  
    static function resetPostsAction()
    {
         ValidatorController::checkSession();
         $q = new QueriesController();
         $q->reset();

         // une fois que la cadre santé appuie sur le bouton de réinitialisation, un message s'affiche sur la page grâce à du javascript
         $tab["message"]= "Toutes les tâches ont été effacés"; // message en question 
         $tab["error"]= 0;
         echo json_encode ($tab); // convertit $tab en json, cette données est ensuite triate dans "main.js"



    }


    /*

    // Fonction qui permet à une aide soignante de valider une tâche
    static function validerPostsAction()

     {
         ValidatorController::checkSession();
         $q = new QueriesController();
         $date =  $q->getDaysExpiration($_POST['personId'],$_POST['taskId'],$_POST['roomId']); // calcule le nombre de jour restant de la tâche en question

         if ($date<0) 
         {
             // si ce nombre de jour est négatif, on ne lui propose pas de bouton de validation
             $tasks = $q->getTasks();
             $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks,"errors" => "Le delai de cette tache est expiré"]); 
         }
         else {
             // sinon on lui propose un bouton de validation             
             $q->validerTask($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
             $tasks = $q->getTasks();
             $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, "message" => "Tâche faite"]); 
         }

    
         $view->render();
     }
     */

        
   
   
   
     static function validerPostsAction()
    {
        ValidatorController::checkSession();
        $q = new QueriesController();


         if ($_POST['postMethod'] == "me")
         {   
           $date =  $q->getDaysExpiration($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
           
           if ($date<0) 
            {
                $tasks = $q->getTasks();
                $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, "errors" => "Le delai de cette tache est expiré"]); 
            }
            else 
            {
               $q->validerTask($_POST['personId'],$_POST['taskId'],$_POST['roomId']);
               $tasks = $q->getTasks();
               $commonTasks = $q->getCommonTasks();
               $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, "message" => "Tâche faite"]); 
            }
        }
        
        else if ($_POST['postMethod'] == "autres")
       {
           $tasks = $q->getTasks();
           $commonTasks = $q->getCommonTasks();
           $view = new View(__DIR__ . "/../views/admin/aideSoignante.view.php", ['tasks' => $tasks, 'common' => $commonTasks]); 
           
       }




   
        $view->render();
 }

    




}