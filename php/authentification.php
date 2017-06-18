<?php
    session_start();
    require_once 'connexion.php';


    $tableName = "user";

    if(isset($_POST['login']) && isset($_POST['pass'])) {
        $login = htmlspecialchars($_POST['login']);
        $pass = htmlspecialchars($_POST['pass']);

        if(userExists($login)) {
            if(validUser($login, $pass)) {
                $_SESSION['u'] = 2000;
                header('Location: '.URL.'index.php?error=0');
                exit();
            } else {
                header('Location: '.URL.'index.php?error=1');
                exit();
            }
        } else {
            header('Location: '.URL.'index.php?error=2');
            exit();
        }
        
    }

    if(isset($_POST['mailToVerify'])) {
        $mail = htmlspecialchars($_POST['mailToVerify']);
        echo userExists($mail);
    }

    if(isset($_POST['surname']) && isset($_POST['firstname']) && isset($_POST['mail']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
        $surname = htmlspecialchars($_POST['surname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $mail = htmlspecialchars($_POST['mail']);
        $pass1 = htmlspecialchars($_POST['pass1']);
        $pass2 = htmlspecialchars($_POST['pass2']);

        registerNewUser($surname,$firstname, $mail, $pass1, $pass2);
    }

    function userExists($login) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT mail from ".$GLOBALS['tableName']. " WHERE mail=:login");
        $stmt->execute(array(':login'=>$login));
        $pdo = null;
        if($stmt->rowcount() != 0) {
            return true;
        } else {
            return false;
        }
    }

    function validUser($login, $pass) {
        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("SELECT pass FROM ".$GLOBALS['tableName']. " WHERE mail=:login");
        $stmt->execute(array(':login'=>$login));
        $p = $stmt->fetchColumn(0);
        $passH = hash('sha256', $pass);
        if($p == $passH) {
            return true;
        } else {
            return false;
        }

    }

    function registerNewUser($surname, $firstname, $mail, $pass1, $pass2) {
        if(userExists($mail))
            return false;
        if(emptyString($surname)) 
            return false;
        if(emptyString($firstname))
            return false;
        if(strlen(utf8_decode($pass1)) < 8) 
            return false;
        if($pass1 != $pass2)
            return false;

        $pdo = connexion::getInstance();
        $stmt = $pdo->prepare("INSERT INTO ".$GLOBALS['tableName']." (id, mail, pass) VALUES('', :mail, :pass)");
        $passH = hash('sha256', $pass1);
        $stmt->execute(array(':mail'=>$mail, ':pass'=>$passH));
        if($stmt) {
            //echo 'ok';
            header('Location: '.URL.'index.php?error=0');
            exit();
            //return true;
        } else {
            //echo 'pas ok';
            header('Location: '.URL.'index.php?error=3');
            exit();
            //return false;
        } 
            
    }

    function emptyString($s) {
        $len = strlen(trim($s));
        if($len == 0)
            return true;
        else
            return false;
    }
    
?>
