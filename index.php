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
        <script type="text/javascript" src="js/carroussel.js"></script>
        <style>

            #content_wrapper {
                padding-top: 80px;
                
            }

            #content_wrapper h1 {
                /*float: right;*/
                /*clear: both;*/
                margin-right: 50px;
            }

            .section_content {
                position: relative;
                display: inline-block;
                width: 600px;
                height: 600px;
                margin-left: 50px;
                overflow: hidden;
                
            }

            .section_content h1 {
                margin-bottom: 15px;
            }

            .spectacles {
                position: absolute;
                display: inline-block;
                /*z-index: -10;*/
                width: 600px;
                height: 300px;
                background-color: grey;
                /*float: right;
                clear: both;*/
                margin-right: 50px;

                border: 1px solid black;
            }

            .spectacles figure {
                display: inline-block;
                vertical-align: top;
                margin-left: 10px;
                margin-top: 10px;
                width: 200px;
                height: 260px;

                border: 1px solid black;
            }

            .spectacles figcaption {
                display: inline-block;
                margin-left: 20px;
                margin-top: 20px;
                font-size: 1.2em;
                border: 1px solid black;
            }

            .bookSpectacle {
                position: relative;
                left: 400px;
                bottom: 50px;
                /*z-index: 700;*/
            }

            .asideTop {
                display: inline-block;
                vertical-align: top;
                 
                width: 200px;
                margin-top: 83px;
                margin-left: 90px;  
                border: 1px solid black;
                
                /*margin-left: 600px;*/
            }

            .asideTop .boldOpt {
                color: red;
                font-weight: bold;
            }

            .asideTop h2 {
                text-align: center;
                font-size: 1.1em;
                margin-bottom: 5px;
            }

            .asideTop select {
                margin-left: 15px;
                margin-bottom: 10px;
            }

            .asideTop input {
                margin-left: 140px;
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
