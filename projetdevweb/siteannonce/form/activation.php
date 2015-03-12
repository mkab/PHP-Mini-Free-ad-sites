<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';
//create a new manager
$manager = new UtilisateurManager($bdd);
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Activation</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="/css/style.css" type="text/css">	

</head>

<body> 
    <?php include '../include/header.php'; ?>
    <section>
        <!--start main content -->
        <div id="main" class="wrapper">
            <?php
            //if the user chooses to send an activation message to his mail box
            if ($_GET['sendlink'] == 1) {
                $user = new Utilisateur($_SESSION);
                if ($manager->sendActivationMail($user)) { //send mail to user
                    echo '<p>Un mail de confirmation vous a ete envoye a l\'adresse ' . $user->getMail()
                    . '</p>';
                } else {
                    echo '<p>Erreur d\'envoye de mail de confirmation. Veuillez contactez l\'administrateur</p>';
                }
            } else { // else show the message below
                echo '<p>Votre compte n\'est pas encore activé. Veuillez verifier votre mail.</p>
                <p>Si vou n\'avez pas recu le lien d\'activation sur votre mail,
                <a href="?sendlink=1">cliquer ici</a> pour recevoir de nouveau un lien d\'activation.</p>';
            }
            ?>
        </div>
        <!--end main content -->
    </section>

    <!--start footer -->
    <?php
    include '../include/footer.php';
//    session_unset();
//    session_destroy();
    ?>

</body>
</html>
