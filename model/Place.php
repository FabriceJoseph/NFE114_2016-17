<?php

class Place {

    private $numero;
    private $salle;
    private $categorie;
    private $gestionnaire;


/************************Constructors*********************************/

    public function __construct() {

        $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this, $f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
    }

    public function __construct1($a1) {
        $this->numero = $a1;
    }

    public function __construct2($a1, $a2) {
        $this->numero = $a1;
        $this->salle = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->numero = $a1;
        $this->salle = $a2;
        $this->categorie = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->numero = $a1;
        $this->salle = $a2;
        $this->categorie = $a3;
        $this->gestionnaire = $a4;
    }

/************************Constructors*********************************/

/***************debut getters and setters *********************************/

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