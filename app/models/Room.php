<?php

class Room
{
    private $_id;
	private $_service;
	private $_type;
    private $_number;
    
    public function getId()
	{
		return $_id;
	}

	public function getService()
	{
		return $_service;
	}

	public function getType()
	{
		return $_type;
	}

	public function getNumber()
	{
		return $_number;
	}
	public function setService($s)
	{
		$this -> _service = $s ;
	}

	public function setType($t)
	{
		$this -> _type = $t ;
	}

	public function setNumber($n)
	{
		$this -> _number = $n ;
	}
}

?>