<?php

abstract class PersonneMorale {

    private $denominationSociale;
    private $formeJuridique;
    private $adresse;
    private $telephone;
    private $mail;
    private $producteur;

    //abstract public function creer();

/**********************getters et setters************************/

    public function setDenominationSociale($denominationSociale) {
        $this->denominationSociale = $denominationSociale;
    }

    public function getDenominationSociale() {
        return $this->denominationSociale;
    }

    public function setFormeJuridique($formeJuridique) {
        $this->formeJuridique = $formeJuridique;
    }

    public function getFormeJuridique() {
        return $this->formeJuridique;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getProducteur() {
        return $this->producteur;
    }

    public function setProducteur($producteur) {
        $this->producteur = $producteur;
    }

/**********************getters et setters************************/
}

?>