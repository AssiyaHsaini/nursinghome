<?php

namespace App;

use App\View;
use App\Person;
use App\ValidatorController;
use App\PDOController;

/**
 * Contrôleur qui s'occupe des requêtes sur notre BDD. Joue le rôle d'un DAO.
 */

class QueriesController
{

    private $errors = [];

    /*
		Fonction qui retourne true si aucune erreur est survenu sinon false
		Permet de faciliter les conditions (if, else if....)
	*/
	public function isValid()
	{
		return empty($this->errors);
	}

	/*
		Fonction qui renvoie le tableau des erreurs
	*/
	public function getErrors()
	{
		return $this->errors;
	}

    /*
        Fonction qui vérifie que l'utilisateur existe. S'il existe, on lui crée une session.
    */
    public function login($email,$code)
    {
        $response= ["error"=>false, "message"=>""];
        $db = PDOController::getInstance(); // récupération de la connexion a notre base.
        $req = $db->prepare('SELECT * FROM persons WHERE email =?');
        $req->execute([$email]);
        $data = $req->fetch();
        
        if ($data)
        {
            if ($data['code'] == $code)
            {
                $_SESSION["id"]=$data['id'];
                $_SESSION["lastname"]=$data['lastname'];
                $_SESSION["firstname"]=$data['firstname'];
                $_SESSION["role"]=$data['role'];
            }
            else 
            {
                $response["error"]=true;
                $response["message"]="Code incorrecte";
            }
        }
        else
        {
            $response["error"]=true;
            $response["message"]="Email incorrecte";
        }

        return $response;
     }

    /*
        Fonction qui vérifie que l'email est unique. Cette méthode est utilisé pour vérifier que la cadre santé n'inscrit pas des emails identiques dans la base.
    */
     public static function checkUniqueEmail($email)
     {
        $isUnique= true;
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT email FROM persons WHERE email=?');
        $req->execute([$email]);
        $data = $req->fetch();
     
        
        if ($data!=false)
            return true;
        
        return false;
        
     }

    /*
        Fonction qui retourne que le role de l'utilisateur. 
    */
    public function getRole($email,$code)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT role FROM persons WHERE email =? AND code=?');
        $req->execute([$email],[$code]);
        $data = $req->fetch();
        return $data;
    }

    /*
        Fonction qui retourne la liste des tâches affectées à un utilisateur.
    */
    public function getTasks()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT executedtask.id_room,executedtask.id_task, executedtask.expirationdate , tasks.name AS taskName, tasks.description AS taskDescription , executedtask.did,rooms.service_id, rooms.type_id, services.name AS serviceName, roomtypes.name AS typeName
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        JOIN rooms ON executedtask.id_room =rooms.id
        JOIN services ON services.id=rooms.service_id
        JOIN roomtypes ON roomtypes.id=rooms.type_id
        WHERE executedtask.id_person=?');
        $req->execute([$_SESSION["id"]]);
        $tasks = $req->fetchAll();
        foreach ($tasks as $key => $task) {
            //on ajoute à chaque tâche le nombre de jour restant à l'index 'days'.
            $tasks[$key]['days'] = $this->getDaysExpiration($_SESSION['id'],$task['id_task'],$task['id_room']);
        }
        return $tasks;
    }
    
    /*
        Fonction qui retourne la liste des nurses.
    */  
    public function getNursings()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT lastname, firstname, email, role ,id 
        FROM persons 
        WHERE role =?');
        $req->execute([1]);
        return $req->fetchAll();
    }

    /*
        Fonction qui ajoute des nurses dans la table 'persons'.
    */
    public function addNursing(Person $person)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('INSERT INTO persons(email,code,lastname,firstname,role)
        VALUES
        (?,?,?,?,?)');
        $req->execute([
            $person->getEmail(),
            $person->getCode(),
            $person->getLastName(),
            $person->getFirstName(),
            $person->getRole(),
        ]);
        return $req->fetch();
    }

    /*
        Fonction qui supprime la nurses dont l'id est $id de la table 'persons'.
    */
    public function deleteNursing($id)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('DELETE FROM persons WHERE id=?');
        $req->execute([$id]);
    }

    /*
        Fonction qui retourne la liste des nurses qui ont des tâches.
    */   
    public function getNursingsWithTask()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT DISTINCT persons.lastname, persons.firstname, persons.email, persons.role , persons.id
        FROM persons JOIN executedtask ON persons.id=executedtask.id_person');
        $req->execute();
        return $req->fetchAll();
    } 

    /*
        Fonction qui retourne la liste des tâches d'une nurse dont l'id est $id.
    */
    public function getTasksNursing($id)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT executedtask.id_person,executedtask.id_room,executedtask.expirationdate,executedtask.did,executedtask.id_task,executedtask.id_service,persons.lastname,persons.firstname,rooms.name AS roomName, tasks.name AS taskName ,tasks.description,services.name AS serviceName 
        FROM executedtask  JOIN persons ON executedtask.id_person=persons.id
        JOIN rooms ON executedtask.id_room=rooms.id
        JOIN tasks ON executedtask.id_task=tasks.id
        JOIN services ON executedtask.id_service=services.id
        WHERE executedtask.id_person=?');
        $req->execute([$id]);
        // $req = $db->prepare('SELECT services.name AS serviceName, executedtask.id_room, rooms.name AS roomName, executedtask.expirationdate , tasks.name, tasks.description, executedtask.id_task AS id_task, executedtask.id_service
        // FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        // JOIN rooms ON executedtask.id_room=rooms.id
        // JOIN services ON rooms.service_id=services.id
        // WHERE executedtask.id_person=?');
        // $req->execute([$id]);

        return $req->fetchAll();
    }

    /*
        Fonction qui affecte une tâche à une nurse.
    */
    public function addTask($person,$room,$task,$date,$service)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('INSERT INTO executedtask(id_person,id_room,expirationdate,did,id_task,id_service)
        VALUES
        (?,?,?,?,?,?)');
        $req->execute([
            $person,
            $room,
            $date,
            0,
            $task,
            $service
        ]);;
        return $req->fetchAll();
       
    }

    /*
        Fonction qui retourne la liste des tâches.
    */
    public function getAllTasks()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT name, id FROM tasks');
        $req->execute([]);
        return $req->fetchAll();
    }

    /*
        Fonction qui retourne la liste des rooms.
    */
    public function getAllRooms()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT roomtypes.name, rooms.id, rooms.name AS roomName, services.name AS serviceName
         FROM rooms JOIN roomtypes ON roomtypes.id= rooms.type_id
         JOIN services ON services.id=rooms.service_id');
        $req->execute([]);
    
        return $req->fetchAll();
    }


    /*
        Fonction qui supprime une tâches affectées à une nurse.
    */
    public function deleteTask($id_person, $id_tasks, $id_rooms, $id_service)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('DELETE FROM executedtask WHERE id_person=? AND id_task= ? AND id_room= ? AND id_service= ?');
        $req->execute([
            $id_person,
            $id_tasks,
            $id_rooms,
            $id_service
        ]);
        return $req->fetchAll();
    }

    /*
        Fonction qui permet à une nurse de valider une tâche.
    */
    public function validerTask($id_person,$id_task,$id_room)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('UPDATE executedtask
        SET did =  1 
        WHERE id_person=? AND id_room=? AND id_task= ?');
        $req->execute([
            $id_person,
            $id_room,
            $id_task,
        ]);
    }

    /*
        Fonction qui retourne la liste des tâches non faites.
    */
    public function getTasksNotDid()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT persons.firstname, persons.lastname, executedtask.id_room,executedtask.id_person, executedtask.expirationdate , tasks.name, tasks.description, executedtask.id_task 
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        JOIN persons ON executedtask.id_person = persons.id
        WHERE executedtask.did=?');
        $req->execute([0]);
        return $req->fetchAll();
    }

    /*
        Fonction qui calcule le nombre de jour restant entre la date actuelle et la date limite de la tâche .
    */
    public function getDaysExpiration($id_person,$id_task,$id_room)
    {

        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT *
        FROM executedtask
        WHERE id_person=? AND id_room=? AND id_task= ?');
        $req->execute([
            $id_person,
            $id_room,
            $id_task,
        ]);
        $data=  $req->fetch();
        $expirationdate = $data['expirationdate'];
        $duree=(strtotime($expirationdate)-strtotime(date('Y-m-d'))) / 86400;
        return $duree;
    }

    /*
        Fonction qui supprime tout les elements de la table 'executedtask'.
    */
    public function reset()
    {
        $db = PDOController::getInstance();
        
        $req = $db->prepare("TRUNCATE TABLE `executedtask` ");
        $req->execute([]);
    }

    /*
        Fonction qui récupère les tâches affectées dans les salles communes.
    */
    public function getCommonTasks()
    {
        $db = PDOController::getInstance();
        
        $req = $db->prepare('SELECT services.name AS serviceName, executedtask.id_room, rooms.name AS roomName, executedtask.expirationdate , tasks.name, tasks.description, executedtask.id_task AS id_task
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        JOIN rooms ON executedtask.id_room=rooms.id     
        JOIN services ON rooms.service_id=services.id
        JOIN roomtypes ON roomtypes.id=rooms.type_id  
        WHERE roomtypes.name=?');
        $req->execute(['salle_commune']);
        return $req->fetchAll();

    }

    public function getAllService()
    {
        $db = PDOController::getInstance();
        
        $req = $db->prepare('SELECT * FROM services');
        $req->execute([]);
        return $req->fetchAll();
                
    }

}