<?php

class Place {

    //private $numero;
    private $idRepresentation;
    private $idCategorie;
    //private $salle;
    private $capacite;
    private $placeDispo;
    private $prix;
    //private $gestionnaire;


/************************Constructors*********************************/

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
        $this->idCategorie = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->idRepresentation = $a1;
        $this->idCategorie = $a2;
        $this->capacite = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->idRepresentation = $a1;
        $this->idCategorie = $a2;
        $this->capacite = $a3;
        $this->placeDispo = $a4;
    }

    public function __construct5($a1, $a2, $a3, $a4, $a5) {
        $this->idRepresentation = $a1;
        $this->idCategorie = $a2;
        $this->capacite = $a3;
        $this->placeDispo = $a4;
        $this->prix = $a5;
    }

/************************Constructors*********************************/

/***************debut getters and setters *********************************/

public function getIdRepresentation() {
    return $this->idRepresentation;
}

public function getIdCategorie() {
    return $this->idCategorie;
}

public function getCapacite() {
    return $this->capacite;
}

public function getPlaceDispo() {
    return $this->placeDispo;
}

public function getPrix() {
    return $this->prix;
}



public function getNumero() {
    return $this->numero;
}

public function setNumero($numero) {
    $this->numero = $numero;
}

public function getSalle() {
    return $this->salle;
}

public function setSalle($salle) {
    $this->salle = $salle;
}

public function getCategorie() {
    return $this->categorie;
}

public function setCategorie($categorie) {
    $this->categorie = $categorie;
}

public function getGestionnaire() {
    return $this->gestionnaire;
}

public function setGestionnaire($gestionaire) {
    $this->gestionnaire = $gestionnaire;
}

/***************fin getters and setters *********************************/

}

?>