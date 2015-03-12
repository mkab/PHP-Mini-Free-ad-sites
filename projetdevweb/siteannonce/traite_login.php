<?php

include 'protected/database.php';
include 'protected/functions/functions.php';

/* Verification of the login form */
$error = ''; //the error to tell the user the errors committed

if (isset($_POST['nom'])) {
    if (!empty($_POST['nom'])) {
        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        $_POST['nom'] = trim($_POST['nom']);
        if (!verif_nom($_POST['nom'])) {
            $error .= "Le nom n'est pas valide. Veuillez entre un nom de 2 caracteres minimum<br />";
        }
    } else {
        $error .= "Le champ Nom est obligatoire <br />";
    }
}

if (isset($_POST['passwd'])) {
    if (!empty($_POST['passwd'])) {
        $_POST['passwd'] = htmlspecialchars($_POST['passwd']);
        if (!verif_passwd($_POST['passwd'])) {
            $error .= "Le mot de passe n'est pas valide. 
            Veuillez entrer un mot de passe de 6 carecteres comportant des chiffres ou des lettres<br/>";
        }
    } else {
        $error .= "Le champ Mot de passe est obligatoire <br />";
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
} 
else {
    $next_page = 'verifylogin.php';
    
}

//if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['passwd']) && !empty($_POST['passwd'])) {
//    $manager = new UtilisateurManager($bdd);
//    $utilisateur = $manager->login($_POST['nom'], $_POST['passwd']);
//
//    if ($utilisateur) {
//        print_r($utilisateur);
//    } else {
//        echo 'nope';
//    }
//}
?>
