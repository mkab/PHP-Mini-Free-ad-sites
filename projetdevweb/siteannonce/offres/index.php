<?php
//Index.php for all offers
//prepare the site for the link of each offer
$site = mb_substr($_SERVER["SCRIPT_URI"], 0, strrpos($_SERVER["SCRIPT_URI"], '/'));
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';

$offermanager = new OffersManager($bdd);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Jannonce</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">	

</head>
<body>
    <?php include '../include/header.php'; ?>

    <!--start main content -->
    <section>
        <div id="main" class="wrapper">


            <h2>Dernier Offres en tout la France</h2>

            <hr />

            <?php
            $totalPages = $offermanager->getNumberOfOffers('multimedia', -1);
            $totalPages = $totalPages + $offermanager->getNumberOfOffers('immobilier', -1);
            $arr = pagination($totalPages, 2);

            if ($totalPages > 0) {
                $query = $offermanager->getAllOffers($arr, -1);
                foreach ($query as $offres) {
                    $dept = $offermanager->getDeptName($offres->getDept());
                    $region = $offermanager->getRegionName($offres->getRegion());
                    echo '<div class="list_offers">
                        <a href="' . $site . '/details.php?ot=' . $offres->getId_type() .
                    '&u=' . $offres->getId_utilisateur() . '&io=' . $offres->getId_annonce() . '"
                            title="' . $offres->getTitre() . '">
                            <div class="ad">
                                <div class="date">
                                    <div>' . $offres->getDate_offre() . '</div>
                                    <div>' . $offres->getTime_offre() . '</div>
                                </div>
                                <div class="image">
                                    <div class="image-and-nb">' . "\n" .
                    '<img src="' . $offres->getPhoto1() . '" alt="' . $offres->getTitre() . '" height="100" width="100" />
                                    </div>
                                </div>
                                <div class="detail">
                                    <div class="title">' . $offres->getTitre() . '
                                    </div>
                                    <div class="category">
                                    </div>
                                    <div class="placement">' .
                    $dept . '<br />' .
                    $region . '<br />' .
                    '</div>
                                    <div class="price">' .
                    $offres->getPrix() . '&nbsp;&euro;
                                    </div>
                                </div>
                            <div class="clear"></div>
                            </div>
                        </a>
                    </div>';
                }
            }
            //pagination
            pageNumber($arr);
            ?>

        </div>
    </section>
    <!--end main content -->

    <!--start footer -->
    <?php
    include '../include/footer.php';
    iplog();
    ?>  

</body>
</html>
