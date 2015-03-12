<?php
/**
 * Details of offers for individual regions 
 */
session_start();
include '../../protected/database.php';
include '../../protected/functions/functions.php';
include '../../logout.php';

$manager = new UtilisateurManager($bdd);
$offermanager = new OffersManager($bdd);
if (!empty($_GET['u']) && !empty($_GET['io']) && !empty($_GET['ot'])) {
    $user_id = $_GET['u'];
    $offer_id = $_GET['io'];
    $offerType = $offermanager->getNameType($_GET['ot']);
    $offerType = strtolower($offerType);

    $user = $manager->getUserFromId($user_id);
    $annonce = $offermanager->getUsersOffer($user_id, $offer_id, $offerType);
    $dept = $offermanager->getDeptName($annonce->getDept());
    $region = $offermanager->getRegionName($annonce->getRegion());
}
if ($user && $annonce) {
    ?>
    <!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $annonce->getTitre() ?></title>
        <meta name="description" content="description here">
        <meta name="author" content="content here">
        <link rel="stylesheet" href="/css/style.css" type="text/css">	

    </head>
    <body> 
        <?php
        include '../../include/header.php';

//        start main content 
        echo '<section>
            <div id="main" class="wrapper">';

        echo '<article class="describe">';

        if (!empty($_GET['u']) && !empty($_GET['io']) && !empty($_GET['ot'])) {

            echo '<div class="more_detail">';
            echo '<h5>' . $offerType . '</h5>';
            echo '<h2>' . $annonce->getTitre() . '</h2>';
            echo '<span>Mise en ligne par ' . $user->getNom() . ' le ' .
            $annonce->getDate_offre() . ' à ' . $annonce->getTime_offre() . '</span>';
            echo '<div class="clear"></div>';
            echo '<img src="' . $annonce->getPhoto1() . '" alt="' . $annonce->getTitre() . '"/>';
            echo '</div>'; //end div more detail

            echo '<div class="other_detail">
                        <span class="label">Prix</span>: ' . $annonce->getPrix() . '<br />' .
            '<span class="label">Departement</span>: ' . $dept . '<br />' .
            '<span class="label">Region: </span>' . $region . '<br />
                    </div>'; //end div detail

            echo '<div class="clear"></div>';

            echo '<div class="description">';
            echo '<h5>Description: </h5>';
            echo $annonce->getDescription();
            echo '</div>'; //end div description
//                    echo '<div class="clear"></div>';

            echo '</article>';

            echo '<aside>';
            echo'<span> Contacter l\'annonceur</span> <br />
                <a href="/form/cmel.php?ot=' . $_GET['ot'] . '&u=' . $_GET['u'] . '&io=' . $_GET['io'] . '">
                Envoyer un mail</a><br />';

            echo $user->getNom() . '<br>
                        Tel: ' . $user->getTelephone() . '<br />';

            echo '</aside>';
        }

        echo '</div>';
        echo '</section>';
//    end main content 
//    start footer 
        include '../../include/footer.php';


        echo '</body>
    </html> ';
    }
    ?>