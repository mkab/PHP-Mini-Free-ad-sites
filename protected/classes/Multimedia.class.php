<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offers
 * <b>Note<b>: This can serve as a class for multimedia
 * @author mkab
 */
class Multimedia extends Constructor {

    /** The id of the offer */
    private $id_annonce;

    /** The price of the item */
    private $prix;

    /** The title of the offer */
    private $titre;

    /** The description of the offer */
    private $description;

    /** The id of the user who postulated the offer */
    private $id_utilisateur;

    /** The type of the offer */
    private $id_type;

    /** The departement where the offer is located */
    private $dept;

    /** The region where the offer is located */
    private $region;
    private $photo1;

    public function setId_annonce($id_annonce) {
        $this->id_annonce = $id_annonce;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setId_type($id_type) {
        $this->id_type = $id_type;
    }

    public function setDept($dept) {
        $this->dept = $dept;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function setPhoto1($photo) {
        $this->photo1 = $photo;
    }

    public function getId_annonce() {
        return intval($this->id_annonce);
    }

    public function getPrix() {
        return intval($this->prix);
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getId_utilisateur() {
        return intval($this->id_utilisateur);
    }

    public function getId_type() {
        return intval($this->id_type);
    }

    public function getDept() {
        return intval($this->dept);
    }

    public function getRegion() {
        return intval($this->region);
    }

    public function getPhoto() {
        return $this->photo1;
    }

}

?>
