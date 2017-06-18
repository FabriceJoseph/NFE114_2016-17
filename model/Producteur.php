<?php

public class Producteur extends PersonneMorale {

/***********************Constructors****************************/

    public function __construct() {

        $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this, $f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
    }

    public function __construct1($a1) {
        $this->denominationSociale = $a1;
    }

    public function __construct2($a1, $a2) {
        $this->denominationSociale = $a1;
        $this->formeJuridique = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->denominationSociale = $a1;
        $this->formeJuridique = $a2;
        $this->adresse = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->denominationSociale = $a1;
        $this->formeJuridique = $a2;
        $this->adresse = $a3;
        $this->telephone = $a4;
    }

    public function __construct5($a1, $a2, $a3, $a4, $a5) {
        $this->denominationSociale = $a1;
        $this->formeJuridique = $a2;
        $this->adresse = $a3;
        $this->telephone = $a4;
        $this->mail = $a5;
    }

    public function __construct6($a1, $a2, $a3, $a4, $a5, $a6) {
        $this->denominationSociale = $a1;
        $this->formeJuridique = $a2;
        $this->adresse = $a3;
        $this->telephone = $a4;
        $this->mail = $a5;
        $this->producteur = $a6;
    }

/***********************Constructors****************************/
}


?>