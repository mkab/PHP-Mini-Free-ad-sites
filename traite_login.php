<?php

include 'protected/database.php';
include 'protected/functions/functions.php';


/* Verification of the login form */
$message = ""; //the message to tell the user the errors committed

if (isset($_POST['nom'])) {
    if (!empty($_POST['nom'])) {
        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        if (!verif_nom($_POST['nom'])) {
            $message .= "Le nom n'est pas valide<br />";
        }
    } else {
        $message .= "Le champ Nom est obligatoire <br />";
    }
}

if (isset($_POST['passwd'])) {
    if (!empty($_POST['passwd'])) {
        $_POST['passwd'] = htmlspecialchars($_POST['passwd']);
        if (!verif_passwd($_POST['passwd'])) {
            $message .= "Le mot de passe n'est pas valide. 
            Veuillez entrer un mot de passe de 6 carecteres comportant des chiffres ou des lettres<br/>";
        }
    } else {
        $message .= "Le champ Mot de passe est obligatoire <br />";
    }
}

if( isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['passwd']) && !empty($_POST['passwd'])) {
    $manager = new UtilisateurManager($bdd);
    $utilisateur = $manager->login($_POST['nom'], $_POST['passwd']);
    
    if($utilisateur) {
        print_r($utilisateur);
    } else {
        echo 'nope';
    }
}
?>
