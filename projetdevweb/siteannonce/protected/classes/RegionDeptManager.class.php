<?php

/**
 * Description of RegionManager
 * This class's function is to access the table 'region' and 'departement' in the database
 * so as to perform various SQL queries.
 * 
 * @author mkab
 * @version 1.0
 */
class RegionDeptManager {

    /** The database */
    private $db;

    /**
     * Default constructor. Sets the database for the class
     * @param mixed $bdd the database
     */
    public function __construct($bdd) {
        $this->db = $bdd;
    }

    /**
     * Return an array containing the list of all the regions and their respective ids
     * present in the database
     * @return \Region Returns an array containing regions and ther respective ids
     */
    public function getRegions() {
        $regions = array();
        $query = $this->db->query("SELECT * FROM region ORDER BY nom_region");

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $regions[] = new Region($donnees);
        }
        $query->closeCursor;

        return $regions;
    }

    /**
     * Returns an array containing departements
     * @param type $id the regioin id
     * @return \Departement Returns an array containing all the departements present in the database that have the region id $id
     * 
     */
    public function getDepartements($id) {
        $dept = array();

        $query = $this->db->query("SELECT * FROM departement WHERE id_region = '$id'");

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $dept[] = new Departement($donnees);
        }

        $query->closeCursor();


        return $dept;
    }

}

?>
