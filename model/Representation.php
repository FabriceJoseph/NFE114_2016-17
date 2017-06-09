<?php

class Representation {

    private $idRepresentation;
    private $date;
    private $heure;
    private $reservations;

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

/**************************Constructors****************************/

/**************debut  getters and setters*****************************/
public function getIdRepresentation() {
    return $this->idRepresentation;
}

public function setIdRepresentation($representation) {
    $this->idRepresentation = $representation;
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
/**************fin  getters and setters*****************************/

}

?>