<!--Contains Login and Logout values according to sessions-->

<?php
if (!isset($_SESSION)) {
    echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Creer un Compte</div>';
    echo '<div class="logdelog"><img src="../images/login.jpg" alt ="logout" width="10" height="25" />Se connecter</div>';
} else {
    echo '<p>Bienvenue ' . $_SESSION['nom'] . '!!! &nbsp;</p>';
    echo '<div class="logdelog"><img src="../images/logout.jpg" alt ="logout" width="20" height="20" />Deconnexion</div>';
}
?>
<?php
if (isset($_SESSION) && !empty($_SESSION)) {
    echo 'Bienvenue ' . $_SESSION['nom'] . '!!! <p><a href = "?deconnexion=1">Deconnexion</a></p>';
}
?>
