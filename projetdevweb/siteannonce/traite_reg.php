<?php

//session_start();
include 'protected/database.php';
include 'protected/functions/functions.php';

$error = ""; //the message to tell the user the errors committed
if ($_POST['form_submitted'] == '1') {
    //User is registering, insert data until we can activate it

    /* Verification of the registration form */
    if (isset($_POST['nom'])) {
        if (!empty($_POST['nom'])) {
            $_POST['nom'] = htmlspecialchars($_POST['nom']);
            if (!verif_nom($_POST['nom'])) {
                $error .= "Le nom n'est pas valide<br />";
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

    if (isset($_POST['passwdverif'])) {
        if (!empty($_POST['passwdverif'])) {
            $_POST['passwdverif'] = htmlspecialchars($_POST['passwdverif']);
            if ($_POST['passwdverif'] != $_POST['passwd']) {
                $error .= "Les mots de passe ne sont pas identiques<br/>";
            }
        } else {
            $error .= "Le champ Mot de passe(confirmation) est obligatoire <br />";
        }
    }

    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            $_POST['mail'] = htmlspecialchars($_POST['mail']);
            if (!verif_mail($_POST['mail'])) {
                $error .= 'Le mail n\'est pas valide<br/>';
            }
        } else {
            $error .= "Le champ mail est obligatoire <br />";
        }
    }

    if (isset($_POST['telephone'])) {
        if (!empty($_POST['telephone'])) {
            $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
            if (!verif_tel($_POST['telephone'])) {
                $error = $error . 'Le numero de telephone n\'est pas valide<br/>';
            }
        }
    }

    if (!empty($_POST['nom']) || !empty($_POST['passwd']) || isset($_POST['type_util']) ||
            !empty($_POST['mail'])) {

        if (verif_mail($_POST['mail']) && verif_passwd($_POST['passwd']) && verif_passwd($_POST['passwdverif']) &&
                ($_POST['passwdverif'] == $_POST['passwd']) && verif_nom($_POST['nom'])) {
            if (isset($_POST['telephone'])) {
                if (!empty($_POST['telephone'])) {
                    $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
                    if (!verif_tel($_POST['telephone'])) {
                        $error = $error . 'Le numero de telephone n\'est pas valide<br/>';
                    }
                } else {
                    $error .= "user added";
                }
            }
            $error .= 'user added';
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
        $next_page = 'registration.php';
        //Add error message to the query string
        $queryString .= '&error=' . $error;
        // This message asks the server to redirect to another page
        header('Location: http://' . $server_dir . $next_page . $queryString);
    } else {
        $next_page = 'verify.php';
    }
    
}
/* End Verification of the registration form */
?>
