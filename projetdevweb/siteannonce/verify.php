<?php

include 'protected/database.php';
include 'protected/functions/functions.php';
session_start();
$manager = new UtilisateurManager($bdd);
$data = checkRegistrationForm(); //data[0] is te error message and data[1] is the boolean
$error = ""; //the message to tell the user the errors committed
if ($_POST['form_submitted'] == '1') {
    //User is registering, insert data until we can activate it
    $error = $data[0]; //we get the error message. it is a string
    if($manager->getUserFromMail($_POST['mail'])) {
        $error .= 'Ce mail exite déjà <br />';
    }
    
    $queryString = '?nom=' . trim($_POST['nom']);
    $server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

    /* The header() function sends a HTTP message 
      The 303 code asks the server to use GET
      when redirecting to another page */
    header('HTTP/1.1 303 See Other');

    if ($error != '') {
        //Back to register page 
        $next_page = 'registration.php';
        //Add error message to the query string
        $queryString .= '&error=' . $error;
        // This message asks the server to redirect to another page
        header('Location: http://' . $server_dir . $next_page . $queryString);
    } else {

        echo '<!DOCTYPE html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
            <meta http-equiv="refresh" content="3; url=http://annoncegratuit.olympe-network.com/" >
            <title>Confirmation</title>
            <link rel="stylesheet" type="text/css" href="css/style.css" />
        </head>
        <body>';

        include 'include/header.php';
        echo '<section>';
//        echo '<div class="wrapper">';
        //verifying registration form
        if ($data[1]) {
            $_POST['activationkey'] = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
            $_POST['status'] = 'pending';

            $utilisateur = new Utilisateur($_POST);
            if ($manager->add($utilisateur)) {
                //sending a confirmation mail to the user
                if ($manager->sendActivationMail($utilisateur)) {
                    echo '<p>An email has been sent to ' . $_POST['mail'] . ' with an activation link.
                 Please check your mail to complete registration.</p>';
                    echo '<p>Vous allez etre rediriger vers la page d\'accueil dans 5 seconds...';
                } else {
                    echo "<p>confirmation mail not successfully sent. Please contact joelmkab@hotmail.fr<p>";
                }
            }
        } else {
            echo '<p>Il y a une erreur dans le remplissage du formulaire. Veuillez reesaye encore.<br/>Merci</p>';
        }
//        echo '</div>';
    }
} else {
    echo '<!DOCTYPE html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
            <meta http-equiv="refresh" content="3; url=http://annoncegratuit.olympe-network.com/" >
            <title>Confirmation</title>
            <link rel="stylesheet" type="text/css" href="/css/style.css" />
        </head>
        <body>';
    include 'include/header.php';

    echo '<section>';
    //User isn't registering, check verify code and change activation code to null, status to activated on success
    $queryString = $_SERVER['QUERY_STRING'];

    $user = $manager->getUserFromActivationKey($queryString);
    if ($manager->activateUser($user)) {
        //change the user's session status to activated if the user is already logged in 
        if (isset($_SESSION) && !empty($_SESSION))
            $_SESSION['status'] = 'activated';
        else { // else destroy the session
            session_unset();
            session_destroy();
        }
        echo '<p>Bienvenue ' . $user->getNom() . '! Votre compte est maintenant activer.
            Veuliiez vous connectez de nouveau</p>';
//        echo '</div>';
    }
}
echo '</section>';
include 'include/footer.php';
echo'</body>
</html>';
?>