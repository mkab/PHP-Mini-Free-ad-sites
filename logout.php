<?php

if (isset($_GET['deconnexion'])) {
    session_unset;
    session_destroy();
    header('Location: /');
    exit();
}
?>
