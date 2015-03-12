<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';
$manager = new UtilisateurManager($bdd);
$offermanager = new OffersManager($bdd);
if (!empty($_GET['u']) && !empty($_GET['io']) && !empty($_GET['ot'])) {
    $user_id = $_GET['u'];
    $offer_id = $_GET['io'];
    $offerType = $offermanager->getNameType($_GET['ot']);
    $offerType = strtolower($offerType);

    $user = $manager->getUserFromId($user_id);
    $annonce = $offermanager->getUsersOffer($user_id, $offer_id, $offerType);

    $error = ''; //the error to tell the user the errors committed
    if (isset($_POST['nom'])) {
        if (empty($_POST['nom'])) {
            $error .= "Le champ Nom est obligatoire <br />";
        }
    }

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

//verify telephone input
    if (isset($_POST['telephone'])) {
        if (!empty($_POST['telephone'])) {
            $_POST['telephone'] = trim(htmlspecialchars($_POST['telephone']));
            if (!verif_tel($_POST['telephone'])) {
                $error .= 'Le numero de telephone n\'est pas valide<br/>';
            }
        }
    }

    if (isset($_POST['texte'])) {
        $_POST['texte'] = trim(htmlspecialchars($_POST['texte']));
        if (empty($_POST['texte'])) {
            $error .= 'Le champ texte est obligatoire <br />';
        }
    }

    if (isset($_POST) && !empty($_POST)) {
        $queryString = '';
        $server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

        /* The header() function sends a HTTP message 
          The 303 code asks the server to use GET
          when redirecting to another page */
        header('HTTP/1.1 303 See Other');
//Back to contact page
        $next_page = 'cmel.php?ot=' . $_GET['ot'] . '&u=' . $_GET['u'] . '&io=' . $_GET['io'];

        if ($error != '') {
//Add error message to the query string
            $queryString .= '&error=' . $error;
// This message asks the server to redirect to another page
            header('Location: http://' . $server_dir . $next_page . $queryString);
        } else {
//Add message to the query string
            $queryString .= '&sent=1';
            $subject = 'Annoncegratuit: Reponse a votre offre - ' . $annonce->getTitre();
            $texte = 'Bonjour ' . $user->getNom() . "\r\r" .
                    'Vous avez recu une reponse a propos de votre annonce ' . $annonce->getTitre() . "\r\r" .
                    'Nom: ' . $_POST['nom'] . "\r\r" .
                    'Telephone: ' . $_POST['telephone'] . "\r\r" .
                    'Message: ' . "\r\r" . indentText($_POST['texte']) . "\r\r";

            "Cordialement, \r =============================\r
                        Equipe Annoncegratuit : annoncegratuit-olympe-network.com \r
                        Email:annoncegratuit@olympe-network.com";

            $headers = 'From: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
                    'Reply-To: ' . $_POST['mail'] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($user->getMail(), $subject, $texte, $headers);
            header('Location: http://' . $server_dir . $next_page . $queryString);
        }
    }
}
/** Check if there are errors and set it to $message */
if (!isset($_GET['error']))
    $message = '';
else
    $message = $_GET['error'];

if ($user && $annonce) {
    ?>
    <!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $annonce->getTitre() ?></title>
        <meta name="description" content="description here">
        <meta name="author" content="content here">
        <link rel="stylesheet" href="../css/style.css" type="text/css">	

    </head>
    <body> 
        <?php include '../include/header.php'; ?>

        <!--start main content -->
        <div id="main" class="wrapper">
            <article>
                <?php
                echo '<h2>' . $annonce->getTitre() . '</h2>';
                echo '<Strong>Envoyer un message à ' . $user->getNom() . '</strong><br />';
                echo 'Pensez à indiquer vos coordonnées téléphoniques 
                pour que l\'annonceur puisse vous contacter facilement.';
                if (isset($_GET['sent']) && $_GET['sent'] == '1') {
                    echo '<p> Votre message a ete envoye</p>';
                }

                if (isset($message) && !empty($message)) {
                    echo '<p class="error">' . $message . '</p>';
                }
                ?>
                <form id="myForm" action="<?php echo $next_page ?>" method="post">
                    <fieldset>
                        <p>
                            <label class="form_col" for="nom">Votre nom:</label>
                            <input class="input_form" type="text" name="nom" id="nom" maxlength="50"/>
                        </p>
                        <p>
                            <label class="form_col" for="mail">Votre adresse mail:</label>
                            <input class="input_form" type="text" name="mail" id="mail" />
                        </p>

                        <p>
                            <label class="form_col" for="telephone">Votre téléphone:</label>
                            <input class="input_form" type="text" name="telephone" id="telephone"/> &nbsp; (falcutatif)
                        </p>
                        <p>
                            <label class="form_col" for="texte">Votre Texte:</label>
                            <textarea rows="10" cols="50" name="texte" id="texte"></textarea> 
                        </p>

                        <p><input type="hidden" name="form_submitted" value="1"/></p>
                        <p>
                            <input type="submit" value="Envoyer"/> <input type="reset" value="Réinitialiser le formulaire"/>
                        </p>
                    </fieldset> 
                </form>
            </article>
        </div>
        <!--end main content -->

        <!--start footer -->
        <?php include '../include/footer.php';
        ?>

    </body>
    </html>
<?php } ?>