<?php

//include 'protected/database.php';
//include 'protected/functions/functions.php';

/* * Array of accent characters and their normal form */
$GLOBALS['normalizeChars'] = array(
    'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
    'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
    'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
    'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
    'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
    'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
    'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f', '\'' => '-'
);

/**
 * Removes accents from strings
 * @param type $toClean -  the string to clean
 * @return string - returns in small letters a clean string without accents 
 */
function cleanForShortURL($toClean) {
    $toClean = str_replace('&', '-and-', $toClean);
    $toClean = trim(preg_replace('/[^\w\d_ -]/si', '', $toClean)); //remove all illegal chars
    $toClean = str_replace(' ', '-', $toClean);
    $toClean = str_replace('--', '-', $toClean);

    return strtolower(strtr($toClean, $GLOBALS['normalizeChars']));
}

/**
 * Checks the syntax of a telephone number
 * @param type $tel the telephone number to verify
 * @return boolean TRUE if the telephone has the right syntax, <b>FALSE<b> otherwise.
 * The telephone number can contain at most 10 digits and may be separated in twos by hyphens, dots or space.
 */
function verif_tel($tel) {
    if ((preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $tel))) {
        return TRUE;
    }
    else
        return FALSE;
}

/**
 * Checks the syntax of the mail
 * @param type $mail the mail to verify
 * @return boolean TRUE if the mail has the right syntax, <b>FALSE<b> otherwise.
 */
function verif_mail($mail) {
    if ((preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        }
    }
    else
        return FALSE;
}

/**
 * Checks the syntax of the password
 * @param type $passwd the password to verify
 * @return boolean Returns TRUE if the password has the right syntax, <b>FALSE<b> otherwise.
 * The password must contain either letters(small or big) or numbers  or a mixture of both
 * and must be at least 6 characters long
 */
function verif_passwd($passwd) {
    if ((preg_match("#^[a-zA-Z0-9]{6,50}$#", $passwd))) {
        return TRUE;
    }
    else
        return FALSE;
}

/**
 * Checks the syntax of the name
 * @param type $name the name to verify
 * @return boolean Returns TRUE if the nam has the right syntax, <b>FALSE<b> otherwise.
 * The name must contain rithe letters or numbers or mixture of both and must be atleast 2 characters long
 */
function verif_nom($name) {
    if ((preg_match("#^[a-zA-Z0-9]{2,10}$#", $name))) {
        return TRUE;
    }
    else
        return FALSE;
}

function verif_pobox($pobox) {
    if ((preg_match("#^[0-9]{5}$#", $pobox))) {
        return TRUE;
    }
    else
        return FALSE;
}

function verif_titre($titre) {
    if ((preg_match("#^[a-zA-Z0-9 ]{2,255}$#", $titre))) {
        return TRUE;
    }
    else
        return FALSE;
}

function verif_prix($prix) {
    if ((preg_match("#^[0-9]+$#", $prix))) {
        return TRUE;
    }
    else
        return FALSE;
}

/**
 * Verifies the registration form
 * This functions sets the appropriate message to be returned depending on various cases in the form
 * @return array(string & boolean).
 * Returns an empty message and <b>TRUE</b>if the registration form is filled correctly,
 * error message and <b>FALSE</b> instead
 */
function checkRegistrationForm() {
    $error = TRUE; //the boolean to return
    $message = "";
    /* Verification of the registration form */
    //verify name input
    if (isset($_POST['nom'])) {
        if (!empty($_POST['nom'])) {
            $_POST['nom'] = trim(htmlspecialchars($_POST['nom']));
            if (!verif_nom($_POST['nom'])) {
                $message .= "Le nom n'est pas valide<br />";
                $error = FALSE && $error;
            }
        } else {
            $message .= "Le champ Nom est obligatoire <br />";
            $error = FALSE && $error;
        }
    }

    //verify password input
    if (isset($_POST['passwd'])) {
        if (!empty($_POST['passwd'])) {
            $_POST['passwd'] = htmlspecialchars($_POST['passwd']);
            if (!verif_passwd($_POST['passwd'])) {
                $message .= "Le mot de passe n'est pas valide. 
            Veuillez entrer un mot de passe de 6 carecteres comportant des chiffres ou des lettres<br/>";
                $error = FALSE && $error;
            }
        } else {
            $message .= "Le champ Mot de passe est obligatoire <br />";
            $error = FALSE && $error;
        }
    }

    //verify second password input
    if (isset($_POST['passwdverif'])) {
        if (!empty($_POST['passwdverif'])) {
            $_POST['passwdverif'] = htmlspecialchars($_POST['passwdverif']);
            if ($_POST['passwdverif'] != $_POST['passwd']) {
                $message .= "Les mots de passe ne sont pas identiques<br/>";
                $error = FALSE && $error;
            }
        } else {
            $message .= "Le champ Mot de passe(confirmation) est obligatoire <br />";
            $error = FALSE && $error;
        }
    }

    //verify if an option has been chosen from the radio buttons
    if (!isset($_POST['type_util'])) {
        $message .= "Veuillez selectionnez votre cas (Particulier ou Professionnel)<br />";
        $error = FALSE && $error;
    }

    //verify mail input
    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            $_POST['mail'] = trim(htmlspecialchars($_POST['mail']));
            if (!verif_mail($_POST['mail'])) {
                $message .= 'Le mail n\'est pas valide<br/>';
                $error = FALSE && $error;
            }
        } else {
            $message .= "Le champ mail est obligatoire <br />";
            $error = FALSE && $error;
        }
    }

    //verify telephone input
    if (isset($_POST['telephone'])) {
        if (!empty($_POST['telephone'])) {
            $_POST['telephone'] = trim(htmlspecialchars($_POST['telephone']));
            if (!verif_tel($_POST['telephone'])) {
                $message .= 'Le numero de telephone n\'est pas valide<br/>';
                $error = FALSE && $error;
            }
        }
    }

    /**
     * since the inputting a telephone number is optionnal we have to verify the case when
     * the whole form is correct except that of the telephone input
     */
    if (!empty($_POST['nom']) || !empty($_POST['passwd']) || isset($_POST['type_util']) ||
            !empty($_POST['mail'])) {

        if (verif_mail($_POST['mail']) && verif_passwd($_POST['passwd']) && verif_passwd($_POST['passwdverif']) &&
                ($_POST['passwdverif'] == $_POST['passwd']) && verif_nom($_POST['nom'])) {
            if (isset($_POST['telephone'])) {
                if (!empty($_POST['telephone'])) {
                    $_POST['telephone'] = trim(htmlspecialchars($_POST['telephone']));
                    if (!verif_tel($_POST['telephone'])) {
                        $message .= 'Le numero de telephone n\'est pas valide<br/>';
                        $error = FALSE && $error;
                    }
                }
            }
        }
    }

    return array($message, $error);
}

/**
 * generates a unique id
 * @return string 
 */
function generateUniqueId() {
    return md5(uniqid(rand(), true));
}

/**
 * Verifies the offer form
 * This functions sets the appropriate message to be returned depending on various cases in the form
 * @return array(string & boolean).
 * Returns an empty message and <b>TRUE</b>if the registration form is filled correctly,
 * error message and <b>FALSE</b> instead
 */
function checkOfferForm() {
    $message = TRUE; //the boolean to return
    $error = '';

    /* Verification of the offer form */

    if ($_POST['id_region'] == "none") {
        $message = FALSE && $message;
        $error .= 'Veuillez choisir un region<br  />';
    }


    if ($_POST['id_dept'] == "none") {
        $message = FALSE && $message;
        $error .= 'Veuillez choisir un departement<br  />';
    }

    if ($_POST['categorie'] == "none") {
        $message = FALSE && $message;
        $error .= 'Veuillez choisir une catégorie<br  />';
    }


    if (isset($_POST['titre'])) {
        $_POST['titre'] = trim(htmlspecialchars($_POST['titre']));
        if (!empty($_POST['titre'])) {
            if (!verif_titre($_POST['titre'])) {
                $message = FALSE && $message;
                $error .= 'Le titre doit contenir au moins 8 caracteres<br  />';
            }
        } else {
            $error .= 'Le champ titre est obligatoire<br  />';
        }
    }

    if (isset($_POST['prix'])) {
        $_POST['prix'] = trim(htmlspecialchars($_POST['prix']));
        if (!empty($_POST['prix'])) {
            if (!verif_prix($_POST['prix'])) {
                $message = FALSE && $message;
                $error .= 'Veuillez entrer le prix de l\'offre en chiffres<br  />';
            }
        } else {
            $error .= 'Veuillez entrer le prix de l\'offre<br />';
        }
    }

    return array($message, $error);
}

/**
 *
 * @param type $totalPages - total number of pages needed
 * @param int $offersPerPage - total number of offers we want in a page
 * @return array 
 */
function pagination($totalPages, $offersPerPage) {
    $offersPerPage = 2;
    $numberOfPages = ceil($totalPages / $offersPerPage);

    if (isset($_GET['page'])) {
        $currentPage = intval($_GET['page']);
        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        }
    } else {
        $currentPage = 1;
    }

    $entry = ($currentPage - 1) * $offersPerPage;
    return array($entry, $offersPerPage, $numberOfPages);
}

/**
 * Create a pagination for a page
 * @param type $arr 
 */
function pageNumber($arr) {

    echo '<div class="pagenumber">';
    echo '<ul>';
    if (isset($_GET['page'])) {
        $currentPage = intval($_GET['page']);
        if ($currentPage > $arr[2]) {
            $currentPage = $arr[2];
        }
    } else {
        $currentPage = 1;
    }

    if ($currentPage == 1) {
        echo '<li class="first">premier page</li>';
        echo '<li class="first"> &lt; </li>';
    } else {
        echo '<li class="first"><a href="index.php?page=1">premier page</a></li>';
        echo '<li class="first"><a href="index.php?page=' . ($currentPage - 1) . '"> &lt; </a></li>';
    }

    for ($page = 1; $page <= $arr[2]; $page++) {
        if ($page == $currentPage) {
            echo '<li class="selected">' . $page . '</li>';
        } else {
            echo '<li><a href="index.php?page=' . $page . '">' . $page . '</a></li>';
        }
    }

    if ($currentPage == $arr[2]) {
        echo '<li class="last"> &gt; </li>';
        echo '<li class="last">dernier page</li>';
    } else {
        echo '<li class="last"><a href="index.php?page=' . ($currentPage + 1) . '"> &gt; </a></li>';
        echo '<li class="last"><a href="index.php?page=' . $arr[2] . '">dernier page</a></li>';
    }
    echo '</ul>';
    echo '</div>';
}

/**
 * Send a forgotten mail password to the user
 * @param type $mail
 * @return boolean true on success, flase on failure 
 */
function sendForgottenPasswdMail($mail) {
    $subject = 'Annoncegratuit.com: Reinitialisation de mot de passe';
    $message = "Vous avez perdu votre mot de passe. 
        Veuillez cliquer sur le lien ci-dessus pour le reinitialiser:\r
                        http://annoncegratuit.olympe-network.com/form/forgotten_passwd.php?mail=renew
        \r \r S'il s'agit d'une erreur, ignorez ce message.
                        \r \r Cordialement, \r =============================\r
                        Equipe Annoncegratuit :annoncegratuit.olympe-network.com \r
                        Email: annoncegratuit@olympe-network.com";

    $headers = 'From: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
            'Reply-To: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    return mail($mail, $subject, $message, $headers);
}

/**
 * Indents a text
 * @param type $text
 * @return: Returns the indented text 
 */
function indentText($text) {
    $indentedText = '';

    for ($i = 0, $len = strlen($text); $i < $len; $i++) {
        $indentedText .= $text[$i];
        if (($i != 0) && ($i % 50) == 0) {
            $indentedText .= "\r";
        }
    }
    return $indentedText;
}

/**
 * Saves the ip on the client, the page which the client accessed and the time of access 
 */
function iplog() {
    $date = date('Y-m-d');
    $file = 'iplog';  
    $data = 'page link =' . $_SERVER["SCRIPT_URI"] . '  ip adress =' . $_SERVER['REMOTE_ADDR'] .
            '  date =' . date_in_french($date) . ' a ' . date('H:i:s') . "\n";
    $file = fopen($file, 'a+');
    fputs($file, $data);
    fputs($file, "\n");
    fclose($file);
}

/**
 * Reads the iplog file 
 */
function read() {
    $file = fopen('iplog', 'r+');
    while (($var = fgets($file))) {
        echo $var;
    }
    fclose($file);
}

/**
 *
 * @param type $date the date
 * @return string return date format in french
 */
function date_in_french($date) {
    $week_name = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $month_name = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
        "Septembre", "Octobre", "Novembre", "Décembre");

    $split = preg_split('/-/', $date);
    $year = $split[0];
    $month = round($split[1]);
    $day = round($split[2]);

    $week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
    return $date_fr = $week_name[$week_day] . ' ' . $day . ' ' . $month_name[$month] . ' ' . $year;
}

?>
