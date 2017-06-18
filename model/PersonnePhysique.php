<?php

abstract class PersonnePhysique {

    private $civilite;
    private $nom;
    private $prenom;
    private $adresse;
    private $mail;
    private $telephone;

    //abstract public function creer();

//********************getters et setters***************************//

    public function getCivilite() {
        return $this->civilite;
    }

    public function setCivilite($civilite) {
        $this->civilite = $civilite;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

//********************getters et setters***************************//
}

?>