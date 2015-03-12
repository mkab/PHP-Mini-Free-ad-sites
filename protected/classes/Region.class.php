<?php

/**
 * Description of region
 * This class represents a region in the database.
 * 
 * @author mkab
 * @version 1.0
 */
class Region extends Constructor {

    /** The id of the region */
    private $id_region;

    /** the name of the region */
    private $nom_region;

    /**
     * Sets the id of the region
     * @param type $id_region the id to set
     */
    public function setId_region($id_region) {
        $this->id_region = $id_region;
    }

    /**
     * Sets the name of the region
     * @param type $nom_region the name to set
     */
    public function setNom_region($nom_region) {
        $this->nom_region = $nom_region;
    }

    /**
     * Returns the region's id
     * @return int - the region's id 
     */
    public function getId_region() {
        return $this->id_region;
    }

    /**
     * Returns the region's id
     * @return string - the region's name 
     */
    public function getNom_region() {
        return $this->nom_region;
    }

}

?>
