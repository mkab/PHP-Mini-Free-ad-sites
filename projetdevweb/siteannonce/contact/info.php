<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';

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

if (isset($_POST['sujet'])) {
    $_POST['sujet'] = trim(htmlspecialchars($_POST['sujet']));
    if (empty($_POST['sujet'])) {
        $error .= 'Le champ sujet est obligatoire <br />';
    }
}

if (isset($_POST['message'])) {
    $_POST['message'] = trim(htmlspecialchars($_POST['message']));
    if (empty($_POST['message'])) {
        $error .= 'Le champ message est obligatoire <br />';
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
    $next_page = 'info.php';

    if ($error != '') {
//Add error message to the query string
        $queryString .= '?error=' . $error;
// This message asks the server to redirect to another page
        header('Location: http://' . $server_dir . $next_page . $queryString);
    } else {
//Add message to the query string
        $queryString .= '?sent=1';
        $subject = $_POST['sujet'];
        $message = $_POST['message'];
        $headers = 'From: ' . $_POST['mail'] . "\r\n" .
                'Reply-To: ' . $_POST['mail'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        //might put mailto: annoncegratuit@olympe-network.com
        mail('joelmkab@hotmail.fr', $subject, $message, $headers);
        header('Location: http://' . $server_dir . $next_page . $queryString);
    }
}

/** Check if there are errors and set it to $message */
if (!isset($_GET['error']))
    $message = '';
else
    $message = $_GET['error'];
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contactez Nous</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="../css/style.css" type="text/css">	

</head>
<body> 
    <?php include '../include/header.php'; ?>

    <!--start main content -->
    <div id="main" class="wrapper">
        <h1>Nous contacter</h1>
        <article>
            <h4>Veuillez remplir le formulaire ci-dessous</h4>
            <?php
            if (isset($_GET['sent']) && $_GET['sent'] == '1') {
                echo '<p> Votre message a ete envoye</p>';
            }

            if (isset($message) && !empty($message)) {
                echo '<p class="error">' . $message . '</p>';
            }
            ?>
            <form id="myForm" action="info.php" method="post">
                <fieldset>
                    <p>
                        <label class="form_col" for="nom">Nom:</label>
                        <input class="input_form" type="text" name="nom" id="nom" maxlength="50"/>
                    </p>
                    <p>
                        <label class="form_col" for="mail">Adresse mail:</label>
                        <input class="input_form" type="text" name="mail" id="mail" />
                    </p>

                    <p>
                        <label class="form_col" for="sujet">Sujet:</label>
                        <input type="text" name="sujet" id="sujet" size="38" />
                    </p>
                    <p>
                        <label class="form_col" for="message">Message:</label>
                        <textarea rows="10" cols="50" name="message" id="message"></textarea> 
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