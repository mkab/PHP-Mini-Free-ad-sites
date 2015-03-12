<?php
session_start();
include '../protected/database.php';
include '../protected/functions/functions.php';
include '../logout.php';
// We will receive error messages from the validation page
if (!isset($_GET['error']))
    $message = '';
else
    $message = $_GET['error'];
$reg_manager = new RegionDeptManager($bdd);
if (!empty($_SESSION['id'])) { //if the session isn't empty
    if ($_SESSION['status'] == activated) { //if the user has activated his or her account
        ?>

        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>Formulaire de depot des petites annonces</title>
                <link rel="stylesheet" type="text/css" href="../css/style.css" />
            </head>
            <body>
                <?php
                include '../include/header.php';

                if (isset($_GET['reg_id'])) {
                    $reg_id = $_GET['reg_id'];
                    $depts = $reg_manager->getDepartements($reg_id);
                }
                ?>
                <section>
                    <h5>Déposer une annonce sur "insert title" est GRATUIT.
                        Votre annonce sera validée par notre équipe éditoriale avant mise en ligne.
                        Elle restera sur le site pendant 60 jours.
                        Pendant cette période, vous pourrez la supprimer à tout moment dans votre espace perso.
                    </h5>

                    <?php
                    if (isset($message) && !empty($message)) {
                        echo '<p class="error">' . $message . '</p>';
                    }
                    ?>

                    <form id="myForm" action="traite_mo.php" method="post" enctype="multipart/form-data">
                        <p><label class="form_col">Région:</label>
                            <select id="region" name='id_region' onchange="reload(this.form);">
                                <option value="none">-----Choisissez la region------</option>
                                <?php
                                $regions = $reg_manager->getRegions();
                                foreach ($regions as $region) {
                                    if ($region->getId_region() == $reg_id)
                                        echo '<option selected="selected" value="' . $region->getId_region() . '">' . $region->getNom_region() . '</option>' . "\n";
                                    else
                                        echo '<option value="' . $region->getId_region() . '">' . $region->getNom_region() . '</option>' . "\n";
                                }
                                ?>
                            </select>
                            <span class="tooltip">Veuillez selectionner la region</span>
                        </p>
                        <?php
                        if (!empty($_GET['reg_id']) && $_GET['reg_id'] != '-1') {
                            echo '<p>
                    <label class="form_col">Département:</label>';

                            echo '<select id="dept" name="id_dept">';
                            echo '<option value="none">------Choisisez le departement------</option>' . "/n";

                            foreach ($depts as $value) {
                                echo '<option value="' . $value->getId_dept() . '">' . $value->getNom_dept() .
                                '&nbsp;(' . $value->getId_dept() . ')</option>' . "/n";
                            }
                            echo '</select>
                        <span class="tooltip">Veuillez selectionner le departement</span>
                    </p>';
                        }
                        ?>
        <!--                        <p> 
                            <label class="form_col" for="pobox">Code Postal:</label>
                            <input class="input_form" type="text" name="pobox" id="pobox" maxlength="50"/>&nbsp; ex:75000
                            <span class="tooltip">Le code postal contient 5 chiffres (ex: 75000) </span>
                        </p>-->

                        <p> 
                            <label class="form_col" for="categorie">Catégorie:</label>
                            <select id="categorie" name="categorie">
                                <option value="none">----Choisissez une Catégorie----</option>
                                <optgroup label="VEHICULE">
                                    <option value="Vehicule.Voiture">Voiture</option>
                                    <option value="Vehicule.Moto">Moto</option>
                                    <option value="Vehicule.Utilitaire">Utilitaire</option> 
                                </optgroup>
                                <optgroup label="IMMOBILIER">
                                    <option value="Immobilier.Vente">Ventes Immobilieres</option>
                                    <option value="Immobilier.Location">Locations</option>
                                    <option value="Immobilier.Colocation">Colocations</option>
                                </optgroup>
                                <optgroup label="MULTIMEDIA">
                                    <option value="Multimedia.Informatique">Informatique</option>
                                    <option value="Multimedia.ConsolesJeux">Consoles et Jeux Videos</option>
                                    <option value="Multimedia.ImageSon">Image & Son</option>
                                    <option value="Multimedia.Telephonie">Telephonie</option> 
                                </optgroup>
                            </select> 
                            <span class="tooltip">Veuillez selectionner un categorie</span>
                        </p>

                        <p>
                            <label class="form_col" for="titre">Titre de l'annonce:</label>
                            <input type="text" name="titre" id="titre" size="60" />
                            <span class="tooltip">Le titre doit avoir au moins 8 caracteres</span>
                        </p>

                        <p>
                            <label class="form_col" for="description">Texte de l'annonce:</label>
                            <textarea rows="10" cols="50" name="description" id="description">Soyez tres precis</textarea> 
                        </p>
                        <p>
                            <label class="form_col" for="prix">Prix:</label>
                            <input class="input_form" type="text" name="prix" id="prix"/> €
                            <span class="tooltip">Veuillez entrer le montant de l'offre en chiffres</span>
                        </p>

                        <p>
                            <label class="form_col" for="photo1">Photo principale: &nbsp; (optionnel)</label>
                            <input class="input_form" type="file" name="photo1" id="photo1" />
                            <span class="tooltip">Le numero de telephone n'est pas valide</span>
                        </p>

                        <p>
                            <span class="form_col"></span>
                            <input type="submit" value="Publier cette annonce"/> <input type="reset" value="Réinitialiser le formulaire"/>
                        </p>
                    </form>
                </section>
                <script type="text/javascript" src="../css/form_offer.js"></script>

                <?php include '../include/footer.php'; ?>
            </body>
        </html>
        <?php
    } else {
        //user not activated. Redirect the user to the activation page
        header('Location: activation.php');
    }
} else {
    //user is not logged in. Redirect user to the login page
    header('Location: ../login.php');
}
?>