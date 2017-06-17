<?php
/*
ce fichier permet de charger toutes les classes

*/

define('CLASS_DIR','./model/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

?>
