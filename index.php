<?php
    session_start();
	require_once('classload.php');
	include('constante.php');


    if(isset($_GET['error'])) {
        $error = $_GET['error'];

    echo $error;
    }
 
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/index.css" />
        <link rel="stylesheet" href="css/catalogue.css" />
        <script type="text/javascript" src="js/jquery/jquery-3.2.0.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/authentification.js"></script>
        <style>

            #content_wrapper {
                padding-top: 100px;
                
            }

            #content_wrapper h1 {
                float: right;
                clear: both;
                margin-right: 50px;
            }

            .spectacles {
                width: 200px;
                height: 200px;
                background-color: red;
                float: right;
                clear: both;
                margin-right: 50px;
            }
                
        </style>
        <title></title>
    </head>

    <body>
       <?php include_once 'header.php'; ?>

		 <div id="content_wrapper">

            <?php include_once 'content.php'; ?>

		</div>
		
    </body>

</html>
