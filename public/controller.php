<?php
    session_start();
    require_once '../constante.php';
    require_once '../functions.php';


    $err = false;
    if(isset($_POST['searchCritera'])) {
        echo 'je suis pas vide';
        echo $_POST['searchCritera'];
    }
    echo $_POST['searchBoxContent'];

//si l'utilisateur effectue une recherche ou à appuyer sur le bouton 'en savoir plus'
    if(!empty($_POST['searchBoxContent']) || !empty($_POST['detail'])) {

        $result = '';

        //si l'utilisateur effectue une recherche
        if(!empty($_POST['searchBoxContent']) && empty($_POST['detail'])) {

            //vérification qu'une checkBox a été cochée'
            if(!empty($_POST['searchCritera'])) {
                $searchCritera = htmlspecialchars($_POST['searchCritera']);
                $searchBoxContent = htmlspecialchars($_POST['searchBoxContent']);
                $result = find($searchBoxContent, $searchCritera);
                //si on a au moins un resultat
                if($result) {

                    addIllustrationToSpectacle($result);
                    $resultSer = serialize($result);

                    $url = 'http://localhost/nfe114fab/public/view/prog.php';
                    $fields = array(
                        'result' => $resultSer,
                        'session' =>$_SESSION
                    );
                    $postvars = http_build_query($fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, count($fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
                    $result = curl_exec($ch);
                    curl_close($ch);

                } else if ($result == 0){
                    $err = 'Il semble y avoir une erreur dans le critère de sélection';
                } else {
                    $err = 'Aucun résultat';
                }
            }

        // si l'utilisateur a appuyé sur le bouton 'en savoir plus'
        } else if(empty($_POST['searchBoxContent']) && !empty($_POST['detail'])) {

            $idSpectacle = htmlspecialchars($_POST['idSpectacle']);
            $result = getSpectacleById($idSpectacle);

            if($result) {

                addIllustrationToSpectacle($result);
                $resultSer = serialize($result);


                $url = 'http://localhost/nfe114fab/public/view/prog.php';
                    $fields = array(
                        'result' => $resultSer,
                        'session' =>$_SESSION
                    );
                    $postvars = http_build_query($fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, count($fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
                    $result = curl_exec($ch);
                    curl_close($ch);

            }

        } else {
            echo "Probleme 1";
        }
    } else {
        echo "Probleme 2";
    }

    if(!empty($_POST['quickSearchLaunch'])) {
        $nbreCritera = 0;
        $genre = 0;
        $ville = 0;
        $artiste = 0;
        $prix = 0;
        if(isset($_POST['quickGenre'])) {
            $genre = htmlspecialchars($_POST['quickGenre']);
            if($genre != "Genre") {
                $nbreCritera++;
            } else {
                $genre = 0;
            }
        }
        if(isset($_POST['quickVille'])) {
            $ville = htmlspecialchars($_POST['quickVille']);
            if($ville != "Ville") {
                $nbreCritera++;
            } else {
                $ville = 0;
            }
        }
        if(isset($_POST['quickArtiste'])) {
            $artiste = htmlspecialchars($_POST['quickArtiste']);
            if($artiste != "Artiste") {
                $nbreCritera++;
            } else {
                $artiste = 0;
            }
        }
        if(isset($_POST['quickPrix'])) {
            $prix = htmlspecialchars($_POST['quickPrix']);
            if($prix != "Prix") {
                $nbreCritera++;
            } else {
                $prix = 0;
            }
        }
        if($nbreCritera != 1) {
            echo "Erreur dans le choix du critère";
        } else {
           $result = '';
           $searchCritera = '';
           $searchValue = '';
           if($genre) {
               $searchCritera = "Genre";
               $searchValue = $genre;
           }
           if($ville) {
               $searchCritera = "Ville";
               $searchValue = $ville;
           }
           if($artiste) {
               $searchCritera = "Artiste";
               $searchValue = $artiste; 
           }
           if($prix) {
               $searchCritera = "Prix";
               $searchValue = $prix;
           }
           if($searchCritera) {
                echo "Critera: ".$searchCritera;
                echo "Value: ".$searchValue;
                $result = quickSearch2($searchCritera, $searchValue);
           } else {
               echo "Erreur dans le choix du critère 2ième erreur";
           }

           if($result) {

                addIllustrationToSpectacle($result);
                $resultSer = serialize($result);


                $url = 'http://localhost/nfe114fab/public/view/prog.php';
                    $fields = array(
                        'result' => $resultSer,
                        'session' =>$_SESSION
                    );
                    $postvars = http_build_query($fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, count($fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
                    $result = curl_exec($ch);
                    curl_close($ch);

            }
        }
    }

    


?>
