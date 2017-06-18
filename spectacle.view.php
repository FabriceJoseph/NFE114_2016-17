<?php
include_once 'header.php';
require_once 'functions.php';

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
			
			.description {
				position:relative;
				top:100px;
                border: 1px solid blue;
				box-sizing: border-box;
                margin-right: 50px;
            }
            .representations {
				position:relative;
				border: 1px solid blue;
				top : 200px;
			}	
            
            </style>
	</head>
	<body>
<div class=description>
	<?php displayOne($spectacle); ?>
</div>

<div>
	<?php createTableRep($representations); ?>
</div>
  </body>

</html>

