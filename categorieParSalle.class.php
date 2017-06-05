<?php

class CategorieParSalle{

	/* nom issu de l'objet Categorie*/
	private nomCategorie;
	/* objet Salle */ 
	private salle;
	private capaciteCategorie;
	
	public function __construct()
	
	/** getters **/
	
	public function getNomCategorie(){
		return $this->nomCategorie;
	}
	
	public function getSalle(){
		return $this->salle;
	}
	
	public function getCapaciteCat(){
		return $this->capaciteCategorie;
	}


}

?>
