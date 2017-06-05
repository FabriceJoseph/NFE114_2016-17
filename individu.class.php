<?php

class Individu {
	
	private $civilite ;
	private $nom ; 
	private $prenom ;
	
	public function __construct(){
		
	}
	
/*getters*/
	public function getCivilite(){
		return $this->civilite;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getPrenom(){
		return $this->prenom;
	}
	
/*setter*/
	public function setCivilite($civilite){
		$this->civilite=$civilite;
	}
	
	public function setNom($nom){
		$this->nom=$nom;
	}
	
	public function setPrenom($prenom){
		$this->prenom=$prenom;
	}
	
	public function toString(){
		return $this->civilite." ".$this->prenom." ".$this->nom;
	}
	
}

?>
