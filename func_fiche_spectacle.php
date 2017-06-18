<?php

function displayDistribution($spectacle){
		$idSpectacle=$spectacle->getIdSpectacle();
		$distribution=retrieveDistribution($idSpectacle);
		displayByFonction($distribution,"mes");
		displayByFonction($distribution,"auteur");
		displayByFonction($distribution,"acteur");
}

	

function displayLieux_Dates($spectacle){
		$idSpectacle=$spectacle->getIdSpectacle();
		$affiches=retrieveAffiches($idSpectacle);
		
		foreach($affiches as $affiche){
			echo "<div>".displayAffiche($affiche)."</div>";
		}
}


function retrieveDistribution($id){
			
		 $distribution = new Distribution($id);
		 $pdo = connexion::getInstance();
		 $stmt = $pdo->prepare("SELECT * FROM Distribution WHERE idSpectacle=:id;"); 
		 $res=$stmt->execute(array(":id"=>$id));
		 
		 if($res){
			 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				 $distribution->addArtiste($row['idArtiste'],$row['fonction']);
			 }
		 }
		 
		 $pdo=null;
		 $distribution->addNoms();
		 return $distribution;
}


//afficher les artistes selon leur fonction dans le spectacle
function displayByFonction($distribution,$fonction){
		
		switch ($fonction) {
			
			case "mes" :
			$mes=$distribution->getArtisteByFonction($fonction);
			if(count($mes)>0){
				echo "<p>Metteur en scène :</p>";
				foreach($mes as $id){
					$nom=$distribution->getNomDistrib($id);
					echo "<p>".$nom."</p>";
				}
			}
			
			break;
			
			case "auteur" :
			$aut=$distribution->getArtisteByFonction($fonction);
			if(count($aut)>0){
				echo "<span>Auteur :</span>";
				foreach($aut as $id){
					$nom=$distribution->getNomDistrib($id);
					echo "<p>".$nom."</p>";
				}
			}
		
			break;
			
			
			case "acteur" :
			$act=$distribution->getArtisteByFonction($fonction);
			if(count($act)>0){
				echo "<p>Acteur(s) :</p>";
				foreach($act as $id){
					$nom=$distribution->getNomDistrib($id);
					echo "<p>".$nom."</p>";
				}
			}
	
			break;	
	}
}

function retrieveAffiches($id){
		$affiches=array();
		$pdo = connexion::getInstance();
		 $stmt = $pdo->prepare("SELECT * FROM Affiche WHERE idSpectacle=:id;"); 
		 $res=$stmt->execute(array(":id"=>$id));
		 
		 if($res){
			 if($stmt->rowcount() != 0)
			 while($row=$stmt->fetchObject()){
				 $affiche= new Affiche($row->idLieu,$row->idSpectacle,$row->dateDebut,$row->dateFin);
				 array_push($affiches,$affiche);
			 }
		 }
		 
		 $pdo=null;
		return $affiches;
}

function displayAffiche($affiche){
	echo "<span>Lieu : ".$affiche->getNomLieu()."</span>";
	echo "</br>";
	echo "<span>du ".$affiche->getDateDebut()." au ".$affiche->getDateFin()."</span>";
	echo "</br>";
}

 //retourne les réprésentations pour un spectacle 
    
    function getRepresentations($spectacle){
		 $representations= array();
		 $pdo = connexion::getInstance();
         $stmt = $pdo->prepare("SELECT * FROM Representation WHERE idSpectacle=:id AND date>=:date ORDER BY date");
         $id=$spectacle->getIdSpectacle();
         $stmt->execute(array(':date'=>date('Y-m-d'), ':id'=>$id));
         if($stmt->rowcount() != 0){
			 while($res = $stmt->fetchObject()) {
				$representation = new Representation($res->idRepresentation, $res->date, $res->heure, $res->reservations, $res->idSpectacle, $res->nomSalle, $res->nomSpectacle, $res->lieu);
				array_push($representations, $representation);
			}
		}
		return $representations;
	}

	//affiche les representations pour un spectacle
	
	function createOption($idRep,$t, $data) {
		echo "<option value=".$idRep.">".$t." ".$data."</option>";
	}
	
	function createSelectRep($representations){
		if(count($representations)>0){
        $pdo = connexion::getInstance();
        $spectacles = getSpectacleById($representations[0]->getIdSpectacle());
        $spectacle = $spectacles[0];
        echo "<div class='representations'>";
        echo "<form action='public/view/reservationView.php' method='post' id='reservation'>";
        echo "<select form='reservation' name='representation'>";
        //createRow("Lieu", $representations[0]->getIdLieu());//pas tout a fait vrai si les representations ne sont pas toutes au meme endroit
        //createRow("Salle", $representations[0]->getSalle()); //pas tout a fait vrai si les representations ne sont pas toutes au meme endroit
			foreach($representations as $representation){
					$idRep=$representation->getIdRepresentation();
					$date=$representation->getDate();
                    $prices = getRepresentationPrice($representation, $pdo);
                    $data2 = "Complet";
                    if(count($prices) != 0) {
                        if(count($prices) == 1) {
                            $data2 = "Prix: ".$prices[0]."€";
                        } else {
                            $data2 = "Prix compris entre ".$prices[0]. "€ et ".$prices[count($prices) - 1]."€";
                        }
                    }
					createOption($idRep,$date, $representation->getHeure()." ".$data2);
			}
        $pdo = null;		
		echo "</select>";
        echo "<input type='submit' value='réserver' class='floatRight'/>";
        echo "</form>";
        echo "</div>";
		}else{
			echo "<span class=representations>pas de représentation programmée</span>";
		}
	}

    function getRepresentationPrice($representation, $pdo) {
        $resultat = [];
        $stmt = $pdo->prepare("SELECT prix FROM Place WHERE idRepresentation=:id AND placeDispo>0 ORDER BY prix");
        $stmt->execute(array(':id'=>$representation->getIdRepresentation()));
        if(count($stmt) != 0) {
            
            while($r = $stmt->fetch(PDO::FETCH_NUM)) {
                array_push($resultat, $r[0]);
            }
        }
        return $resultat;
    }
    

?>
