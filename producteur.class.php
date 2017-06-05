<?php

class Producteur{
	
	
	private $nLicence;
	private $nSiren;
	private $denomination;
	private $formeJuridique;
	private $adresse;
	/** ville est un objet Ville*/
	private $ville;
	private $tel;
	private $mail; 
	private $pwd;
	/* le dirigeant est un objet individu*/
	private $dirigeant;
	
	public function __construct(){
		
	}
	
	
	/*getter*/
	public function getLicence(){
		return $this->nLicence;
	}
	
	public function getSiren(){
		return $this->nSiren;
	}
	
	public function getDenomination(){
		return $this->denomination;
	}
	
	public function getFormeJuridique(){
		return $this->formeJuridique;
	}
	
	public function getAdresse(){
		return $this->adresse;
	}
	
	public function getVille(){
		return $this->ville;
	}
	
	public function getTel(){
		return $this->tel;
	}
	
	public function getMail(){
		return $this->mail;
	}
	
	public function getPwd(){
		return $this->pwd;
	}
	
	public function getDirigeant(){
		return $this->dirigeant;
	}
	
}
?>
