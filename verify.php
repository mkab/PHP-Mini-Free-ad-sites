<?php
include 'protected/database.php';
include 'protected/functions/functions.php';
$manager = new UtilisateurManager($bdd);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="refresh" content="5;url=http://annoncegratuit.olympe-network.com/">
    <title>Confirmation</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <?php
    include 'include/header.php';
    echo '<section>';
    

    //verifying registration form
    if ($_POST['form_submitted'] == '1') {
        if (checkRegistrationForm()) {
            $_POST['activationkey'] = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
            $_POST['status'] = 'verify';

            $utilisateur = new Utilisateur($_POST);
            $to = $utilisateur->getMail();
            $subject = 'Annoncegratuit.com: Registration';
            $message = "Bienvenue sur notre site " . $utilisateur->getNom() . "! \r \r 
                        Vous, ou quelqu'un utilisant votre adresse e-mail, a complété l'inscription à annoncegratuit.olympe-network.com. 
                        Vous pouvez compléter l'inscription en cliquant sur le lien suivant: \r
                        http://annoncegratuit.olympe-network.com/verify.php?" . $utilisateur->getActivationkey() .
                    "\r \r S'il s'agit d'une erreur, ignorez ce message et vous serez retiré de notre liste de diffusion.
                        \r \r Cordialement, \r L'Equipe de annoncegratuit.olympe-network.com";

            $headers = 'From: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
                    'Reply-To: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            //adding the user to the database
            if ($manager->add($utilisateur)) {
                //sending a confirmation mail to the user
                if (mail($to, $subject, $message, $headers)) {
                    echo '<p>An email has been sent to ' . $_POST['mail'] . ' with an activation link.
                 Please check your mail to complete registration.</p>';
                } else {
                    echo "<p>confirmation mail not successfully sent. Please contact joelmkab@hotmail.fr<p>";
                    echo '<p>Vous allez etre rediriger vers la page d\'accueil dans 5 seconds...';
                }
            }
        } else {
            echo '<p>Il y a une erreur dans le remplissage du formulaire. Veuillez reesaye encore.<br/>Merci</p>';
        }
    } else {
        //User isn't registering, check verify code and change activation code to null, status to activated on success
        $queryString = $_SERVER['QUERY_STRING'];

        $user = $manager->getUserFromActivationKey($queryString);
        if ($manager->activateUser($user)) {
            echo '<p>Bienvenue ' . $user->getNom() . '! Votre compte est maintenant activer.</p>';
        }
    }
    echo '<section>';
    include 'include/footer.php';
    ?>

</body>
</html>
