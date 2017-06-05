<?php

class Place{

	private placesDisponibles;
	private prixUnitaire;
	/*objet CategorieParSalle*/
	private categoriePlace;
	/*objet Representation*/
	private representation;
	/*objet Promotion */
	private promo;
	/*objet Reservation*/
	
	public function __construct()
	
	
	/* getters */
	
	public function getPlacesDispo(){
		return $this->placesDisponibles;
	}
	
	public function getPxUnit(){
		return $this->prixUnitaire;
	}
	
	public function getCategorie(){
		return $this->categoriePlace;
	}
	
	public function getRepresentation(){
		return $this->representation;
	}
	
	public function getPromo(){
		return $this->promo;
	}
	
/*
 * 
 * name: reserver
 * reserver des places pour cette catégorie de place
 * @param 
 * la reservation concernée
 * quantité de cette categorie de place (type int)
 * @return boolean 
 * vrai si reservation possible, faux sinon
 * 
 */
	
	public function selectionnerPlace($reservation, $quantite){
		
		//todo
		
		/*
		 * si fonction payer de Reservation renvoie vrai alors 
		 */
		decrementerDispo($quantite); 
		
	}
	
	
	
/*
 * 
 * name: decrementerDispo
 * diminuer le nombre de place restant disponibles après réservation
 * @param quantite de type int 
 * nombre de place à décrémenter
 * @return void
 * 
 */
	
	public function decrementerDispo($quantite){
		$this->placesDisponibles=-$quantite;
	}
}


?>
