<?php

    require_once 'php/connexion.php';
    require_once 'model/Spectacle.php';
    require_once 'model/Representation.php';
    require_once 'model/Lieu.php';
    require_once 'model/Place.php';
    require_once 'constante.php';



// retrourne les spectacles en cours pour un internaute lambda
    function get_default_spectacle() {
        $pdo = connexion::getInstance();
        $todayDate = date('Y-m-d');

        //print_r($todayDate);

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
            echo "<h1>A l'affiche</h1>";
            displaySpectacles($spectacles);
        } else {
            return;
        }
    }

    function playingSoon($spectacles) {
        if(count($spectacles) != 0) {
            echo "<h1>Prochainement</h1>";
            displayFutursSpectacles($spectacles);
        } else {
            return;
        }
    }


//wrapp les spectacles en cours
    function displaySpectacles($spectacles) {
        foreach($spectacles as $spectacle) {

            echo "<article id='".$spectacle->getIdSpectacle()."' class='spectacles spectacleTop'>";
            echo "<figure>";
            //echo "<img alt='' title='".$spectacle->getNom()."' src=''/></figure>";
            echo "<img alt='' title='".$spectacle->getNom()."' src='".$spectacle->getIllustration()."' width='200px' height='260px'/>";
            echo "</figure>";
            echo "<figcaption>".$spectacle->getNom()."</figcaption>";
            //echo "<img alt='' title='".$spectacle->getNom()."' src='".$spectacle->getIllustration()."' width='200px' height='260px'/>";
            //echo "<form action='detailSpectacleCtrl.php' method='POST'>";
            echo "<form action='".ROOT."public/controller.php' method='POST'>";
            echo "<input type='hidden' name='nomSpectacle' value='".$spectacle->getNom()."' />";
            echo "<input type='hidden' name='idSpectacle' value='".$spectacle->getIdSpectacle()."' />";
            
            echo "<button class='bookSpectacle' name='detail' value='detail'>En savoir plus</button>";
            echo "</form>";
            echo "</article>";
        }
    }
    
 //wrapp les spectacles futurs
    function displayFutursSpectacles($spectacles) {
        foreach($spectacles as $spectacle) {
            echo "<article id='".$spectacle->getIdSpectacle()."' class='spectacles'>";
            echo "<figure><img alt='' title='".$spectacle->getNom()."' src=''/></figure>";
            echo "<figcaption>".$spectacle->getNom()."</figcaption>";
            echo "<img src='images/".$spectacle->getIllustration()."' width='200px' height='260px'/>";
            echo "</article>";
        }
    }

    function quickSearch() {
        echo "<div id='quickSearch' class='asideTop'>";
        echo "<form action='".ROOT."public/controller.php' method='POST'>";
        echo "<h2>Recherche Rapide</h2>";
        $genres = getAllGenreByNom();
        echo displayQuickSearchSelect("Genre", $genres, "quickGenre");
        $villes = getAllVilleByName();
        echo displayQuickSearchSelect("Ville", $villes, "quickVille");
        $artistes = getAllArtistesByName();
        echo displayQuickSearchSelect("Artiste", $artistes, "quickArtiste");
        $prix = array('10 - 20', '20 - 30', '30 - 40', '40 - 50', '50 - 60', '60 - 70', '70 - 80', '80 - 90', '90 - 100');
        echo displayQuickSearchSelect("Prix", $prix, "quickPrix");
        echo "<input type='submit' value='Lancer' name='quickSearchLaunch'/>";
        echo "</form>";
        echo "</div>";

    }

    function displayQuickSearchSelect($title, $data, $name) {
        $resultat = "<select name='".$name."'>";
        $resultat .= "<option>".$title."</option>";
        if($data) {
            foreach($data as $d) {
            $resultat .= "<option value='".$d."'>".$d."</option>";
            }
        }
        
        $resultat .= "</optgroup>";
        $resultat .= "</select>";
        $resultat .= "<br/>";

        return $resultat;
    }

// recupère tous les genres connu en bdd par leur nom
    function getAllGenreByNom() {
        $resultat = []; 
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT DISTINCT nom FROM Genre");
        $stmt->execute();
        $pdo = null;

        if($stmt->rowcount() != 0) {
            while($r = $stmt->fetch(PDO::FETCH_NUM)) {
                array_push($resultat, $r[0]);
            }
        } else {
            return 0;
        }

        return $resultat;
    }

    function getAllArtistesByName() {
        $resultat = [];
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT DISTINCT nom FROM Artiste");
        $stmt->execute();
        $pdo = null;

        if($stmt->rowcount() != 0) {
            while($r = $stmt->fetch(PDO::FETCH_NUM)) {
                array_push($resultat, $r[0]);
            }
        } else {
            return 0;
        }

        return $resultat;
    }

//retourne toutes les villes connues par nom
    function getAllVilleByName() {
        $resultat = [];
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT DISTINCT ville FROM Lieu");
        $stmt->execute();
        $pdo = null;

        if($stmt->rowcount() != 0) {
            while($r = $stmt->fetch(PDO::FETCH_NUM)) {
                array_push($resultat, $r[0]);
            }
        } else {
            return 0;
        }

        return $resultat;
    }
    
//wrapp un spectacle

	function displayOne($spectacle){
		echo "<div class='spectacle'>";
		echo "<figure><img alt='' title='".$spectacle->getNom()."' src='".ROOT.$spectacle->getIllustration()."'/></figure>";
        echo "<figcaption>".$spectacle->getNom()."</figcaption>";
        //echo "<figcaption>".$spectacle->getDescription()."</figcaption>";
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
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE (dateDebut<=:date) AND (idGenre IN (SELECT idGenre FROM Genre WHERE nom=:nom))");
        $stmt->execute(array(':date'=>date('Y-m-d'), ':nom'=>$genre));

        if($stmt->rowcount() != 0) {
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
        $stmt->execute(array(':date'=>date('Y-m-d'), ':nom'=>$ville));
        $pdo = null;

        if(num_rows($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }

    function getSpectaclesByArtiste($artiste) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE idSpectacle IN (
                               SELECT Af.idSpectacle FROM Affiche Af Artiste Ar WHERE Af.dateDebut>=:date OR (Af.dateDebut<:date AND Af.dateFin>=:date)
                               AND Af.idArtiste = Ar.idArtiste AND Ar.nom=:nom)");
        $stmt->execute(array(':date'=>date('Y-m-d'), ':nom'=>$artiste));
        $pdo = null;

        if(num_rows($stmt) != 0) {
            return extractSpectacle($stmt);    
        } else {
            return 0;
        }
    }

    function getSpectaclesByPrix($prixBas, $prixHaut) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE idSpectacle IN (
                               SELECT idSpectacle FROM Affiche WHERE dateDebut>=:date OR dateDebut<:date AND dateFin>=:date) AND idLieu IN (
                               SELECT DISTINCT R.idLieu FROM Representation R Place P WHERE (R.idRepresentaion=P.idRepresentation) AND
                               (P.prix BETWEEN :prixB AND :prixH)))");
        $stmt->execute(array(':date'=>date('Y-m-d'), ':prixB'=>$prixBas, ':prixH'=>$prixHaut));
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
            $spectacle = new Spectacle($res->nom, $res->status, $res->idProducteur, $res->dateDebut, $res->idGenre, $res->dateFin, $res->description, $res->id);
            array_push($resultat, $spectacle);
        }

        //$resultatSer = serialize($resultat);
        return $resultat;
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

//retourne une representation depuis l'id en parametre'
    function getRepresentationById($id) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Representation WHERE idRepresentation=:id");
        $stmt->execute(array(':id'=>$id));
        $pdo = null;
        if($stmt->rowcount() != 0) {
            $res = $stmt->fetchObject();
            $representation = new Representation($res->idRepresentation, $res->date, $res->heure, $res->reservations, $res->idSpectacle, $res->nomSalle, $res->nomSpectacle, $res->lieu);
            return $representation;
        }

        return 0;
    }

    function getLieuById($id) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Lieu WHERE idLieu=:id");
        $stmt->execute(array(':id'=>$id));
        $pdo = null;
        if($stmt->rowcount() != 0) {
            $res = $stmt->fetchObject();
            $lieu = new Lieu($res->nom, $res->adresse, $res->codePostal, $res->ville);
            return $lieu;
        }

        return 0;
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
        createRow("Résumé", $spectacle->getDescription());
        createRow("Distribution", "rien pour l'instant");
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

    function getPlacesByRepresentation($representation) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Place WHERE idRepresentation=:id AND placeDispo>0 ORDER BY prix");
        $v = $representation->getIdRepresentation();
        $stmt->execute(array(':id'=>$v));
        if($stmt->rowcount() != 0) {
            $resultat = [];
            while($res=$stmt->fetchObject()) {
                $place = new Place($res->idRepresentation, $res->idCategorie, $res->capacite, $res->placeDispo, $res->prix);
                array_push($resultat, $place);
            }

            return $resultat;
        }
        return 0;
    }


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

    function quickSearch2($critera, $value) {
        $result = '';
        switch($critera) {
            case 'Genre':
            $result = getSpectaclesByGenre($value);
            //recherche par genre;
            break;
            case 'Ville':
            //recherche par ville
            break;
            case 'Artiste':
            $result =  getSpectaclesByArtiste($value);
            //recherche par artiste
            break;
            case 'Prix':
            $ar = explode('-', $value);
            $pStr1 = trim($ar[0]);
            $pStr2 = trim($ar[1]);
            $intPrixBas = intval($pStr1);
            $intPrixHaut = intval($pStr2);
            $result =  getSpectaclesByPrix($intPrixBas, $intPrixHaut);
            //recherche par prix
            break;
        }
        return $result;
    }



    function reformatDate($date) {
        $dateArray = explode('-', $date);
        $annee = $dateArray[0];
        $mois = getMois($dateArray[1]);
        $jour = $dateArray[2];

        $dateReformat = $jour." ".$mois." ".$annee;

        return $dateReformat;
    }

    function getMois($mois) {
        switch(intval($mois)) {
            case 1:
            return "janvier";
            break;
            case 2:
            return "février";
            break;
            case 3:
            return "mars";
            break;
            case 4:
            return "avril";
            break;
            case 5:
            return "mai";
            break;
            case 6:
            return "juin";
            break;
            case 7:
            return "juillet";
            break;
            case 8:
            return "aout";
            break;
            case 9:
            return "septembre";
            break;
            case 10:
            return "octobre";
            break;
            case 11:
            return "novembre";
            break;
            case 12:
            return "decembre";
            break;
        }
    }

    function reformatHeure($heure) {
        $heureArray = explode(':', $heure);
        $heure = $heureArray[0];
        $minute = $heureArray[1];

        $heureReformat = $heure." H ".$minute;

        return $heureReformat;
    }

?>
