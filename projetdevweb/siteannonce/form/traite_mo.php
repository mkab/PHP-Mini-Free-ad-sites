<?php

session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
$data = checkOfferForm(); //data[1] is the error message and data[0] is the boolean
$error = $data[1]; //the message to tell the user the errors committed
//if the form completed successfully
if ($data[0]) {
    $_POST['id_utilisateur'] = $_SESSION['id'];
    $_POST['mail'] = $_SESSION['mail'];
    $_POST['nom'] = $_SESSION['nom'];
    $_POST['telephone'] = $_SESSION['telephone'];
    $type = split('\.', $_POST['categorie']); 

    $manager = new OffersManager($bdd);
    $id_type = $manager->getIdType($type[1]);
    $_POST['id_type'] = $id_type['id_type'];

//    print_r($_POST);
//    echo '<br>';
//    echo '<br>';
    $class = $type[0];
//    echo 'class = ' . $class;
//    echo '<br>';
//    echo '<br>';
    $offer = new $class($_POST);


    /** Test if the file has been properly loaded */
    if (isset($_FILES['photo1']) && $_FILES['photo1']['error'] == 0) {
        //Verify the size of the file
        if ($_FILES['photo1']['size'] <= 1000000) {
            //Verify the extensions of the file
            $fileinfo = pathinfo($_FILES['photo1']['name']);
            $uploaded_extension = $fileinfo['extension'];
            $authorised_extensions = array('jpg', 'jpeg', 'png', 'gif');

            //if the extension is valid
            if (in_array($uploaded_extension, $authorised_extensions)) {
                $filename = $_SESSION['nom'] . '_' . generateUniqueId() . '.' . $fileinfo['extension'];
                $dossier = '../protected/uploads/images/' . $_SESSION['nom'];
                $path = 'http://annoncegratuit.olympe-network.com/protected/uploads/images/' . $_SESSION['nom'] . '/' . $filename;
                //if the file doesn't exist create it and give te necessary rights for read/write/excute
                if (!is_dir($dossier)) {
                    mkdir($dossier, 0777);
                }

                // if the file is successfully uploaded
                if (move_uploaded_file($_FILES['photo1']['tmp_name'], $dossier . '/' . $filename)) {
                    $message .= 'file uploaded';
                    $_POST['photo1'] = $path;
                    $offer = new $class($_POST);
                    //add the offer to the table
                    if ($offer) {
                        $manager->add($offer);
                    }
                } else {
                    $error .= 'Le fichier ne peut pas etre télécharger. Veuillez nous contactez<br  />';
                }
            } else {
                $error .= 'La photo n\'est pas du format jpg ou jpeg ou png <br  />';
            }
        } else {
            $error .= 'Taille de la photo depasse 1Mo<br  />';
        }
    }
}

$queryString = '';
$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';


/* The header() function sends a HTTP message 
  The 303 code asks the server to use GET
  when redirecting to another page */
header('HTTP/1.1 303 See Other');

if ($error != '') {
    //Back to register page 
    $next_page = 'mo.php';
    //Add error message to the query string
    $queryString .= '?error=' . $error;
    // This message asks the server to redirect to another page
    header('Location: http://' . $server_dir . $next_page . $queryString);
} else {
    $next_page = 'success.php?sent=1';
    header('Location: http://' . $server_dir . $next_page);
}

/* End Verification of the petite annonce form */
?>
