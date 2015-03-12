<?php
include 'protected/functions/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Le Four</title>
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        include 'include/header.php';
        ?>

        <!--start main content -->
        <section>
            <div id="main" class="plan">
                <h1>Plan du Site</h1>
                <h3>Accueil</h3>
                <ul>
                    <li><a href="/">Page d'Accueil</a></li>
                </ul>

                <h3>Identification</h3>
                <ul>
                    <li><a href="/registration.php">Inscription</a></li>
                    <li><a href="/login.php">Login</a></li>
                    <li><a href="/form/forgotten_passwd.php">Mot de passe perdu/Changement de mot de passe</a></li>
                </ul>

                <h3>Annonces</h3>
                <ul>
                    <li><a href="/form/mo.php">Déposer une annonce</a></li>
                </ul>
                <ul>
                    <li><a href="/offres/">Toutes les offres</a></li>
                    <li><a href="/offres/ile-de-france/">Toutes les offres en Ile de France</a></li>
                </ul>
                <h3>Des questions à nous poser</h3>
                <ul>
                    <li><a href="/contact/info.php">Contactez nous</a></li>
                </ul>

            </div>
        </section>
        <!--end main content -->

        <!--start footer -->
        <?php 
        iplog();
        include 'include/footer.php'; ?>
    </body>
</html>