<?php
session_start();
include '../../protected/database.php';
include '../../protected/functions/functions.php';
include '../../logout.php';

$city = get_zip_info(95000);
print_r($city);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
    <title>Jannonce</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">	

</head>
<body>
    <?php include '../../include/header.php'; ?>

    <!--start main content -->
    <section>
        <div id="main" class="wrapper">


            <h2>Dernier Offres</h2>

            <hr />

            <?php
//            echo'<div class="list_offers">
//            <a href="http://www.leboncoin.fr/equipement_auto/279667088.htm?ca=12_s" title="Volant peugeot sport cuir">
//                <div class="ad">
//                    <div class="date">
//                        <div>26 jan</div>
//                        <div>17:41</div>
//                    </div>
//                    <div class="image">
//
//                        <div class="image-and-nb">
//                            <img src="http://193.164.197.50/thumbs/650/6504922205.jpg" alt="Volant peugeot sport cuir">
//                            <div class="nb">
//                                <div class="top radius">&nbsp;</div>
//                                <div class="value radius">2</div>
//                            </div>
//                        </div>
//                    </div>
//                    <div class="detail">
//                        <div class="title">
//                            Volant peugeot sport cuir
//                        </div>
//                        <div class="category">
//                        </div>
//                        <div class="placement">
//                            Maurecourt
//                            /
//                            Yvelines
//                        </div>
//
//                        <div class="price">
//                            40&nbsp;&euro;
//                        </div>
//
//                    </div>
//                    <div class="clear"></div>
//                </div>
//            </a>
//    
//            </div>';

            $query = $bdd->query("SELECT * FROM multimedia ORDER BY date_offre, time_offre DESC");
            while ($offres = $query->fetch(PDO::FETCH_ASSOC)) {
//                print_r($offres);
                echo'<div class="list_offers">';
                echo '<h2>' . $offres['titre'] . '</h2>
                <div class="ad">
                    <div class="date">
                        <div>' . $offres['date_offre'] . '</div>
                        <div>' . $offres['time_offre'] . '</div>
                    </div>';
                echo' <div class="image">

                        <div class="image-and-nb">' .
                "\n" . '<img src="' . $offres['photo1'] . '" alt="' . $offres['titre'] . '" />
                            <div class="nb">
                                <div class="top radius">&nbsp;</div>
                                <div class="value radius">2</div>
                            </div>
                        </div>
                    </div>';
//                    <div class="detail">
//                        <div class="title">
//                            Volant peugeot sport cuir
//                        </div>
//                        <div class="category">
//                        </div>
//                        <div class="placement">
//                            Maurecourt
//                            /
//                            Yvelines
//                        </div>
//
//                        <div class="price">
//                            40&nbsp;&euro;
//                        </div>
//
//                    </div>
//                    <div class="clear"></div>
//                </div>
//            </a>

                '</div>';
            }
            ?>

        </div>
    </section>
    <!--end main content -->

    <!--start footer -->
    <?php include '../../include/footer.php';
    ?> 

</body>
</html>
<!--$query = $bdd->query("SELECT * FROM multimedia ORDER BY date_offre, time_offre DESC");
            while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
                print_r($donnees);
                echo "\n" . '<img src="' . $donnees['photo1'] . '" alt="my photo" />';
            }-->