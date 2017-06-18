<?php

    session_start();

    session_destroy();
    unset($_SESSION['u']);

    header("Location: http://localhost/nfe114fab/index.php");
    exit();


?>