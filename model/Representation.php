<?php

class Representation {

    private $idRepresentation;
    private $idSpectacle;
    private $date;
    private $heure;
    private $reservations;
    private $salle;
    private $nomSpectacle;
    private $idLieu;

/**************************Constructors****************************/

    public function __construct() {

        $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this, $f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
    }

    public function __construct1($a1) {
        $this->idRepresentation = $a1;
    }

    public function __construct2($a1, $a2) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
        $this->reservations = $a4;
    }
    
     public function __construct5($a1, $a2, $a3, $a4, $a5) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
        $this->reservations = $a4;
        $this->idSpectacle = $a5;
    }

    public function __construct6($a1, $a2, $a3, $a4, $a5, $a6) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
        $this->reservations = $a4;
        $this->idSpectacle = $a5;
        $this->salle = $a6;
    }

     public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
        $this->reservations = $a4;
        $this->idSpectacle = $a5;
        $this->salle = $a6;
        $this->nomSpectacle = $a7;
    }

     public function __construct8($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) {
        $this->idRepresentation = $a1;
        $this->date = $a2;
        $this->heure = $a3;
        $this->reservations = $a4;
        $this->idSpectacle = $a5;
        $this->salle = $a6;
        $this->nomSpectacle = $a7;
        $this->idLieu = $a8;
    }

    
/**************************Constructors****************************/

/**************debut  getters and setters*****************************/
public function getIdRepresentation() {
    return $this->idRepresentation;
}

public function setIdRepresentation($representation) {
    $this->idRepresentation = $representation;
}

public function getIdSpectacle() {
    return $this->idSpectacle;
}

public function setIdSpectacle($id) {
    $this->idSpectacle = $id;
}

public function getNomSpectacle() {
    return $this->nomSpectacle;
}

public function setNomSpectacle($nom) {
    $this->nomSpectacle = $nom;
}

public function getDate() {
    return $this->date;
}

public function setDate($date) {
    $this->date = $date;
}

public function getHeure() {
    return $this->heure;
}

public function setHeure($heure) {
    $this->heure = $heure;
}

public function getResrevations() {
    return $this->reservations;
}

public function setReservations($reservations) {
    $this->reservations = $reservations;
}

public function getSalle() {
    return $this->salle;
}

public function setSalle($salle) {
    $this->salle = $salle;
}

public function getIdLieu() {
    return $this->idLieu;
}

public function setIdLieu($idLieu) {
    $this->idLieu = $idLieu;
}

/**************fin  getters and setters*****************************/

}

?>
