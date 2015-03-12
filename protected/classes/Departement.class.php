<?php

/**
 * Description of Departement
 * Represents the departements in the database
 * 
 * @author mkab
 * @version 1.0
 */
class Departement extends Constructor {

    /** The id of the departement */
    private $id_dept;

    /** The name of the departement */
    private $nom_dept;

    /** The id of the departement's region */
    private $id_region;

    /**
     * Sets the departement id
     * @param type $id_dept 
     */
    public function setId_dept($id_dept) {
            $this->id_dept = $id_dept;
    }

    /**
     * Sets the name of the departement 
     * @param type $nom_dept  the name to set
     */
    public function setNom_dept($nom_dept) {
        $this->nom_dept = $nom_dept;
    }

    /**
     * Sets the id of the region of the departement
     * @param int $id_region the id to set
     */
    public function setId_region($id_region) {
            $this->id_region = $id_region;
    }

    /**
     * Returns the id of the department
     * @return int 
     */
    public function getId_dept() {
        return $this->id_dept;
    }

    /**
     * Returns the name of the departement
     * @return string 
     */
    public function getNom_dept() {
        return $this->nom_dept;
    }

    /**
     * Returns the id of the departement's region
     * @return int 
     */
    public function getId_region() {
        return $this->id_region;
    }

}

?>
