<?php
include '../protected/database.php';
include '../protected/functions/functions.php';
$manager = new UtilisateurManager($bdd);
if (isset($_POST['mail']) && !empty($_POST['mail'])) {
    $mail = trim($_POST['mail']);
}

$message = '';
$queryString = '?mail=' . trim($mail);
if (isset($_POST['passwd'])) {
    if (!empty($_POST['passwd'])) {
        $_POST['passwd'] = htmlspecialchars($_POST['passwd']);
        if (!verif_passwd($_POST['passwd'])) {
            $message .= "Veuillez entrer un mot de passe de 6 carecteres comportant des chiffres ou des lettres<br/>";
        }
    } else {
        $message .= "Le champ Mot de passe est obligatoire <br />";        
    }
}

//verify second password input
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

$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
/* The header() function sends a HTTP message 
  The 303 code asks the server to use GET
  when redirecting to another page */
header('HTTP/1.1 303 See Other');

if (isset($_POST['passwd']) && isset($_POST['passwdverif'])) {

    if ($message != '') {
        $next_page = 'changepassword.php';
        //Add error message to the query string
        $queryString .= '&error=' . $message;
        // This message asks the server to redirect to another page
        header('Location: http://' . $server_dir . $next_page . $queryString);
    } else {
        $user = $manager->getUserFromMail($_POST['mail']);
        if ($user) {
            $user->setPasswd($_POST['passwd']);
            if ($manager->updateUserPasswd($user)) {
                $next_page = 'changepassword.php';
                $queryString = '?passwdchange=1';
                header('Location: http://' . $server_dir . $next_page . $queryString);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--        <meta http-equiv="refresh" content="5; url=http://annoncegratuit.olympe-network.com/" >-->
        <title>Le Four</title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        include '../include/header.php';
        ?>

        <!--start main content -->
        <section>
            <div id="main" class="wrapper">
                <article>
                    <?php
                    if (!isset($_GET['error']))
                        $message = '';
                    else
                        $message = $_GET['error'];

                    if (isset($_GET['passwdchange'])) {
                        echo 'Votre mot de passe a ete change';
                        echo '<p><a href="http://annoncegratuit.olympe-network.com/login.php">
                            Clique ici pour vous connectez !
                            </a>
                            </p>';
                    } else {
                        echo '<h3>Entrez votre nouveau mot de passe</h3>';
                        if (isset($message) || !empty($message)) {
                            echo '<p class="error">' . $message . '</p>';
                            ?>

                            <form id="myForm" action="changepassword.php" method="post">
                                <fieldset> 
                                    <p>
                                        <label class="form_col" for="passwd">Mot de passe:</label>
                                        <input class="input_form" type="password" name="passwd" id="passwd" maxlength="50" onkeyup="checkPasswd()"/>
                                        <span class="tooltip">Le mot de passe ne doit pas faire moins de 6 caractères</span>
                                    </p>

                                    <p>
                                        <label class="form_col" for="passwdverif">Mot de passe (confirmation):</label>
                                        <input class="input_form" type="password" name="passwdverif" id="passwdverif" onkeyup="checkPasswdVerif()" />
                                        <span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
                                    </p>
                                    <p>
                                        <input type="hidden" name="mail" value="<?php echo $_GET['mail'] ?>" />
                                    </p>
                                    <p><input type="submit" value="Valider" /></p>
                                </fieldset>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </article>
            </div>
        </section>
        <!--end main content -->
        <script>
            (function() {
                                                                        
                var spans = document.getElementsByTagName('span'),
                spansLength = spans.length;
                                                                            
                for (var i = 0 ; i < spansLength ; i++) {
                    if (spans[i].className == 'tooltip') {
                        spans[i].style.display = 'none';
                    }
                }
            })();
                    
            function getTooltip(element) {
                                                                        
                while (element = element.nextSibling) {
                    if (element.className === 'tooltip') {
                        return element;
                    }
                }        
                return false;
            }
                    
            function checkPasswd() {
            
                var pwd1 = document.getElementById('passwd'),
                tooltipStyle = getTooltip(pwd1).style;
                if (/^[a-zA-Z0-9]{6,50}$/.test(pwd1.value)) {
                    pwd1.className = 'correct';
                    tooltipStyle.display = 'none';
                    return true;
                } else {
                    pwd1.className = 'incorrect';
                    tooltipStyle.display = 'inline-block';
                    return false;
                }
            
            };
            
            function checkPasswdVerif() {
            
                var pwd1 = document.getElementById('passwd'),
                pwd2 = document.getElementById('passwdverif'),
                tooltipStyle = getTooltip(pwd2).style;
                
                if (pwd1.value == pwd2.value && pwd2.value != '' && /^[a-zA-Z0-9]{6,50}$/.test(pwd2.value)) {
                    pwd2.className = 'correct';
                    tooltipStyle.display = 'none';
                    return true;
                } else {
                    pwd2.className = 'incorrect';
                    tooltipStyle.display = 'inline-block';
                    return false;
                }
            
            };
        </script>
        <!--start footer -->
        <?php
        include '../include/footer.php';
        ?>
    </body>
</html>
<!-- if ($message == '') {
                        echo 'Votre mot de passe a ete change';
                        echo '<p><a href="http://annoncegratuit.olympe-network.com/login.php/">
                            Clique ici pour vous connectez de nouveau!
                            </a>
                            </p>';
                    } else-->