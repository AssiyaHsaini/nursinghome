<?php

namespace App;

use App\View;
use App\Person;
use App\ValidatorController;
use App\PDOController;

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

    public function login($email,$code)
    {
        $response= ["error"=>false, "message"=>""];
        $db = PDOController::getInstance();
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


    public function getRole($email,$code)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT role FROM persons WHERE email =? AND code=?');
        $req->execute([$email],[$code]);
        $data = $req->fetch();
        return $data;
        //return $_SESSION["role"];
    }

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
            $tasks[$key]['days'] = $this->getDaysExpiration($_SESSION['id'],$task['id_task'],$task['id_room']);
        }
        return $tasks;
    }
    
    public function getNursings()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT lastname, firstname, email, role ,id 
        FROM persons 
        WHERE role =?');
        $req->execute([1]);
        return $req->fetchAll();
    }

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

    public function deleteNursing($id)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('DELETE FROM persons WHERE id=?');
        $req->execute([$id]);
        //$donnees = $req->fetch();
        //var_dump($donnees);
        //return $donnees;
    }

    public function getNursingsWithTask()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT DISTINCT persons.lastname, persons.firstname, persons.email, persons.role , persons.id
        FROM persons JOIN executedtask ON persons.id=executedtask.id_person
       ');
        $req->execute();
        return $req->fetchAll();
    } 

    public function getTasksNursing($id)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT executedtask.id_room, executedtask.expirationdate , tasks.name, tasks.description, executedtask.id_task AS id_task
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        WHERE executedtask.id_person=?');
        $req->execute([$id]);

        return $req->fetchAll();
    }

    public function addTask($person,$room,$task,$date)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('INSERT INTO executedtask(id_person,id_room,expirationdate,did,id_task)
        VALUES
        (?,?,?,?,?)');
        $req->execute([
            $person,
            $room,
            $date,
            0,
            $task,
        ]);;
        return $req->fetchAll();
       
    }

    public function getAllTasks()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT name, id FROM tasks');
        $req->execute([]);
        return $req->fetchAll();
    }


    public function getAllRooms()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT roomtypes.name, rooms.id
         FROM rooms JOIN roomtypes ON roomtypes.id= rooms.type_id');
        $req->execute([]);
        return $req->fetchAll();
    }


    public function deleteTask($id_person, $id_tasks, $id_rooms)
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('DELETE FROM executedtask WHERE id_person=? AND id_task= ? AND id_room= ?');
        $req->execute([
            $id_person,
            $id_tasks,
            $id_rooms,
        ]);;
        return $req->fetchAll();
       
    }

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

    public function getTasksNotDid()
    {
        $db = PDOController::getInstance();
        $req = $db->prepare('SELECT executedtask.id_room,executedtask.id_person, executedtask.expirationdate , tasks.name, tasks.description, executedtask.id_task 
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        WHERE executedtask.did=?');
        $req->execute([0]);
        return $req->fetchAll();
    }

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
}