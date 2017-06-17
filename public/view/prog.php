<?php
    session_start();
    require_once '../../constante.php';

    require_once '../../functions.php';
    require_once '../../model/Spectacle.php';



    $error = '';
 
    if(!empty($_GET['error'])) {
        $error = true;
    }   

    if(!empty($_POST['session'])) {
        $_SESSION['u'] = 2000;
    }
   
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <link rel="stylesheet" href="http://localhost/nfe114fab/css/index.css" />
        <link rel="stylesheet" href="http://localhost/nfe114fab/css/catalogue.css" />
        <script type="text/javascript" src="http://localhost/nfe114fab/js/jquery/jquery-3.2.0.js"></script>
        <script type="text/javascript" src="http://localhost/nfe114fab/js/main.js"></script>
        <script type="text/javascript" src="http://localhost/nfe114fab/js/authentification.js"></script>
        <title>Programmes</title>

        <style>
             #content_wrapper {
                padding-top: 100px; 
            }

            .spectacle {
				/*position:relative;
				top:100px;*/
                display: inline-block;
                border: 1px solid blue;
				box-sizing: border-box;
                margin-right: 50px;
            }

            .spectacle img {
                width: 150px;
            }

            .representations {
				/*position:relative;*/
                display: inline-block;
                width: 800px;
                vertical-align: top;
                box-sizing: border-box;
				border: 1px solid blue;
			}	

            .floatRight {
                float: right;
            }

            .spectacleContainer {
                margin-bottom: 20px;
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
                        /*echo "<div id='".$spec->idSpectacle."'>";
                        echo "<h1>".$spec->nom."</h1>";
                        echo "<p>A l'affiche jusqu'au: $spec->dateFin";
                        echo "<button>Reserver</button>";
                        echo "</div>";*/
                        
                        echo "<div class='spectacleContainer'>";
                        displayOne($spec);
                        $representations = getRepresentations($spec);
                        createTableRep($representations);
                        echo "</div>";
                    }
                }
            ?>

       </div>

    </body>

</html>