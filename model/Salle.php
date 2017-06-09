<?php

class Salle {

    private $nom;
    private $adresse;
    private $capacite;
    private $reservations;

/**********************Constructors**************************/

    public function __construct() {
        $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this,$f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
    }

    public function __construct1($a1) {
        $this->nom = $a1;
    }

    public function __construct2($a1, $a2) {
        $this->nom = $a1;
        $this->adresse = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->nom = $a1;
        $this->adresse = $a2;
        $this->capacite = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->nom = $a1;
        $this->adresse = $a2;
        $this->capacite = $a3;
        $this->reservations = $a4;
    }

/**********************Constructors**************************/

/***************debut getters and setters******************************/

public function getNom() {
    return $this->nom;
}

public function setNom($nom) {
    $this->nom = $nom;
}

public function getAdresse() {
    return $this->adresse;
}

public setAdresse($adresse) {
    $this->adresse = $adresse;
}

public function getCapacite() {
    return $this->capacite;
}

public function setCapacite($capacite) {
    $this->capacite = $capacite;
}

public function getReservations() {
    $this->reservations;
}

public function setReservations($reservations) {
    $this->reservations = $reservations;
}

/***************fin getters and setters******************************/
}


?>