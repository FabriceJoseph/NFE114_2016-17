<!--
<?php

    require_once 'php/connexion.php';
    require_once 'model/Spectacle.php';
    require_once 'model/Representation.php';
    require_once 'constante.php';
    require_once 'model/Distribution.php';
	require_once 'model/Affiche.php';


// retrourne les spectacles en cours pour un internaute lambda
    function get_default_spectacle() {
        $pdo = connexion::getInstance();
        $todayDate = date('Y-m-d');
        print_r($todayDate);

        $stmt = $pdo->prepare("SELECT * FROM Spectacle, Illustration WHERE Spectacle.id=Illustration.idSpectacle AND dateDebut<:d AND dateFin>:d");
        $stmt->execute(array(':d'=>$todayDate));

        $resultat = [];
        
        if($stmt->rowcount() != 0) {
            while($res = $stmt->fetchObject()) {
                $spectacle = new Spectacle($res->nom);
                $spectacle->setIdSpectacle($res->id);
                $spectacle->setDateDebut($res->dateDebut);
                $spectacle->setDateFin($res->dateFin);
                $spectacle->setDescription($res->description);
				$spectacle->setIllustration($res->path);
                array_push($resultat, $spectacle);
            }
        }
        $pdo = null;

        nowPlaying($resultat);
        return $resultat;
    }


// retrourne les futurs spectacles pour un internaute lambda
    function get_default_futur_spectacle() {
        $pdo = connexion::getInstance();
        $todayDate = date('Y-m-d');
        $in2weeks = date('Y-m-d', mktime(0,0,0, date('m'), date('d')+14, date('Y')));
        echo '<br/>';

        $stmt = $pdo->prepare("SELECT * FROM Spectacle, Illustration WHERE Spectacle.id=Illustration.idSpectacle AND dateDebut BETWEEN :d AND :d1");
        $stmt->execute(array(':d'=>$todayDate, ':d1'=>$in2weeks));

        $resultat = [];

        if($stmt->rowcount() != 0) {
            while($res = $stmt->fetchObject()) {
               $spectacle = new Spectacle($res->nom);
                $spectacle->setIdSpectacle($res->id);
                $spectacle->setDateDebut($res->dateDebut);
                $spectacle->setDateFin($res->dateFin);
                $spectacle->setDescription($res->description);
                $spectacle->setIllustration($res->path);

                array_push($resultat, $spectacle);
            }
        }
        $pdo = null;

        playingSoon($resultat);
        return $resultat;
    }


//retourne le chemin d'une illustration si elle existe pour un spectacle depuis son id en parametres sinon retourne 0'
    function getSpectacleIllustration($id) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT path FROM Illustration WHERE idSpectacle=:id");
        $stmt->execute(array(':id'=>$id));

        $pdo = null;

        if(count($stmt) != 0) {
            $res = $stmt->fetchColumn(0);
            return $res;
        } else {
            return 0;
        }
    }

    function addIllustrationToSpectacle($spectacles) {
        foreach($spectacles as $spectacle) {
            $res = getSpectacleIllustration($spectacle->getIdSpectacle());
            if($res) {
                $spectacle->setIllustration($res);
            }
        }

        //return $spectacles;
    }


    function nowPlaying($spectacles) {

        if(count($spectacles) != 0) {
            echo "<h1>En ce moment</h1>";
            displaySpectacles($spectacles);
        } else {
            return;
        }
    }

    function playingSoon($spectacles) {
        if(count($spectacles) != 0) {
            echo "<h1>Bientôt</h1>";
            displayFutursSpectacles($spectacles);
        } else {
            return;
        }
    }


//wrapp les spectacles en cours
    function displaySpectacles($spectacles) {
        foreach($spectacles as $spectacle) {
            echo "<div id='".$spectacle->getIdSpectacle()."' class='spectacles'>";
            echo "<figure><img alt='' title='".$spectacle->getNom()."' src=''/></figure>";
            echo "<figcaption>".$spectacle->getNom()."</figcaption>";
            echo "<img src='".$spectacle->getIllustration()."' width='100px' height='130px'/>";
            //echo "<form action='detailSpectacleCtrl.php' method='POST'>";
            echo "<form action='".ROOT."public/controller.php' method='POST'>";
            echo "<input type='hidden' name='nomSpectacle' value='".$spectacle->getNom()."' />";
            echo "<input type='hidden' name='idSpectacle' value='".$spectacle->getIdSpectacle()."' />";
            
            echo "<button class='bookSpectacle' name='detail' value='detail'>En savoir plus</button>";
            echo "</form>";
            echo "</div>";
        }
    }
    
 //wrapp les spectacles futurs
    function displayFutursSpectacles($spectacles) {
        foreach($spectacles as $spectacle) {
            echo "<div id='".$spectacle->getIdSpectacle()."' class='spectacles'>";
            echo "<figure><img alt='' title='".$spectacle->getNom()."' src=''/></figure>";
            echo "<figcaption>".$spectacle->getNom()."</figcaption>";
            echo "<img src='images/".$spectacle->getIllustration()."' width='100px' height='130px'/>";
            echo "</div>";
        }
    }
    
//wrapp un spectacle

	function displayOne($spectacle){
		include_once 'func_fiche_spectacle.php';
		echo "<div class='spectacle'>";
		echo "<figure><img alt='' title='".$spectacle->getNom()."' src='".ROOT.$spectacle->getIllustration()."'/></figure>";
        echo "<figcaption>".$spectacle->getNom()."</figcaption>";
        echo "<p>Résumé :</p>";
        echo "<p>".$spectacle->getDescription()."</p>";
       // echo "<p></p><span>Lieu :</span>";
        //echo "<span>".$spectacle->getSalle()."</span></p>";
        echo "<p>Distribution :</p>";
        displayDistribution($spectacle);
        displayLieux_Dates($spectacle);
		echo "</div>";
	}


//retourne un array de spectacles qui contiennent dans leur nom le nom passé en parametres et qui ont une dateDebut au moins egale a la date du jour
    function getSpectaclesByName($name) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE nom LIKE :name AND (dateDebut<=:date AND dateFin>=:date)");
        $stmt->execute(array(':name'=>'%'.$name.'%', ':date'=>date('Y-m-d')));

        if(count($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }

    function getSpectaclesByGenre($genre) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE dateDebut>=:date AND idGenre IN (SELECT idGenre FROM Genre WHERE nom=:nom)");
        $stmt->exec(array(':date'=>date('Y-m-d'), ':nom'=>$genre));

        if(count($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }

    function getSpectaclesByVille($ville) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE idSpectacle IN (
                               SELECT idSpectacle FROM Affiche WHERE dateDebut>=:date OR (dateDebut<:date AND dateFin>=:date)
                               AND idLieu IN (
                               SELECT idLieu FROM Lieu L, Ville V WHERE V.codePostal=L.codePostal AND lower(V.nom)=lower(:nom)))");
        $stmt->exec(array(':date'=>date('Y-m-d'), ':nom'=>$ville));
        $pdo = null;

        if(num_rows($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }

    function getSpectacleById($id) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE id=:id");
        $stmt->execute(array(':id'=>$id));
        $pdo = null;

        if(count($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }


    function extractSpectacle($statement) {
        $resultatString = '';
        $resultat = [];
        while($res = $statement->fetchObject()) {
            $spectacle = new Spectacle($res->nom, $res->status, $res->idProducteur, $res->dateDebut, $res->idGenre, $res->dateFin, $res->description, $res->id,$res->idDistribution);
            array_push($resultat, $spectacle);
        }

        //$resultatSer = serialize($resultat);
        return $resultat;
    }
    
  /**  
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
	
	function createRow($t, $data) {
		echo "<tr><td>".$t."</td><td>".$data."</td></tr>";
	}
	
	function createTableRep($representations){
		if(count($representations)>0){
        $pdo = connexion::getInstance();
        $spectacles = getSpectacleById($representations[0]->getIdSpectacle());
        $spectacle = $spectacles[0];
        echo "<div class='representations'>";
		//echo "<table class=representations>";
        echo "<table>";
		echo "<tr><th></th><th></th></tr>";
        //createRow("Résumé", $spectacle->getDescription());
        //createRow("Distribution", "rien pour l'instant");
        createRow("Lieu", $representations[0]->getIdLieu());//pas tout a fait vrai si les representations ne sont pas toutes au meme endroit
        createRow("Salle", $representations[0]->getSalle()); //pas tout a fait vrai si les representations ne sont pas toutes au meme endroit
			foreach($representations as $representation){
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
					createRow($date, $representation->getHeure()." ".$data2);
			}
        $pdo = null;		
		echo "</table>";
        echo "<input type='button' name='reserver' value='Reserver'class='floatRight'/>";
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
**/

//effectue une recherche suivant les parametres fournis
    function find($searchBoxContent, $searchCritera) {

        switch($searchCritera) {
            case 'spectacle':
                return getSpectaclesByName($searchBoxContent);
    
            case 'genre':
                return getSpectaclesByGenre($searchBoxContent);
            
            case 'ville':
                return getSpectaclesByVille($searchBoxContent);
                
            case 'artiste':
            case 'prix':
                break;
            default:
                return 0;
        }

    }
    


?>
-->
