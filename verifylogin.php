<?php

//phpinfo();
include 'protected/database.php';
include 'protected/functions/functions.php';
session_start();
$manager = new UtilisateurManager($bdd);

/** Verifying login form */
if ($_POST['login_submitted'] == 1) {
    $user = $manager->login($_POST['nom'], $_POST['passwd']);

    $_SESSION['id'] = $user->getId();
    $_SESSION['mail'] = $user->getMail();
    $_SESSION['nom'] = $user->getNom();
    $_SESSION['passwd'] = $user->getPasswd();
    $_SESSION['status'] = $user->getStatus();
    $_SESSION['telephone'] = $user->getTelephone();
    $_SESSION['type_util'] = $user->getType_util();
    $_SESSION['status'] = $user->getStatus();
//    echo $_POST['lastpagevisited'];
//    $site != 'login.php' ? header('Location: index.php') : header('Location: ' . $_SERVER['HTTP_REFERER']);
    if ($_SESSION['status'] == 'activated') {
        header('Location: ' . $_POST['lastpagevisited']);
    } else {
        header('Location: form/mo.php');
    }
}
?>
