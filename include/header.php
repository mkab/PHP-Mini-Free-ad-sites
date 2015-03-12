<!--Common header for the website-->
<!--start header -->
<div id="header-container">
    <header class="wrapper">
        <div id="logo">
            <div id="title">
                <a href="/">Annonce gratuit</a>
            </div>
        </div>
        <!--start navigation -->
        <nav>
            <div class="pul"><a href="/form/mo.php">Déposer un annonce</a></div>
            <div class="pul"><a href="/registration.php">Créer un compte</a></div>
            <div class="pul"><a href="/login.php">Se connecter</a></div>
            <div class="pul"><a href="#">Offres</a></div>
            <div class="pul"><a href="#">Démandes</a></div>
            <div class="pul"><a href="/">Accueil</a></div>
        </nav>
        <!--end navigation -->
    </header>
</div>

<?php
$location = explode('/', $_SERVER['REQUEST_URI']);
$location = $location[count($location) - 1];

if (empty($_SESSION)) {
    if ($location != 'login.php' && $location != 'registration.php') {
        echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Creer un Compte</div>';
        echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Se connecter</div>';
    }
} else {
    echo 'Bienvenue ' . $_SESSION['nom'] . '!!! <p><a href = "?deconnexion=1">Deconnexion</a></p>';
}
?>

<!--end header -->