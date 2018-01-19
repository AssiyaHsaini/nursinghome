<?php

namespace App;

use App\View;
use App\QueriesController;


class ValidatorController {

	private $data;
	private $errors = [];

	public function __construct($data)
	{
		$this->data = $data;
	}

	private function isError()
	{	
		// if (isset($this->errors['errors']))
		// {
		// 	if ($this->errors['error'] == 0)
		// 		$this->errors['error'] = 1;
		// }
		// else
		// 	$this->errors['error'] = 1;
	}

	/*
		Recuperer un champ donné dans le tableau $this->data
		(evite la gestion isset() dans les conditions)
	*/
	private function getField($field)
	{
		if (!isset($this->data[$field]))
		{
			return NULL;
		}

		return $this->data[$field];
	}

	/*
		Verifie si le champ demandé existe
	*/
	public function existsField($field, $errorMsg)
	{
		if (!isset($this->data[$field]))
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}

	}


	/*
		Verifie si la chaine de caractere n'est pas vide
	*/
	public function isNotEmpty($field, $errorMsg)
	{
		if (empty($this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
		}
	}

	/*
		Verifie si la variable est de type numerique
	*/
	public function isNum($field, $errorMsg)
	{
		if (!is_double($this->getField($field)) && !is_int($this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}
	}

	/*
		Verifie si l'email est conforme
	*/
	public function isEmail($field, $errorMsg)
	{
		if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL))
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}
	}

	/*
		Fonction qui vérifie si la session est toujours valide
	*/
	public static function checkSession()
	{
		if ((!isset($_SESSION['role']) || !isset($_SESSION['id'])))
			header("Location: /nursinghome/");
	}

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

	public function isUniqueEmail($field, $errorMsg)
	{

		if (QueriesController::checkUniqueEmail($this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
		}
	}


}
