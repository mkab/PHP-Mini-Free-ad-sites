<?php
if (!isset($_GET['error']))
    $message = '';
else
    $message = $_GET['error'];
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
                <noscript>
                <div class="error">
                    We're sorry but our site <strong>requires</strong> JavaScript.
                </div>    
                </noscript>

                <?php
                if (isset($message) && !empty($message)) {
                    echo '<p class="error">' . $message . '</p>';
                } 
                ?>
                <article>
                    <h4>Vous avez perdu votre mot de passe?  Vous voulez changez votre mot de passe?<br />
                     Entrez votre mail pour le reinitialiser
                    </h4>
                    <form id="myForm" action="verifyforgottenpasswd.php" method="post">
                        <fieldset> 
                            <p><label for="mail">Entrez votre mail: </label>
                                <input class="input_form" type="text" name="mail" id="mail" onkeyup="checkMail();"/>
                                <span class="tooltip">L'email n'est pas valide</span>
                            </p>
                            <p><input type="submit" value="Envoyer" /></p>
                        </fieldset>
                    </form>
                </article>
            </div>
        </section>
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
            
            function checkMail() {
                
                var mel = document.getElementById('mail'),
                tooltipStyle = getTooltip(mel).style;
                    
                if (/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(mel.value)) {
                    mel.className = 'correct';
                    tooltipStyle.display = 'none';
                    return true;
                } else {
                    mel.className = 'incorrect';
                    tooltipStyle.display = 'inline-block';
                    return false;
                }
                
            };
        </script>
        <!--end main content -->
        <!--start footer -->
        <?php
        include '../include/footer.php';
        ?>
    </body>
</html>
