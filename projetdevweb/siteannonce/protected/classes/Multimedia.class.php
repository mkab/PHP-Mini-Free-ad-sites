<?php

/**
 * Description of Multimedia
 * <b>Note<b>: This can serve as an upper class for other classes.
 * Other classes can inherit evryting from this class.
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

    /** The photo of the offer */
    private $photo1;

    /** The date the offer was made */
    private $date_offre;

    /** The time the offer was made */
    private $time_offre;

    /**
     * Sets the id of the offer
     * @param int $id_annonce - the id to set
     */
    public function setId_annonce($id_annonce) {
        $this->id_annonce = $id_annonce;
    }

    /**
     * Sets the price of the offer
     * @param type $prix - the price to set
     */
    public function setPrix($prix) {
        $this->prix = $prix;
    }

    /**
     * Sets the title of the offer
     * @param type $titre - the title to set
     */
    public function setTitre($titre) {
        $this->titre = $titre;
    }

    /**
     * Sets the description of the offer
     * @param type $description - the description to set
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Sets the id of the user who made the offer
     * @param type $id_utilisateur - the id of the user to set
     */
    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * Sets the type of the offer (multimedia informatique...)
     * @param type $id_type - the id to set
     */
    public function setId_type($id_type) {
        $this->id_type = $id_type;
    }

    /**
     * Sets the id of the location (department) of the offer
     * @param type $dept - the department numer to set
     */
    public function setId_dept($dept) {
        $this->dept = $dept;
    }

    /**
     * Sets the id of the location (region) of the offer
     * @param type $region - the region to set
     */
    public function setId_region($region) {
        $this->region = $region;
    }

    /**
     * Sets the photo of the offer
     * @param type $photo - the photo to set
     */
    public function setPhoto1($photo) {
        $this->photo1 = $photo;
    }

    public function setDate_offre($date_offre) {
        $this->date_offre = $date_offre;
    }

    public function setTime_offre($time_offre) {
        $this->time_offre = $time_offre;
    }

    /**
     * Returns the id of the offer
     * @return int
     */
    public function getId_annonce() {
        return intval($this->id_annonce);
    }

    /**
     * Returns the price of the offer
     * @return int
     */
    public function getPrix() {
        return intval($this->prix);
    }

    /**
     * Returns the title of the offer
     * @return string 
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Returns the description of the offer
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Returns the id of the user who made the offer
     * @return type 
     */
    public function getId_utilisateur() {
        return intval($this->id_utilisateur);
    }

    /**
     * Return the id of the type of the offer
     * @return int
     */
    public function getId_type() {
        return intval($this->id_type);
    }

    /**
     * Return the id of departement where the offer is located
     * @return int 
     */
    public function getDept() {
        return intval($this->dept);
    }

    /**
     * Return the id of region where the offer is located
     * @return int 
     */
    public function getRegion() {
        return intval($this->region);
    }

    /**
      Return the photo of nthe offer
     * @return type 
     */
    public function getPhoto1() {
        return $this->photo1;
    }

    public function getDate_offre() {
        return $this->date_offre;
    }

    public function getTime_offre() {
        return $this->time_offre;
    }

}

?>
