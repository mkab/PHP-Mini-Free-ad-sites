<?php
session_start();
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
                    <?php
                    echo '<h1>Connectez vous</h1>';
                    if (isset($message) || !empty($message)) {
                        echo '<p class="error">' . $message . '</p>';
                    }
                    ?>
                    <article>
                        <form id="myForm" action="verifylogin.php" method="post">
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
                                <?php
                                if ($_SERVER['HTTP_REFERER']) {
                                    echo '<input type="hidden" name="lastpagevisited" value="' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '" />';
                                }
                                ?>
                                <input type="hidden" name ="login_submitted"value="1" />

                                <p>
                                    <input type="submit" value="Se connecter"/> <input type="reset" value="Réinitialiser le formulaire"/>
                                </p>
                            </fieldset>
                        </form>
                    </article>
                </div>
            </section>
            <script type="text/javascript">
                (function() { // On utilise une IEF pour ne pas polluer l'espace global
            
                    // Fonction de désactivation de l'affichage des "tooltips"
            
                    function deactivateTooltips() {
            
                        var spans = document.getElementsByTagName('span'),
                        spansLength = spans.length;
                
                        for (var i = 0 ; i < spansLength ; i++) {
                            if (spans[i].className == 'tooltip') {
                                spans[i].style.display = 'none';
                            }
                        }
                    }
            
                    /**
                     * Recursive function to get the closest parent with the given tag name.
                     */
                    function getParentByTagName(obj, tag) {
                        var obj_parent = obj.parentNode;
                        if (!obj_parent) 
                            return false;
                        if (obj_parent.tagName.toLowerCase() == tag) 
                            return obj_parent;
                        else 
                            return getParentByTagName(obj_parent, tag);
                    }
            
                    /**
                     * Recursive function to get the closest sibiling with the given tag name.
                     */
                    function getClosestSiblingByTagName(obj, tag) {
                        var obj_sibling = obj.nextSibling;
                        if (!obj_sibling) 
                            return false;
                        if (obj_sibling.tagName.toLowerCase() == tag) 
                            return obj_sibling;
                        else 
                            return getParentByTagName(obj_sibling, tag);
                    }
            
                    // La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input
            
                    function getTooltip(element) {
            
                        while (element = element.nextSibling) {
                            if (element.className === 'tooltip') {
                                return element;
                            }
                        }        
                        return false;
                    }
            
            
                    // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
            
                    var check = {}; // On met toutes nos fonctions dans un objet littéral
                
                    check['nom'] = function() {
            
                        var name = document.getElementById('nom'),
                        tooltipStyle = getTooltip(name).style;
                
                        if ( /^[a-zA-Z0-9]{2,10}$/.test(name.value)) {
                            name.className = 'correct';
                            tooltipStyle.display = 'none'; 
                            return true;
                        } else {
                            name.className = 'incorrect';
                            tooltipStyle.display = 'inline-block';
                            return false;
                        }
            
                    };
            
                        
                    check['passwd'] = function() {
            
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
                        
                    //                check['mail'] = function() {
                    //    
                    //                    var mel = document.getElementById('mail'),
                    //                    tooltipStyle = getTooltip(mel).style;
                    //        
                    //                    if (/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(mel.value)) {
                    //                        mel.className = 'correct';
                    //                        tooltipStyle.display = 'none';
                    //                        return true;
                    //                    } else {
                    //                        mel.className = 'incorrect';
                    //                        tooltipStyle.display = 'inline-block';
                    //                        return false;
                    //                    }
                    //    
                    //                };
                
                    // Mise en place des événements
            
                    (function() { // Utilisation d'une fonction anonyme pour éviter les variables globales.
            
                        var myForm = document.getElementById('myForm'),
                        inputs = document.getElementsByTagName('input'),
                        inputsLength = inputs.length;
            
                        var image = document.createElement('img');
                        image.setAttribute('src', 'images/tick.jpg');
                        image.setAttribute('alt', 'correct form');
                        image.setAttribute('width', 15);
                        image.setAttribute('height', 15);
                
                
                        for (var i = 0 ; i < inputsLength ; i++) {
                            if (inputs[i].type == 'text' || inputs[i].type == 'password') {
            
                                inputs[i].onkeyup = function() {
                                    var element = getParentByTagName(this, 'p'); // "this" représente l'input actuellement modifié 
                                    if(check[this.id](this.id)) {  
                                        element.appendChild(image);
                                    } else {
                                        element.removeChild(image);
                                    }
                                }; 
            
                            }
                        }
            
                        myForm.onsubmit = function() {
                            var result = true;
                    
                            for (var i in check) {
                                result = check[i](i) && result;
                            }
                               
                            if (result) {
                                return true;
                            } 
                            return false;
                   
                        };
            
                        myForm.onreset = function() { 

                            for (var i = 0 ; i < inputsLength ; i++) {
                                if (inputs[i].type == 'text' || inputs[i].type == 'password') {
                                    inputs[i].className = 'input_form';
                                    //                    inputs[i].removeChild(di);
                                }
                            }
            
                            deactivateTooltips();
            
                        };
            
                    })();
            
               
                    // Maintenant que tout est initialisé, on peut désactiver les "tooltips"
            
                    deactivateTooltips();

                })();
            
            </script>
            <!--end main content -->
            <!--start footer -->
            <?php include 'include/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header('Location: /');
}
?>