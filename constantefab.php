<?php


$server=$_SERVER['SERVER_NAME'];
define('SERVER_NAME',$server,true);

define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));

define('ROOT', '/nfe114/');
//define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/nfe114fab/');
 


?>
