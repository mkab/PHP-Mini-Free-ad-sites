/* 
 * Javascript for the form to make an offer
 */

function reload(form) {
    var val=form.region.options[form.region.options.selectedIndex].value; 
    self.location='mo.php?reg_id=' + val ;
}

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
    
    check['region'] = function() {
        alert('region');
        var region = document.getElementById('region'),
        tooltipStyle = getTooltip(region).style;
            
        if (region.options[region.selectedIndex].value != '-1') {
            tooltipStyle.display = 'none';
            return true;
        } else {
            tooltipStyle.display = 'inline-block';
            return false;
        }
        
    };
    
    
    var dept = document.getElementById('dept');
    if(dept !== null){
        check['dept'] = function() {
            var tooltipStyle = getTooltip(dept).style;
            
            if (dept.options[dept.selectedIndex].value != '-1') {
                tooltipStyle.display = 'none';
                return true;
            } else {
                tooltipStyle.display = 'inline-block';
                return false;
            }
        
            return null;
    
        };
    }
    
    check['categorie'] = function() {
        alert('categorie');
        var categorie = document.getElementById('categorie'),
        tooltipStyle = getTooltip(categorie).style; 
            
        if (categorie.options[categorie.selectedIndex].value != '-1') {
            tooltipStyle.display = 'none';
            return true;
        } else {
            tooltipStyle.display = 'inline-block';
            return false;
        }
        
    };
    
    check['titre'] = function() {
        var title = document.getElementById('titre'),
        tooltipStyle = getTooltip(title).style;
        
        if ( /^[a-zA-Z0-9 ]{2,255}$/.test(title.value)) {
            title.className = 'correct';
            tooltipStyle.display = 'none'; 
            return true;
        } else {
            title.className = 'incorrect';
            tooltipStyle.display = 'inline-block';
            return false;
        }
    
    };
    
    check['pobox'] = function() {
        var pobox = document.getElementById('pobox'),
        tooltipStyle = getTooltip(pobox).style;
        
        if (/^[0-9]{5}$/.test(pobox.value)) {
            pobox.className = 'correct';
            tooltipStyle.display = 'none'; 
            return true;
        } else {
            pobox.className = 'incorrect';
            tooltipStyle.display = 'inline-block';
            return false;
        }
    
    };
    
    check['prix'] = function() {
        var prix = document.getElementById('prix'),
        tooltipStyle = getTooltip(prix).style;
        
        if ( /^[0-9]+$/.test(prix.value)) {
            prix.className = 'correct';
            tooltipStyle.display = 'none'; 
            return true;
        } else {
            prix.className = 'incorrect';
            tooltipStyle.display = 'inline-block';
            return false;
        }
    
    };
    
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
                alert(i + '   '+result);
            }
                         
            if (result) {
                alert('le formulaire est bien rempli!');
                return true;
            } 
            alert('pas bien rempli');
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



//    check['mail'] = function() {
//    
//        var mel = document.getElementById('mail'),
//        tooltipStyle = getTooltip(mel).style;
//        
//        if (/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(mel.value)) {
//            mel.className = 'correct';
//            tooltipStyle.display = 'none';
//            return true;
//        } else {
//            mel.className = 'incorrect';
//            tooltipStyle.display = 'inline-block';
//            return false;
//        }
//    
//    }; 
//    
//    
//    check['telephone'] = function() {
//    
//        var tel = document.getElementById('telephone'),
//        tooltipStyle = getTooltip(tel).style;
//        
//        if (/^0[1-9]([-. ]?[0-9]{2}){4}$/.test(tel.value) || tel.value == '') {
//            if(tel.value == '') {
//                tel.className = 'input_form';
//            }else {
//                tel.className = 'correct';
//            }
//            
//            tooltipStyle.display = 'none';
//            return true;
//        } else {
//            tel.className = 'incorrect';
//            tooltipStyle.display = 'inline-block';
//            return false;
//        }
//    
//    };