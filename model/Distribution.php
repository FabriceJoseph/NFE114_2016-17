<?php

class Distribution {

	private $spectacle;
	private $artistes=array();
	private $noms=array();
	private $roles=array();
	
	public function __construct(){
		
		  $args = func_get_args();
        $len = func_num_args();

        if(method_exists($this, $f='__construct'.$len)) {
            call_user_func_array(array($this, $f), $args);
        }
		
	}

	public function __construct1($a1){
		$this->spectacle=$a1;
	}
	

	
	public function addArtiste($idArtiste,$fonction){
		$this->artistes[$idArtiste]=$fonction;
	}
	
	//fonction a revoir
	public function addRole($idArtiste,$roles){
		$this->roles[$idArtiste]=$roles;
	}
	
	
	public function getSpectacle(){
		return $this->spectacle;
	}
		
	public function getArtisteByFonction($fonction){
		return array_keys($this->artistes,$fonction);
	}
	
	public function getNomsDistrib(){
		return $this->noms;
	}
	
	public function getNomDistrib($i){
		return $this->noms[$i];
	}
	
	
	public function addNoms(){
		$pdo = connexion::getInstance();
		$stmt = $pdo->prepare("SELECT * FROM Artiste WHERE idArtiste=:id;"); 
		if(count($this->artistes)>0){
			$ids=array_keys($this->artistes);
			foreach($ids as $id){
			 //$id=key($artiste);
			 $res=$stmt->execute(array("id"=>$id));
				 if($res){
					 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						 $this->noms[$id]=$row['prenom']." ".$row['nom'];
					 }
				}
			}
		}
		$pdo=null;
	}

}


?>
