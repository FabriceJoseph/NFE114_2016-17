<?php

    session_start();

	require_once 'constante.php';

    session_destroy();
    unset($_SESSION['u']);

    header("Location: ".URL."index.php");
    exit();


?>
