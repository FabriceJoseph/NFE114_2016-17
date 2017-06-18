<?php

class Spectacle {

public $idSpectacle;
public $nom;
//private $idRepresentation; pas util ici
public $idProducteur;
private $artistes;
public $genre;
private $salle;
public $description;
public $dateDebut;
public $dateFin;
public $status;
public $illustration;
public $distribution;

/*******************Constructors********************************/

public function __construct() {

    $args = func_get_args();
    $len = func_num_args();

    if(method_exists($this, $f='__construct'.$len)) {
        call_user_func_array(array($this, $f), $args);
    }

}

public function __construct1($a1) {
    $this->nom = $a1;
}

public function __construct2($a1, $a2) {
    $this->nom = $a1;
    $this->status = $a2;
}


public function __construct3($a1, $a2, $a3) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
}

public function __construct4($a1, $a2, $a3, $a4) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
}

public function __construct5($a1, $a2, $a3, $a4, $a5) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
    $this->genre = $a5;
}

public function __construct6($a1, $a2, $a3, $a4, $a5, $a6) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
    $this->genre = $a5;
    $this->salle = $a6;
}

public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7) {
    $$this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
    $this->genre = $a5;
    $this->dateFin = $a6;
    $this->description = $a7;
}

public function __construct8($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
    $this->genre = $a5;
    $this->dateFin = $a6;
    $this->description = $a7;
    $this->idSpectacle = $a8;
}

public function __construct9($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8,$a9) {
    $this->nom = $a1;
    $this->status = $a2;
    $this->idProducteur = $a3;
    $this->dateDebut = $a4;
    $this->genre = $a5;
    $this->dateFin = $a6;
    $this->description = $a7;
    $this->idSpectacle = $a8;
    $this->distribution=$a9;
}

 

/*******************Constructors********************************/

/**************debut  getters and setters*****************************/
public function getIdSpectacle() {
    return $this->idSpectacle;
}

public function setIdSpectacle($id) {
    $this->idSpectacle = $id;
}

public function getNom() {
    return $this->nom;
}

public function setNom($nom) {
    $this->nom = $nom;
}

public function getRepresentation() {
    return $this->representation;
}

public function setRepresentation($representation) {
    $this->representation = $representation;
}

public function getIdProducteur() {
    return $this->idProducteur;
}

public function setIdProducteur($idProducteur) {
    $this->idProducteur = $idProducteur;
}

public function getArtistes() {
    return $this->artistes;
}

public function setArtistes($artistes) {
    $this->artistes = $artistes;
}

public function getGenre() {
    return $this->genre;
}

public function setGenre($genre) {
    $this->genre = $genre;
}

public function getDuree() {
    return $this->duree;
}

public function setDuree($duree) {
    $this->duree = $duree;
}

public function getSalle() {
    return $this->salle;
}

public function setSalle($salle) {
    $this->salle = $salle;
}

public function getDateDebut() {
    return $this->dateDebut;
}

public function setDateDebut($date) {
    $this->dateDebut = $date;
}

public function getDateFin() {
    return $this->dateFin;
}

public function setDateFin($date) {
    $this->dateFin = $date;
}

public function getStatus() {
    return $this->status;
}

public function setStatus($status) {
    $this->status = $status;
}

public function setIllustration($illustration){
	$this->illustration=$illustration;
}
public function getIllustration(){
	return $this->illustration;
}

public function setDescription($description){
	$this->description=$description;
}
public function getDescription(){
	return $this->description;
}


/**************fin getters and setters*****************************/


}



?>
