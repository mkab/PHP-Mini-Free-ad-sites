<?php

session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';

if (checkOfferForm()) {
    $_POST['id_utilisateur'] = $_SESSION['id'];
    $_POST['mail'] = $_SESSION['mail'];
    $_POST['nom'] = $_SESSION['nom'];
    $_POST['telephone'] = $_SESSION['telephone'];

    $manager = new OffersManager($bdd);
    $id_type = $manager->getIdType($_POST['categorie']);
    $_POST['id_type'] = $id_type['id_type'];

    print_r($_POST);
    echo '<br>';
    echo '<br>';

    $message = ""; //the message to tell the user the errors committed

    /** Test if the file has been properly loaded */
    if (isset($_FILES['photo1']) && $_FILES['photo1']['error'] == 0) {
        //Verify the size of the file
        if ($_FILES['photo1']['size'] <= 1000000) {
            //Verify the extensions of the file
            $fileinfo = pathinfo($_FILES['photo1']['name']);
            $uploaded_extension = $fileinfo['extension'];
            $authorised_extensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($uploaded_extension, $authorised_extensions)) {
                $filename = $_SESSION['nom'] . '_' . generateUniqueId() . '.' . $fileinfo['extension'];
                echo $filename;
                $dossier = '../protected/uploads/images/' . $_SESSION['nom'];
                $path = 'http://annoncegratuit.olympe-network.com/protected/uploads/images/' . $_SESSION['nom'] . '/' . $filename;
                echo $path;
                if (!is_dir($dossier)) {
                    mkdir($dossier, 0777);
                }

                if (move_uploaded_file($_FILES['photo1']['tmp_name'], $dossier . '/' . $filename)) {
                    $message .= 'file uploaded';
                    $_POST['photo1'] = $path;
                    echo '<br>type = ' . $_POST['id_type'];
                $mult = new Multimedia($_POST);
                
                $manager->add($mult); 
                } else {
                    $message .= 'file not uploaded';
                }
//            echo "\n". '<img src="'. $path .'" alt="my photo" />';
            } else {
                echo 'Not a .jpg/.jpeg or .png file';
            }
        } else {
            $message .= 'Taille du photo depasse 1Mo';
        }
    } else {
        $message .= 'Erreur de chargement du photo. Verifiez bien l\'extension du photo';
    }

    echo $message;
}
/* End Verification of the petite annonce form */
?>
