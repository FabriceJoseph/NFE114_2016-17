<?php

    include_once "../constante.php";

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?= ROOT.'css/index.css'?>" />
        <script type="text/javascript" src="<?= ROOT.'js/jquery/jquery-3.2.0.js'?>"></script>
        <script type="text/javascript" src="<?= ROOT.'js/main.js'?>"></script>
        <title>Espace Pro</title>

        <style rel="stylesheet">

            #proRegistration {
                padding-top: 100px;
            }

        </style>


    </head>
    <body>


    <?php include_once "../header.php";?>

        <form action="" method="post" id="proRegistration">
            <label>Votre identifiant: </label><input type="text" name="log"/>
            <span class="error"></span><br/>
            <label>Votre Password: </label><input type="password" name="pass" />
            <span class="error"></span><br/>
            <input type="submit" value="Sign In" />
        </form>
    </body>


</html>