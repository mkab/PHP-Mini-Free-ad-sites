<?php
include 'protected/functions/functions.php';

// We will receive error messages from the validation page
if (!isset($_GET['error']))
    $message = '';
else
    $message = $_GET['error'];
if (empty($_SESSION)) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Le Four</title>
            <link href="css/style.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <?php
            include 'include/header.php';
            ?>

            <!--start main content -->
            <section>
                <div id="main" class="wrapper">
                    <h1>Inscrivez vous</h1>
                    <p>Inscription sur Jannonce et gratuit. Veuillez remplir le formulaire ci dessous
                        pour postuler un offre</p>
                    <?php
                    if (isset($message) && !empty($message)) {
                        echo '<p class="error">' . $message . '</p>';
                    }
                    ?>
                    <article>
                        <form id="myForm" action="verify.php" method="post">
                            <fieldset>

                                <p>
                                    <label class="form_col" for="nom">Nom/Pseudo:</label>
                                    <input class="input_form" type="text" name="nom" id="nom" maxlength="50"/>
                                    <span class="tooltip">Un nom/pseudo ne peut pas faire moins de 2 caractères</span>
                                </p>

                                <p>
                                    <label class="form_col" for="passwd">Mot de passe:</label>
                                    <input class="input_form" type="password" name="passwd" id="passwd" maxlength="50"/>
                                    <span class="tooltip">Le mot de passe ne doit pas faire moins de 6 caractères</span>
                                </p>

                                <p>
                                    <label class="form_col" for="passwdverif">Mot de passe (confirmation):</label>
                                    <input class="input_form" type="password" name="passwdverif" id="passwdverif" />
                                    <span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
                                </p>

                                <p>
                                    <span class="form_col">Vous etes un </span>
                                    <label><input type="radio" name="type_util" value="particulier" id="particulier" />Particulier</label>
                                    <label><input type="radio" name="type_util" value="professionnel"  id="professionnel" />Professionnel</label>
                                    <span class="tooltip">Veuillez selectionner votre cas</span>
                                </p>

                                <p>
                                    <label class="form_col" for="mail">Email:</label>
                                    <input class="input_form" type="text" name="mail" id="mail" />
                                    <span class="tooltip">L'email n'est pas valide</span>
                                </p>

                                <p>
                                    <label class="form_col" for="telephone">Telephone:</label>
                                    <input class="input_form" type="text" name="telephone" id="telephone" maxlength="14" /> &nbsp; ex:0612345678 (optionnel)
                                    <span class="tooltip">Le numero de telephone n'est pas valide</span>
                                </p>

                                <p><input type="hidden" name="form_submitted" value="1"/></p>
                                <p>
                                    <input type="submit" value="M'inscrire"/> <input type="reset" value="Réinitialiser le formulaire"/>
                                </p>
                            </fieldset> 
                        </form>
                    </article>
                </div>
            </section>
            <script type="text/javascript" src="css/fourjs.js"></script> 
            <!--end main content -->
            <!--start footer -->
            <?php
            iplog();
            include 'include/footer.php';
            ?>
        </body>
    </html>
    <?php
} else {
    header('Location: /');
}
?>