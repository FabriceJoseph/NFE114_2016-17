<?php

class connexion {

    private static $user = 'root';
    //julien :private static $pass = 'Misternice1@';
    private static $pass = '';
    private static $db = 'mysql:host=localhost;dbname=nfe114';

    public static function getInstance() {
        $pdo=null;
        try {
            $pdo = new PDO(connexion::getDB(), connexion::getUser(), connexion::getPass());
            $pdo->exec("set names utf8");
        } catch(PDOException $e) {
            echo 'probleme';
            print $e->getMessage();
        }

        return $pdo;
    }

    private static function getUser() {
        return connexion::$user;
    }

    private static function getPass() {
        return connexion::$pass;
    }

    private static function getDB() {
        return connexion::$db;
    }
}



?>
