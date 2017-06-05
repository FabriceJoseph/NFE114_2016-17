<?php

class LieuSpectacle{

	private nom;
	private adresse;
	/*objet ville*/
	private ville;
	private mailgestionnaire;
	/* array de Salle */
	private salles;
	
	public function __construct()
	
	/* getters */
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getAdresse(){
		return $this->adresse;
	}
	
	public function getVille(){
		return $this->ville;
	}
	
	public function getMailGestionnaire(){
		return $this->mailgestionnaire;
	}
	
	//return un array de Salle
	public function getSalles(){
		return $this->salles;
	}
	

}

?>
