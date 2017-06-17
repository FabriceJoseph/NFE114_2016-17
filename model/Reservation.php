<?php

class Reservation{

	private $numero;
	private $date;
	/*objet Client*/
	private $client;
	/* tableau associatif : objet Place => quantité */
	private $placeReservee;
	
	public function __construct(){}
	
	
	/* getter */ 
	
	public function getNumero(){
		return $this->numero;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getClient(){
		return $this->client;
	}
	
	public function getPlaceReservee(){
		return $this->placeReservee;
	}
	
	private function calculMontant(){
		
	}
	
/*
 * 
 * name: payer
 * appeler le système de paiement
 * @param 
 * numRes est le numéro de la réservation en cours de paiement
 * montant est le montant de la réservation à payer
 * @return boolean 
 * vrai si le paiement est validé, sinon faux
 * 
 */
	
	public function payer($numRes, $montant){
		//todo
	}

/*
 * 
 * name: editerBillet
 * afficher le billet
 * @param
 * @return
 * 
 */

	public function editerBillet(){
		//todo
	}
}


?>
