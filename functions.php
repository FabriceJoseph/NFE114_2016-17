<?php

    require_once 'php/connexion.php';
    require_once 'model/Spectacle.php';



// retrourne les spectacles en cours pour un internaute lambda
    function get_default_spectacle() {
        $pdo = connexion::getInstance();
        $todayDate = date('Y-m-d');
        print_r($todayDate);

        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE dateDebut<:d AND dateFin>:d");
        $stmt->execute(array(':d'=>$todayDate));

        $resultat = [];
        
        if($stmt->rowcount() != 0) {
            while($res = $stmt->fetchObject()) {
                $spectacle = new Spectacle($res->nom);
                $spectacle->setIdSpectacle($res->id);
                $spectacle->setDateDebut($res->dateDebut);
                $spectacle->setDateFin($res->dateFin);

                array_push($resultat, $spectacle);
            }
        }
        $pdo = null;

        nowPlaying($resultat);
    }


// retrourne les futurs spectacles pour un internaute lambda
    function get_default_futur_spectacle() {
        $pdo = connexion::getInstance();
        $todayDate = date('Y-m-d');
        $in2weeks = date('Y-m-d', mktime(0,0,0, date('m'), date('d')+14, date('Y')));
        echo '<br/>';

        $stmt = $pdo->prepare("SELECT * FROM Spectacle WHERE dateDebut BETWEEN :d AND :d1");
        $stmt->execute(array(':d'=>$todayDate, ':d1'=>$in2weeks));

        $resultat = [];

        if($stmt->rowcount() != 0) {
            while($res = $stmt->fetchObject()) {
               $spectacle = new Spectacle($res->nom);
                $spectacle->setIdSpectacle($res->id);
                $spectacle->setDateDebut($res->dateDebut);
                $spectacle->setDateFin($res->dateFin);

                array_push($resultat, $spectacle);
            }
        }
        $pdo = null;

        playingSoon($resultat);
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
            displaySpectacles($spectacles);
        } else {
            return;
        }
    }


//wrapp les spectacles 
    function displaySpectacles($spectacles) {
        foreach($spectacles as $spectacle) {
            echo "<div id='".$spectacle->getIdSpectacle()."' class='spectacle'>";
            echo "<figure><img alt='' title='".$spectacle->getNom()."' src=''/></figure>";
            echo "<figcaption>".$spectacle->getNom()."</figcaption>";
            echo "<button class='bookSpectacle'>Reserver</button>";
            echo "</div>";
        }
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
            extractSpectacle($stmt);    
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
            extractSpectacle($stmt);    
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

        $resultatSer = serialize($resultat);
        return $resultatSer;
    }



?>