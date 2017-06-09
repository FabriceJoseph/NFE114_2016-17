<?php

    require_once "../../functions.php";
    require_once "../../model/Spectacle.php";

    $error = '';
 
    if(!empty($_GET['error'])) {
        $error = true;
    }   

   
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <link rel="stylesheet" href="http://localhost/nfe114/css/index.css" />
        <script type="text/javascript" src="http://localhost/nfe114/js/jquery/jquery-3.2.0.js"></script>
        <script type="text/javascript" src="http://localhost/nfe114/js/main.js"></script>
        <script type="text/javascript" src="http://localhost/nfe114/js/authentification.js"></script>
        <title>Programmes</title>

        <style>
             #content_wrapper {
                padding-top: 100px;
                
            }
        </style>
    </head>
    <body>

        <?php include_once '../../header.php'; ?>

         <div id="content_wrapper">

            <?php 
                if($error) {
                    echo "<p class='error'>".$_GET['error']."</p>";
                } else {
                    $res = unserialize($_POST['result']);
                    foreach($res as $spec) {
                        echo "<div id='".$spec->idSpectacle."'>";
                        echo "<h1>".$spec->nom."</h1>";
                        echo "<p>A l'affiche jusqu'au: $spec->dateFin";
                        echo "<button>Reserver</button>";
                        echo "</div>";
                    }
                }
            ?>

       </div>

    </body>

</html>