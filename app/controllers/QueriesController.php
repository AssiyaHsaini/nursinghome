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
        $req = $db->prepare('SELECT executedtask.id_room, executedtask.expirationdate , tasks.name, tasks.description
        FROM executedtask JOIN tasks ON executedtask.id_task=tasks.id 
        WHERE executedtask.id_person=?');
        $req->execute([$_SESSION["id"]]);
        return $req;
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



}