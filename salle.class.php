<?php

class Salle{
		
		private nom;
		/*objet LieuSpectacle*/
		private lieu;
		private capacite;
	
		public function __construct()
		
		
		/* getters */ 
		
		public function getNom(){
			return $this->nom;
		}
		
		public function getLieu(){
			return $this->lieu;
		}
		
		public function getCapacite(){
			return $this->capacite;
		}
		
}

?>
