<?php

class Client{

	private $identite;
	private $adresse;
	/** ville est un objet Ville*/
	private $ville;
	private $dateNaissance;
	private $mail;
	private $pwd;

	public function __construct()
	
	
	/*getter*/
	
	public function getIdentite(){
		return $this->identite;
	}
	
	public function getAdresse(){
		return $this->adresse;
	}
	
	public function getVille(){
		return $this->ville;
	}
	
	public function getDateNaissance(){
		return $this->dateNaissance;
	}
	
	public function getMail(){
		return $this->mail;
	}
	
	public function getPwd(){
		return $this->pwd;
	}
}

?>
