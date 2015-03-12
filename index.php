<?php
session_start();
include 'protected/database.php';
include 'protected/functions/functions.php';
include 'logout.php';
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
    <title>Jannonce</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="css/style.css" type="text/css">	

</head>
<body> 
    <?php include 'include/header.php'; ?>

    <!--start main content -->
    <div id="main" class="wrapper">
       
        <article>
            <h2>Choissisez votre Region</h2>
            <ul>
                <?php
                $reg_manager = new RegionDeptManager($bdd);
                $regions = $reg_manager->getRegions();
                foreach ($regions as $region) {
                    echo '<li><a href="http://annoncegratuit.olympe-network.com/offres/' .
                    cleanForShortURL($region->getNom_region()) .
                    '" title="' . $region->getNom_region() . '">' . $region->getNom_region() . '</a></li>'."\n";
                } 
                ?>
            </ul>
        </article>
    </div>
    <!--end main content -->

    <!--start footer -->
    <?php include 'include/footer.php';
    ?>

</body>
</html>
