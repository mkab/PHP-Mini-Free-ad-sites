<?php

//session_start();
include 'protected/database.php';
include 'protected/functions/functions.php';

$message = ""; //the message to tell the user the errors committed
if ($_POST['form_submitted'] == '1') {
    //User is registering, insert data until we can activate it

    /* Verification of the registration form */
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

    if (isset($_POST['passwdverif'])) {
        if (!empty($_POST['passwdverif'])) {
            $_POST['passwdverif'] = htmlspecialchars($_POST['passwdverif']);
            if ($_POST['passwdverif'] != $_POST['passwd']) {
                $message .= "Les mots de passe ne sont pas identiques<br/>";
            }
        } else {
            $message .= "Le champ Mot de passe(confirmation) est obligatoire <br />";
        }
    }

    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            $_POST['mail'] = htmlspecialchars($_POST['mail']);
            if (!verif_mail($_POST['mail'])) {
                $message .= 'Le mail n\'est pas valide<br/>';
            }
        } else {
            $message .= "Le champ mail est obligatoire <br />";
        }
    }

    if (isset($_POST['telephone'])) {
        if (!empty($_POST['telephone'])) {
            $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
            if (!verif_tel($_POST['telephone'])) {
                $message = $message . 'Le numero de telephone n\'est pas valide<br/>';
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
                        $message = $message . 'Le numero de telephone n\'est pas valide<br/>';
                    } else {
//                        $utilisateur = new Utilisateur($_POST);
//                        $manager = new UtilisateurManager($bdd);

                        $_SESSION['nom'] = $_POST['nom'];
                        $_SESSION['passwd'] = $_POST['passwd'];
                        $_SESSION['type_util'] = $_POST['type_util'];
                        $_SESSION['mail'] = $_POST['mail'];
                        $_SESSION['telephone'] = $_POST['telephone'];
                        $_SESSION['form_submitted'] = $_POST['form_submitted'];

//                        if ($manager->add($utilisateur)) {
//                            $message = "user added";
                        header('Location: verify.php');
//                        }
                    }
                } else {
//                    $utilisateur = new Utilisateur($_POST);
//                    if ($manager->add($utilisateur)) {
                    $message = "user added";
                    $_SESSION['nom'] = $_POST['nom'];
                    $_SESSION['passwd'] = $_POST['passwd'];
                    $_SESSION['type_util'] = $_POST['type_util'];
                    $_SESSION['mail'] = $_POST['mail'];
                    $_SESSION['telephone'] = $_POST['telephone'];
                    $_SESSION['form_submitted'] = $_POST['form_submitted'];
					
					//Sending activation link to the user
                    header('Location: verify.php');
//                    }
                }
            }
        }
    }
}
/* End Verification of the registration form */
?>
