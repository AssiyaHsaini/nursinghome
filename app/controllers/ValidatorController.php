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
		Verifie si le numéro de telephone respecte la norme française
	*/
	public function isPhoneNumber($field, $errorMsg)
	{
		$motif ='`^0[1-9][0-9]{8}$`';

		if(!preg_match($motif,$this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}
	}

	/*
		Verifie la date
	*/
	public function isDate($field, $errorMsg)
	{
		if ($this->getField($field))
		{	
			$date_now = date('d-m-Y');
			$date_tab = explode('-', $this->getField($field));

			if (!is_numeric($date_tab[0]) || !is_numeric($date_tab[1]) || !is_numeric($date_tab[2]))
			{
					$this->errors[$field] = $errorMsg;
			}
			else
			{
				if (!checkdate($date_tab[1], $date_tab[0], $date_tab[2]))
				{
					$this->errors[$field] = $errorMsg;
				}
			}
		}
	}

	/*
		Verifie si la chaine de caractere est une chaine de charactere :)
	*/
	public function isString($field, $errorMsg)
	{
		if (!is_string($this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
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
		Verifie si la valeur entrée est unique dans la base de donnees
		$champ = Le champ a verifier dans la base de donnee
		$table = La table a verifier dans la base de donnee
	*/
	public function isUniq($db, $champ, $table, $field, $errorMsg)
	{
		$record = $db->query("SELECT id FROM $table WHERE $champ = ?", [$this->getField($field)])->fetch();

		if ($record)
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}
	}

	/*
		Verifie si la variable est egale dans son champs "_confirm"
		Utilisé pour verifier les "mot_de_passe" dans la varibale $_POST
	*/
	public function isConfirmed($field, $errorMsg)
	{
		$value = $this->getField($field);

		if (empty($value) || $value != $this->getField($field . '_confirm'))
		{
			$this->errors[$field] = $errorMsg;
			$this->isError();
		}
	}

	/*
		Fonction pour la connexion.
		Verifie que le mot de passe et l'email du client sont correctes
	*/
	public function isGoodMember($db, $field_email, $field_mot_de_passe, $errorMsg)
	{
		$email = $this->getField($field_email);
		$mot_de_passe = $this->getField($field_mot_de_passe);

		$req = $db->query("SELECT id, mot_de_passe
							FROM clients 
							WHERE email = ?", [$email])->fetch();
		if ($req)
		{	
			if (!password_verify($mot_de_passe, $req->mot_de_passe))
			{
				$this->errors[$field_email] = $errorMsg;
				$this->errors[$field_mot_de_passe] = $errorMsg;
				$this->isError();
			}
		}
		else
		{
			$this->errors[$field_email] = $errorMsg;
			$this->errors[$field_mot_de_passe] = $errorMsg;
			$this->isError();
		}
	}
	
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
		if (!QueriesController::checkUniqueEmail($this->getField($field)))
		{
			$this->errors[$field] = $errorMsg;
		}
	}


}
