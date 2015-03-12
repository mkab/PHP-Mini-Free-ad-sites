<?php

include '../protected/database.php';
include '../protected/functions/functions.php';
$error = ""; //error messages
$valid = ""; //valid messages
$manager = new UtilisateurManager($bdd);
if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        $_POST['mail'] = trim(htmlspecialchars($_POST['mail']));
        if (verif_mail($_POST['mail'])) {
            if (!$manager->getUserFromMail($_POST['mail']) && !empty($_POST['mail'])) {
                $error = "Cette mail n'existe pas dans notre base de donnees<br>";
            } else {
                $valid = 'true';
            }
        } else {
            $error = 'Le mail n\'est pas valide<br/>';
        }
    } else {
        $error = "Veuillez entrez votre email<br />";
    }
}

$queryString = '?mail=' . trim($_POST['mail']);
$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

/* The header() function sends a HTTP message 
  The 303 code asks the server to use POST
  when redirecting to another page */
header('HTTP/1.1 303 See Other');

if ($error != '') {
    $next_page = 'forgotten_passwd.php';
    //Add error message to the query string
    $queryString .= '&error=' . $error;
} else if ($valid == 'true') {
    $next_page = 'changepassword.php';
    $queryString .= '&valid=' . $valid;
}
// This message asks the server to redirect to another page
header('Location: http://' . $server_dir . $next_page . $queryString);
?>
