<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';

$manager = new UtilisateurManager($bdd);
$offermanager = new OffersManager($bdd);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="/css/style.css" type="text/css">	

</head>
<body> 
    <?php include '../include/header.php'; ?>

    <!--start main content -->
    <div id="main" class="wrapper">

        <article>
            <?php
            if (!empty($_GET['u']) && !empty($_GET['io']) && !empty($_GET['ot'])) {
                $user_id = $_GET['u'];
                $offer_id = $_GET['io'];
                echo '<br />';
                $offerType = $offermanager->getNameType($_GET['ot']);
                $offerType = strtolower($offerType);
                echo $user_id . $offer_id . $offerType;
                $o = $offermanager->getUsersOffer($user_id, $offer_id, $offerType);
                print_r($o);
            }
            ?>
        </article>
    </div>
    <!--end main content -->

    <!--start footer -->
    <?php include '../include/footer.php';
    ?>

</body>
</html>