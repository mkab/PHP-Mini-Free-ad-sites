<?php

include 'conf/conf.php';

function loadClass($classe) {
    require 'classes/' . $classe . '.class.php';
}

spl_autoload_register('loadClass');

$dbConf = new DBConf();

$databaseURL = $dbConf->getDatabaseURL();
$databaseUserName = $dbConf->getDatabaseUserName();
$databasePWord = $dbConf->getDatabasePWord();
$databaseName = $dbConf->getDatabaseName(); 

////Set DB Info. in-session
//$_SESSION['databaseURL'] = $databaseURL; //localhost
//$_SESSION['databaseUserName'] = $databaseUserName; //root
//$_SESSION['databasePWord'] = $databasePWord; // ''
//$_SESSION['databaseName'] = $databaseName; // projetdevweb


//
//
//$bdd = new PDO('mysql:host=' . $_SESSION['databaseURL'] . ';dbname=' . $_SESSION['databaseName'],
//                $_SESSION['databaseUserName'], $_SESSION['databasePWord']);
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//$manager = new PersonnagesManager($bdd);

$bdd = new PDO('mysql:host=' . $databaseURL . ';dbname=' . $databaseName, $databaseUserName, $databasePWord);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//$manager = new UtilisateurManager($bdd);
?>
