<?php

class Distribution{
	
		/*objet Spectacle*/
		private $spectacle;
		/*objet Artiste*/
		private $metteurEnScene;
		/*objet Artiste*/
		private $auteur;
		/* tableau associatif : role => Artiste*/
		private $roles;
		
		public function __construct()
		
		
		/* getters */
		
		public function getSpectacle(){
			return $this->spectacle;
		}
		
		public function getMetteurES(){
			return $this->metteurEnScene;
		}
		
		public function getAuteur(){
			return $this->auteur;
		}
		
		public function getRoles(){
			return $this->roles;
		}
	
}

?>
