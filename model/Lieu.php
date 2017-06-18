<?php

    class Lieu {

        private $nom;
        private $adresse;
        private $ville;
        private $codePostal;


        public function __construct($nom, $adresse, $codePostal, $ville) {
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->codePostal = $codePostal;
        }


        public function getNom() {
            return $this->nom;
        }

        public function getAdresse() {
            return $this->adresse;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getCodePostal() {
            return $this->codePostal;
        }


    }

?>