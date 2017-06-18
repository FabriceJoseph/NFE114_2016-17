<?php

    require_once 'functions.php';
	

    echo "<section class='section_content'>";
    $nowPlaying = get_default_spectacle();
    $playingSoon = get_default_futur_spectacle();

    echo "</section>";
    quickSearch();



    
   //print_r($nowPlaying);

   //nowPlaying($nowPlaying);

   //print_r($playingSoon);


?>
