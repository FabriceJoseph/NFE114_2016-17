<?php

    require_once '../functions.php';

    $err = false;


    if(empty($_POST['searchBoxContent'])) {
        $err = "Il faut remplir le champs de recherche afin d'effectuer une recherche";

    } else if(!empty($_POST['searchCritera'])) {
        $searchCritera = htmlspecialchars($_POST['searchCritera']);
        $searchBoxContent = htmlspecialchars($_POST['searchBoxContent']);

        $result = '';

        switch($searchCritera) {
            case 'spectacle':
                $result = getSpectaclesByName($searchBoxContent);
                break;
            case 'genre':
                $result = getSpectaclesByGenre($searchBoxContent);
                break;
            case 'ville':
                $result = getSpectaclesByVille($searchBoxContent);
                break;
            case 'artiste':
            case 'prix':
                break;
            default:
                $err = "Il semble qu'il y ai un problème sur le choix du critère de sélection";
        }

        $url = 'http://localhost/nfe114/public/view/prog.php';
        $fields = array(
            'result' => $result
        );
        $postvars = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        $result = curl_exec($ch);
        curl_close($ch);

    } else {
        header("Location: http://localhost/nfe114/index.php");
    }


    if($err) {
        header("Location: http://localhost/nfe114/public/view/prog.php?error=$err");
        exit();
    }
    

?>
