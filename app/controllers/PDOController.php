<?php

namespace App;

/**
 * classe qui implémente Singleton 
 */
class PDOCOntroller
{
   
    private static $instance;

    private function __construct()
    {
        try
        {
            $this->instance = new PDO('localhost','nursinghome','root','root');
        }
       catch(Exception $e)
       {
            die('Erreur : ' . $e->getMessage());
       }
    }

    

    public static function getInstance()
    {
        if (!isset (self::$instance) )
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
}