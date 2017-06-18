<?php



class Affiche
{
	private $idLieu;
	private $idSpectacle;
	private $dateDebut;
	private $dateFin;

	/**public function __construct() {

    $args = func_get_args();
    $len = func_num_args();

		if(method_exists($this, $f='__construct'.$len)) {
			call_user_func_array(array($this, $f), $args);
		}

	}	
	
	
	public function __construct1($a1,$a2){
		$this->idLieu=$a1;
		$this->idSpectacle=$a2;
	}**/
	
	public function __construct($a1,$a2,$a3,$a4){
		$this->idLieu=$a1;
		$this->idSpectacle=$a2;
		$this->dateDebut=$a3;
		$this->dateFin=$a4;
	}
	
	public function getLieuAffiche(){
		return $this->idLieu;
	}
	
	public function getSpecAffiche(){
		return $this->idSpectacle;
	}
	
	public function getNomLieu(){
		 $pdo = connexion::getInstance();
		 $id=$this->idLieu;
		 $stmt = $pdo->prepare("SELECT nom FROM Lieu WHERE idLieu=:id;"); 
		 $res=$stmt->execute(array("id"=>$id));
		 
		 if($res){
			 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				 return $row['nom'];
			 }
		 }
		 
		 $pdo=null;
	}
	
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	public function getNomSpectacle(){
		 $pdo = connexion::getInstance();
		 $id=$this->idSpectacle;
		 $stmt = $pdo->prepare("SELECT nom FROM Spectacle WHERE id=:id;"); 
		 $res=$stmt->execute(array("id"=>$id));
		 
		 if($res){
			 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				 return $row['nom'];
			 }
		 }
		 
		 $pdo=null;
	}

}
