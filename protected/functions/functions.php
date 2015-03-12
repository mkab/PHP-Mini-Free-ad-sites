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
        return TRUE;
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
 * The name must contain letters or numbers or mixture of both and must be atleast 2 characters long
 */
function verif_nom($name) {
    if ((preg_match("#^[a-zA-Z0-9]{2,10}$#", $name))) {
        return TRUE;
    }
    else
        return FALSE;
}

/**
 * Checks the syntax of the Postal Code
 * @param type $pobox the pobox to verify
 * @return boolean Returns TRUE if the pobox has the right syntax, <b>FALSE<b> otherwise.
 * The pobox must contain only numbers and must be 5 characters long
 */
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

/**
 * Checks the price entered by the user
 * @param type $prix the price to verify
 * @return boolean Returns TRUE if the price has the right syntax, <b>FALSE<b> otherwise.
 * The price should contain only numbers
 */
function verif_prix($prix) {
    if ((preg_match("#^[0-9]+$#", $prix))) {
        return TRUE;
    }
    else
        return FALSE;
}

/**
 * Verifies the registration form
 * @return boolean Returns <b>TRUE</b> if the registration form is filled correctly, <b>FALSE</b> otherwise
 */
function checkRegistrationForm() {
    $message = TRUE; //the boolean to return

    /* Verification of the registration form */
    if (isset($_POST['nom'])) {
        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        $_POST['nom'] = stripslashes($_POST['nom']);
        if (!verif_nom($_POST['nom'])) {
            $message = FALSE && $message;
        }
    }


    if (isset($_POST['passwd'])) {
        $_POST['passwd'] = htmlspecialchars($_POST['passwd']);
        $_POST['passwd'] = stripslashes($_POST['passwd']);
        if (!verif_passwd($_POST['passwd'])) {
            $message = FALSE && $message;
        }
    }

    if (isset($_POST['passwdverif'])) {
        $_POST['passwdverif'] = htmlspecialchars($_POST['passwdverif']);
        if ($_POST['passwdverif'] != $_POST['passwd'] && !verif_passwd($_POST['passwdverif'])) {
            $message = FALSE && $message;
        }
    }

    if (isset($_POST['mail'])) {
        $_POST['mail'] = htmlspecialchars($_POST['mail']);
        if (!verif_mail($_POST['mail'])) {
            $message = FALSE && $message;
        }
    }

    if (isset($_POST['telephone'])) {
        $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
        if (!empty($_POST['telephone'])) {
            if (!verif_tel($_POST['telephone'])) {
                $message = FALSE && $message;
            }
        }
    }



    if (verif_mail($_POST['mail']) && verif_passwd($_POST['passwd']) && verif_passwd($_POST['passwdverif']) &&
            ($_POST['passwdverif'] == $_POST['passwd']) && verif_nom($_POST['nom'])) {
        if (isset($_POST['telephone'])) {
            if (!empty($_POST['telephone'])) {
                $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
                if (!verif_tel($_POST['telephone'])) {
                    $message = FALSE && $message;
                }
            }
        }
    }

    return $message;
}

/**
 * generates a unique id
 * @return string 
 */
function generateUniqueId() {
    return md5(uniqid(rand(), true));
}

/**
 * Verifies the "Create offer" form
 * @return boolean Returns <b>TRUE</b> if the form is filled correctly, <b>FALSE</b> otherwise
 */
function checkOfferForm() {
    $message = TRUE; //the boolean to return

    /* Verification of the registration form */
    if (isset($_POST['region'])) {
        $_POST['region'] = htmlspecialchars($_POST['region']);
        $_POST['region'] = stripslashes($_POST['region']);
        if ($_POST['region'] == '-1') {
            $message = FALSE && $message;
        }
    }


    if (isset($_POST['dept'])) {
        $_POST['dept'] = htmlspecialchars($_POST['dept']);
        $_POST['dept'] = stripslashes($_POST['dept']);
        if ($_POST['dept'] == '-1') {
            $message = FALSE && $message;
        }
    }

    if (isset($_POST['pobox'])) {
        $_POST['pobox'] = htmlspecialchars($_POST['pobox']);
        if (!verif_pobox($_POST['pobox'])) {
            $message = FALSE && $message;
        }
    }

    if (isset($_POST['titre'])) {
        $_POST['titre'] = htmlspecialchars($_POST['titre']);
        if (!empty($_POST['titre'])) {
            if (!verif_titre($_POST['titre'])) {
                $message = FALSE && $message;
            }
        }
    }

    if (isset($_POST['prix'])) {
        $_POST['prix'] = htmlspecialchars($_POST['prix']);
        if (!empty($_POST['prix'])) {
            if (!verif_prix($_POST['prix'])) {
                $message = FALSE && $message;
            }
        }
    }

    return $message;
}

function get_zip_info($zip) {
//Function to retrieve the contents of a webpage and put it into $pgdata
    $pgdata = ""; //initialize $pgdata
// Open the url based on the user input and put the data into $fd:
    $fd = fopen("http://zipinfo.com/cgi-local/zipsrch.exe?zip=$zip", "r");
    while (!feof($fd)) {//while loop to keep reading data into $pgdata till its all gone
        $pgdata .= fread($fd, 1024); //read 1024 bytes at a time
    }
    fclose($fd); //close the connection
    if (preg_match("/is not currently assigned/", $pgdata)) {
        $city = "N/A";
        $state = "N/A";
    } else {
        $citystart = strpos($pgdata, "Code</th></tr><tr><td align=center>");
        $citystart = $citystart + 35;
        $pgdata = substr($pgdata, $citystart);
        $cityend = strpos($pgdata, "</font></td><td align=center>");
        $city = substr($pgdata, 0, $cityend);

        $statestart = strpos($pgdata, "</font></td><td align=center>");
        $statestart = $statestart + 29;
        $pgdata = substr($pgdata, $statestart);
        $stateend = strpos($pgdata, "</font></td><td align=center>");
        $state = substr($pgdata, 0, $stateend);
    }
    $zipinfo['zip'] = $zip;
    $zipinfo['city'] = $city;
    $zipinfo['state'] = $state;
    return $zipinfo;
}

?>
