<?php

require_once 'PersonnePhysique';

class Artiste extends PersonnePhysique{
	
	private $specialite;
	
	/*****************Constructors*****************************/

    public function __construct() {

        $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this, $f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
    }

    public function __construct1($a1) {
        $this->civilite = $a1;
    }

    public function __construct2($a1, $a2) {
        $this->civilite = $a1;
        $this->nom = $a2;
    }

    public function __construct3($a1, $a2, $a3) {
        $this->civilite = $a1;
        $this->nom = $a2;
        $this->prenom = $a3;
    }

    public function __construct4($a1, $a2, $a3, $a4) {
        $this->civilite = $a1;
        $this->nom = $a2;
        $this->prenom = $a3;
        $this->adresse = $a4;
    }

    public function __construct5($a1, $a2, $a3, $a4, $a5) {
        $this->civilite = $a1;
        $this->nom = $a2;
        $this->prenom = $a3;
        $this->adresse = $a4;
        $this->mail = $a5;
    }

    public function __construct6($a1, $a2, $a3, $a4, $a5, $a6) {
        $this->civilite = $a1;
        $this->nom = $a2;
        $this->prenom = $a3;
        $this->adresse = $a4;
        $this->mail = $a5;
        $this->telephone = $a6;
    }

    public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7) {
        $this->civilite = $a1;
        $this->nom = $a2;
        $this->prenom = $a3;
        $this->adresse = $a4;
        $this->mail = $a5;
        $this->telephone = $a6;
        $this->specialite = $a7;
    }
/*****************Constructors*****************************/
	
/** getter et setters **/

	public function getSpecialite(){
		return $this->specialite;
	}
	
	public function setSpecialite($newspec){
		$this->specialite=$newspec;
	}
	
}


?>
