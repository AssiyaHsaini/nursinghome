<?php

namespace App;

use App\View;
use App\ValidatorController;
use App\PDOController;

class QueriesController
{

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
     
}