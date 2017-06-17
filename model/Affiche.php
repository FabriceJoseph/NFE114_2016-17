<?php

class Affiche{
	
	/*objet Spectacle*/
	private $spectacle;
	/*objet LieuSpectacle*/
	private $salle;
	private $dateDebut;
	private $dateFin;
	
	public function __construct(){
		
	}
	
	
	/** getters */
	
	public function getSpectacle(){
		return $this->spectacle;
	}
	
	public function getLieu(){
		return $this->lieu;
	}
	
	public function getDebut(){
		return $this->dateDebut;
	}
	
	public function getFin(){
		return $this->dateFin;
	}

}
