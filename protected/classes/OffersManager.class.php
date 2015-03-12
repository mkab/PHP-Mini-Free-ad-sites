<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OffersManager
 *
 * @author mkab
 */
class OffersManager {

    /** The database */
    private $db;

    /**
     * Default constructor. Sets the database of the class
     * @param mixed $bdd is the database 
     */
    public function __construct($bdd) {
        $this->db = $bdd;
    }

    public function add(Multimedia $data) {
        $table = strtolower(get_class($data));
        echo $table;
        if ($table == 'multimedia') {
            $query = $this->db->prepare("INSERT INTO multimedia
                VALUES (:id, :prix, :titre, :description, :id_utilisateur, :id_type, :id_dept, :id_region, :photo1, NOW(), NOW())");
            return $query->execute(array('id' => $data->getId_annonce(),
                        'prix' => $data->getPrix(),
                        'titre' => $data->getTitre(),
                        'description' => $data->getDescription(),
                        'id_utilisateur' => $data->getId_utilisateur(),
                        'id_type' => $data->getId_type(),
                        'id_dept' => $data->getDept(),
                        'id_region' => $data->getRegion(),
                        'photo1' => $data->getPhoto()
                    ));
        } else if ($table == 'immobilier') {
            
        }
    }

    public function getIdType($param) {
        $query = $this->db->query("SELECT id_type FROM type WHERE nom_type = '$param'");
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}

?>
