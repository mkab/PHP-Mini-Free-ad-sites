<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Annonce postulé</title>
    <meta name="description" content="description here">
    <meta name="author" content="content here">
    <link rel="stylesheet" href="/css/style.css" type="text/css">	

</head>

<body> 
    <?php include '../include/header.php'; ?>
        <!--start main content -->
        <div id="main" class="wrapper">
             <p>Annonce postulé</p>
        </div>
    <!--start footer -->
    <?php
    include '../include/footer.php';
    ?>

</body>
</html>
