<?php

require('functions.php');
require('model/Reservation.php');
require('model/Representation.php');

if(isset($_POST['detail'])){
	
	$nomSpectacle=$_POST['nomSpectacle'];
	$spectacles=unserialize(getSpectaclesByName($nomSpectacle));
	$spectacle=$spectacles[0];
	$representations=getRepresentations($spectacle);
	include 'spectacle.view.php';
	
	
}


?>
