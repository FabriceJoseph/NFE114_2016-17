<?php
    session_start();
    require_once '../constante.php';
    require_once '../functions.php';


    $err = false;
    if(isset($_POST['searchCritera'])) {
        echo 'je suis pas vide';
        echo $_POST['searchCritera'];
    }
    //echo $_POST['searchBoxContent'];

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

                    $url = URL.'public/view/prog.php';
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


               // $url = URL.'public/view/prog.php';
                $url = 'http://nfe114.localhost/nfe114/public/view/prog.php';
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


?>
