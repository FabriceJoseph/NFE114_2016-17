<?php

class Spectacle{

	private $titre;
	private $synopsis;
	private $duree;
	private $genre;
	/* objet Distribution*/
	private $distribution;
	/* objet Illustration */
	private $illustration;
	/* Array des affiches pour ce spectacle*/
	private $affiches ;
	private $statut;

	public function __construct()
	
	/* getters */
	
	public function getTitre(){
		return $this->titre;
	}
	
	public function getSynopsis(){
		return $this->synopsis;
	}
	
	public function getDuree(){
		return $this->duree;
	}
	
	public function getGenre(){
		return $this->genre;
	}
	
	public function getDistribution(){
		return $this->distribution;
	}
	
	public function getIllustration(){
		return $this->illustration;
	}
	
	/*return Array de Affiche*/
	public function getAffiche(){
		return $this->affiches;
	}
	
	public function getStatut(){
		return $this->statut;
	}
	
/*
 * 
 * name: activer
 * Activer le spectacle selon son statut
 * @param statut de type string
 * visible = le spectacle est visible sur le site 
 * actif = le spectacle est visible et les réservations sont possibles
 * inactif = le spectacle n'est plus visible sur le site
 * @return void
 * 
 */
	
	public function activer($statut){
		//todo
	}
	
	/* la date debut doit etre la date au plus tot des affiches*/
	private function getDateDebut(){
		//todo
	}
	/* la date fin doit etre  la date au plus tard des affiches*/
	private function getDateFin(){
		//todo
	}
}

?>
