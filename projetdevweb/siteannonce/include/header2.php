<!--Common header for the website-->
<!--start header -->
<div  id="header-container">
    <header class="wrapper">
        <?php
        $location = explode('/', $_SERVER['REQUEST_URI']); //decides when to show to login and create an account button
        $location = $location[count($location) - 1];

        if (empty($_SESSION)) {
            if ($location != 'login.php' && $location != 'registration.php') {
                echo '<div class="logdelog"><a href="/registration.php">Creer un Compte</a></div>';
                echo '<div class="logdelog"><a href="/login.php">Se connecter</a></div>';
            }
        } else {
            echo '<p>Bienvenue ' . $_SESSION['nom'] . ' &nbsp; <a href = "?deconnexion=1">Deconnexion</a></p>';            
        }
        ?>
        <div id="logo">
            <div id="title">
                <a href="/">Annonce gratuit</a>
            </div>
            <a href="/"><img src="../images/bannerlogo.jpg" alt="website logo" /></a>
        </div> 
        <a href="/"><img src="../images/icon_128.png" alt="website logo" /></a>

    </header>    
    <div class="clear"></div> 

    <!--start navigation -->
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="#">Offres</a></li>
            <li><a href="/form/mo.php">Déposer un annonce</a></li>
        </ul>
    </nav>
    <!--end navigation -->

</div>

<!--end header -->