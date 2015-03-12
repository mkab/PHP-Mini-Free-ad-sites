<!--Common header for the website-->
<!--strt header -->
<div  id="header-container">
    <header class="wrapper">
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI']); //decides when to show to login and create an account button
        $location = $location[count($location) - 1];

        if (empty($_SESSION)) {
            if ($location != 'login.php' && $location != 'registration.php') {
                echo '<div class="logdelog"><a href="/registration.php">Creer un Compte</a></div>';
                echo '<div class="logdelog"><a href="/login.php">Se connecter</a></div>';
            } else if ($location == 'login.php') {
                echo '<div class="logdelog"><a href="/registration.php">Creer un Compte</a></div>';
            } else {
                echo '<div class="logdelog"><a href="/login.php">Se connecter</a></div>';
            }
        } else {
            echo'<div class="logdelog"><a href = "?deconnexion=1">Deconnexion</a></div>';
            echo '<div class="logdelog">Bienvenue ' . $_SESSION['nom'] . '</div>';
        }
        ?>
        <div id="logo">
            <div id="title">
                <a href="/">Annonce gratuit</a>
            </div>
            <a href="/"><img src="/images/bannerlogo.jpg" alt="website logo" /></a>
        </div> 
    </header>    
    <div class="clear"></div> 

    <!--start navigation -->
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/offres">Offres</a></li>
            <li><a href="/form/mo.php">Déposer une annonce</a></li>
            <li><a href="/contact/info.php">Contact</a></li>
        </ul>
    </nav>
    <!--end navigation -->

</div>

<!--end header -->

<!--start header -->
<!--<div id="header-container">
    <header class="wrapper">
        <div id="logo">
            <div id="title">
                <a href="/">Annonce gratuit</a>
            </div>
        </div>
        <div class="clear"></div>

        start navigation 
        <nav>
            <div class="pul"><a href="/form/mo.php">Déposer un annonce</a></div>
            <div class="pul"><a href="/registration.php">Créer un compte</a></div>
            <div class="pul"><a href="/login.php">Se connecter</a></div>
            <div class="pul"><a href="#">Offres</a></div>
            <div class="pul"><a href="#">Démandes</a></div>
            <div class="pul"><a href="/">Accueil</a></div>
        </nav>
        end navigation 
    </header>
</div>-->

<?php
//$location = explode('/', $_SERVER['REQUEST_URI']); //decides when to show to login and create an account button
//$location = $location[count($location) - 1];
//
//if (empty($_SESSION)) {
//    if ($location != 'login.php' && $location != 'registration.php') {
//        echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Creer un Compte</div>';
//        echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Se connecter</div>';
//    }
//} else {
//    echo 'Bienvenue ' . $_SESSION['nom'] . '!!! <p><a href = "?deconnexion=1">Deconnexion</a></p>';
//}
?>

<!--end header -->