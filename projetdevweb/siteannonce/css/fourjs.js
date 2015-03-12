/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


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
    
    check['type_util'] = function() {
    
        var type = document.getElementsByName('type_util'),
        tooltipStyle = getTooltip(type[1].parentNode).style;
        
        if (type[0].checked || type[1].checked) {
            tooltipStyle.display = 'none';
            return true;
        } else {
            tooltipStyle.display = 'inline-block';
            return false;
        }
    
    };
    
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
    
    //    check['login'] = function() {
    //    
    //        var login = document.getElementById('login'),
    //        tooltipStyle = getTooltip(login).style;
    //        
    //        if (login.value.length >= 4) {
    //            login.className = 'correct';
    //            tooltipStyle.display = 'none';
    //            return true;
    //        } else {
    //            login.className = 'incorrect';
    //            tooltipStyle.display = 'inline-block';
    //            return false;
    //        }
    //    
    //    };
    
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
    
    check['passwdverif'] = function() {
    
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
    
    check['mail'] = function() {
    
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
    
    check['telephone'] = function() {
    
        var tel = document.getElementById('telephone'),
        tooltipStyle = getTooltip(tel).style;
        
        if (/^0[1-9]([-. ]?[0-9]{2}){4}$/.test(tel.value) || tel.value == '') {
            if(tel.value == '') {
                tel.className = 'input_form';
            }else {
                tel.className = 'correct';
            }
            
            tooltipStyle.display = 'none';
            return true;
        } else {
            tel.className = 'incorrect';
            tooltipStyle.display = 'inline-block';
            return false;
        }
    
    };
    
    
    //    check['country'] = function() {
    //    
    //        var country = document.getElementById('country'),
    //        tooltipStyle = getTooltip(country).style;
    //        
    //        if (country.options[country.selectedIndex].value != 'none') {
    //            tooltipStyle.display = 'none';
    //            return true;
    //        } else {
    //            tooltipStyle.display = 'inline-block';
    //            return false;
    //        }
    //    
    //    };
    
    
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
                    if(check[this.id](this.id) && this.id != 'telephone') {
                        element.appendChild(image);
                    } else {
                        element.removeChild(image);
                    }
                }; 
    
            }
            
        //            if(inputs[i].type == 'radio') {
        //                inputs[i].onclick = function() {
        //                    var element = getParentByTagName(this, 'p'); // "this" représente l'input actuellement modifié 
        //                    if(check[this.id]) {  
        //                        element.appendChild(image);
        //                    } else {
        //                        element.removeChild(image);
        //                    }
        //                };
        //            }
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
