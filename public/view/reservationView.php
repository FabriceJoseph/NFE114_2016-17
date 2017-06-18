<?php

    require_once '../reservation.php';
    echo $representation->getIdRepresentation();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href=""/>
        <title>Reservation</title>
    </head>
    <body>

        <div id="content_wrapper">

            <h1>RESERVATION</h1>
            <h2><?= $representation->getNomSpectacle(); ?></h2>
            <p>Date: <?= reformatDate($representation->getDate()); ?></p>
            <p>Heure: <?= reformatHeure($representation->getHeure()) ?></p>
            <p><?= $lieu->getNom(); ?></p>
            <p><?= $lieu->getAdresse(); ?><span><?= $lieu->getCodePostal(); ?></span><span><?= $lieu->getVille(); ?></span></p>
            
            <form action="" method="POST">

                <?php
                    foreach($places as $place) {
                        echo "<p>";
                        echo "<label>Categorie ".$place->getIdCategorie()."</label><label>Prix: ".$place->getPrix()."€</label><input type='checkbox' name='prix[]' value='".$place->getPrix()."'/>";
                        echo "<label>Nombre de Places: </label><input type='text' name='nbrePlace[]' /><label>Nombre de Places Disponibles: ".$place->getPlaceDispo()."</label>";
                        echo "</p>";
                    }
                ?>
                
                <p>Total: <span>0</span>€</p>
            
                <input type="submit" value="Payer"/>
            </form>
        </div>

        
        <?php

            //echo $representation->getNomSpectacle(); 


        ?>
        

    </body>

</html>