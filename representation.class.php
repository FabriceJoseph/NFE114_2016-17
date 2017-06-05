<?php

class Representation{

	private $date;
	private $horaire;
	/* objet Spectacle*/
	private $spectacle;
	/* objet Salle */
	private $salle;
	/* array de Reservation*/
	private $reservations;
	/* array de Place*/
	private $places;

	
	public function __construct(){
		
	}
	
	/* getter */
	
	public function getDate(){
		return $this->date;
	}

	public function getHoraire(){
		return $this->horaire;
	}
	
	public function getSpectacle(){
		return $this->spectacle;
	}
	
	public function getSalle(){
		return $this->salle;
	}
	
	public function getReservations(){
		return $this->reservations;
	}
	
	public function getPlaces(){
		return $this->places;
	}
	
/*
 * 
 * name: calculTxRemplissage
 * @param
 * @return le % de remplissage pour cette representation
 * 
 */
	
	private function calculTxRemplissage(){
		//todo
	}
	
/*
 * 
 * name: calculCA
 * @param
 * @return le chiffre d'affaires en euros pour cette représentation
 * 
 */
	private function calculCA(){
		//todo
	}
	
/*
 * 
 * name: ouvrirReservation
 * @param date et heure d'ouverture
 * @return void
 * 
 */
	
	public function ouvrirReservation($date, $heure){
		//todo
	}
	
/*
 * 
 * name: fermerReservation
 * @param date et heure de fermeture
 * @return void
 * 
 */
	public function fermerReservation($date, $heure){
		//todo
	}
/*
 * 
 * name: reserver
 * @param
 * un client
 * @return boolean
 * vrai si reservation aboutie, faux sinon
 * 
 */
	
	public function reserver($client){
		/*
		 * todo
		 * creer une nouvelle reservation
		 */
	}
}

?>
