<?php

include 'protected/database.php';
include 'protected/functions/functions.php';
session_start();
$manager = new UtilisateurManager($bdd);

/* Verification of the login form */
$error = ''; //the error to tell the user the errors committed

/** verify mail input */
if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        $_POST['mail'] = trim(htmlspecialchars($_POST['mail']));
        if (!verif_mail($_POST['mail'])) {
            $error .= 'Le mail n\'est pas valide<br/>';
        }
    } else {
        $error .= "Le champ mail est obligatoire <br />";
    }
}

/** verify password input */
if (isset($_POST['passwd'])) {
    if (empty($_POST['passwd'])) {
        $error .= "Le champ Mot de passe est obligatoire <br />";
    }
}

/** Verifying login form */
if ($error == '') {
    if ($_POST['login_submitted'] == 1) {
        $user = $manager->login($_POST['mail'], $_POST['passwd']);

        if ($user) {
            $_SESSION['id'] = $user->getId();
            $_SESSION['mail'] = $user->getMail();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['passwd'] = $user->getPasswd();
            $_SESSION['status'] = $user->getStatus();
            $_SESSION['telephone'] = $user->getTelephone();
            $_SESSION['type_util'] = $user->getType_util();
            $_SESSION['activationkey'] = $user->getActivationkey();
            $_SESSION['status'] = $user->getStatus();
//            print_r($_SESSION);
        } else {
            $error .= 'Utilisateur inconnu <br />';
        }
    }
}

$queryString = '?nom=' . trim($_POST['nom']);
$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';


/* The header() function sends a HTTP message 
  The 303 code asks the server to use GET
  when redirecting to another page */
header('HTTP/1.1 303 See Other');

if ($error != '') {
    //Back to register page 
    $next_page = 'login.php';
    //Add error message to the query string
    $queryString .= '&error=' . $error;
    // This message asks the server to redirect to another page
    header('Location: http://' . $server_dir . $next_page . $queryString);
} else {
    if ($_SESSION['status'] == 'activated') {
        header('Location: ' . $_POST['lastpagevisited']);
    } else {
        header('Location: /');
    }
}
?>
