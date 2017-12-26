<?php

namespace App;

/**
 * classe qui implémente Singleton 
 */
class PDOController
{
   
    private static $instance;

    private function __construct()
    {
        try
        {
            self::$instance = new \PDO("mysql:dbname=nursinghome;host=localhost",'root','');
        }
       catch(Exception $e)
       {
            die('Erreur : ' . $e->getMessage());
       }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance) )
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
}