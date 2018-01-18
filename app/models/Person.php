<?php

namespace App;

class Person

{
	private $_id;
	private $_lastname;
	private $_firstname;
	private $_code;
    private $_role;
    private $_email;
    
    public function __construct($lastname,$firstname,$role,$email, $code)
    {
       
        $this->_lastname=$lastname;
        $this->_firstname=$firstname;
        $this->_code= $code;
        $this->_role=$role;
        $this->_email=$email;
    }

	public function getId()
	{
		return $this->_id;
    }
    
    public function getEmail()
	{
		return $this->_email;
	}

	public function getLastName()
	{
		return $this->_lastname;
	}

	public function getFirstName()
	{
		return $this->_firstname;
	}

	public function getCode()
	{
		return $this->_code;
	}

	public function getRole()
	{
		return $this->_role;
	}

	public function setCode($c)
	{
		$this -> _code = $c ;
	}

	public function setLastName($l)
	{
		$this -> _lastname = $l ;
	}

	public function setFirstName($f)
	{
		$this -> _firstname = $f ;
	}
	public function setId($i)
	{
		$this -> _id = $i ;
    }
    
    public function setEmail($email)
	{
		$this -> _email = $email;
    }
    
	public function setRole($r)
	{
		$this -> _role = $r ;
	}
}