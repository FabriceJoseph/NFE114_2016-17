<?php
    
    require_once '../../constante.php';
    require_once '../../functions.php';
    session_start();
    //require_once '../../model/Representation.php';
    //require_once '../../model/Lieu.php';

    
    $representation = '';
    $lieu = '';
    $places = [];

    if(!isset($_POST['prix']) && !isset($_POST['nbrePlace'])) {
        $representation = getRepresentationById(1);
        
        if(!$representation) {
            echo "erreur pas trouve de representation";
        } else {
            $lieu = getLieuById($representation->getIdLieu());
            $places = getPlacesByRepresentation($representation);
            $_SESSION['representation'] = $representation;
            $_SESSION['lieu'] = $lieu;
            $_SESSION['places'] = $places;
        }
    }

    if(!empty($_POST['prix']) && !empty($_POST['nbrePlace'])) {
        var_dump ($_POST['prix']);
        var_dump ($_POST['nbrePlace']);
        $GLOBALS['representation'] = $_SESSION['representation'];
        $GLOBALS['lieu'] = $_SESSION['lieu'];
        $GLOBALS['places'] = $_SESSION['places'];
        echo "representation encore: ".$representation->getIdRepresentation();
    }

    
    function checkReservation($prix, $nbrePlace) {
       $err = checkParam($prix, $nbrePlace);
       if($err) {
           handlerError($err);
           return;
       }
       $err2 = checkOrder($prix, $nbrePlace);
       if($err2) {
           handlerError($err);
           return;
       }
       // si on arrive ici l'ensemble des vérifications du programme a été passé avec succés on peut valider la reservation'
       // et attendre confirmation du paiement pour mettre a jour la bdd et envoter mail au client
       // avec récapitulatif de sa commnande
       // pour le moment on se contente de rediriger vers une page de connexion
       // cas de l'internaute inconnu et pas d'un client authentifié' 
       header("Location: http://localhost/nfe114fab/public/connexion.php");
    } 

// vérifie la taille des tableaux envoyés par le client
    function checParam($prix, $nbrePlace) {
        if(count($prix) > 4 || count($nbrePlace) > 4) {
            return 1;
        } else if(count($prix) == 0) {
            return 2;
        } else if(count($nbrePlaces) != 4) {
            return 3;
        } else {
            return 0;
        }  
    }

//parcourt les tableaux pour vérification
    function checkOrder($prix, $nbrePlace) {
        $l = count($prix);
        $err = 0;
        for($i = 0; $i < $l; $i++) {
            $p = htmlspecialchars($prix[$i]);
            $index = getPrixIndex($p);
            if($index == -1) {
                $err = 6;
                break;
            }
            $nbPlace = htmlspecialchars($nbrePlace[$index]);
            $err = checkInput($p, $nbPlace);
            if($err) {
                break;
            }
        }
        return $err; 
    }

//vérifie les couples prix, et nombre de places 
    function checkInput($p, $nbPlace) {
        $prixCorrect = false;
        foreach($places as $plce) {
            if($plce->getPrix() != $p)
                continue;
            else {
                if($nbPlace > 0 && $nbPlace < $plce->getPlaceDispo()) {
                    //il faudrait completer la Reservation du client
                    return 0; // la ligne de commande a l'air correct'
                } else {
                    if($nbPlace <=0) {
                        return 4;
                    } 
                    if($nbPlace < $plce->getPlaceDispo()) {
                        return 5;
                    }
                }
            }
        }
    }

    function getPrixIndex($p) {
        $index = -1;
        for($i = 0, $l = count($places); $i < $l; $i++) {
            if($p == $places->getPrix()) {
                $index = $i;
                break;
            }
        }
        return $index;
    }

    function handlerError($err) {
        switch($err) {
            case 1:
            //retourner info erreur sur la longueur des tableaux trop longs
            break;
            case 2:
            //retourner info erreur aucune checkbox cochéé
            break;
            case 3:
            //erreur sur le nombre de input text attendu pour le nombre de places a commander
            break;
            case 4:
            // la commande souhaite commander un nombre négatif ou null de places
            break;
            case 5:
            // la commande souhaite commander plus de places qu'il est diponible dans la categorie';
            break;
            case 6:
            // ce prix n'est pas connu pour la representation
            break;
        }
    }

?>