<?php

/**
 * Description of OffersManager
 * This class's function is to access the table 'multimedia', 'infornatique' and 'vehicules'
 * in the database so as to perform various SQL queries and return required results.
 * @author mkab
 * @version: 1.0
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

    /**
     * Adds an offer to the database.
     * This function verifies the offer type so as to insert the latter into
     * its appropriate table
     * @param Multimedia $data
     * @return boolean <b>TRUE</b> on success, <b>FALSE</b> on failure.
     */
    public function add($data) {
        $table = strtolower(get_class($data));
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
                        'photo1' => $data->getPhoto1()
                    ));
        } else if ($table == 'immobilier') {
            $query = $this->db->prepare("INSERT INTO immobilier
                VALUES (:id, :surface, :nbPieces, :classe_energie, :ges,
                :prix, :titre, :description, :id_utilisateur, :id_type, :id_dept,
                :id_region, :photo1, NOW(), NOW())");
            return $query->execute(array('id' => $data->getId_annonce(),
                        'surface' => $data->getSurface(),
                        'nbPieces' => $data->getNbPieces(),
                        'classe_energie' => $data->getClasse_energie(),
                        'ges' => $data->getGes(),
                        'prix' => $data->getPrix(),
                        'titre' => $data->getTitre(),
                        'description' => $data->getDescription(),
                        'id_utilisateur' => $data->getId_utilisateur(),
                        'id_type' => $data->getId_type(),
                        'id_dept' => $data->getDept(),
                        'id_region' => $data->getRegion(),
                        'photo1' => $data->getPhoto1()
                    ));
        }
    }

    /**
     * Return the id of a type of offer 
     * @param type $param - a string
     * @return array - an array containg the id of the type of offer 
     */
    public function getIdType($param) {
        $query = $this->db->query("SELECT id_type FROM type WHERE nom_type = '$param'");
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Returns the number of offers present in a particuler table
     * @param a database table - $table - the table to count the number of offers
     * @return int 
     */
    public function getNumberOfOffers($table, $id) {
        if ($id == -1) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM $table");
        } else {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM $table WHERE id_region=" . $id);
        }
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    /**
     *
     * @param type $arr
     * @param type $id
     * @return \Multimedia 
     */
    public function getAllOffers($arr, $id) {
        $result = array();
        if ($id == -1) {
            $sql = 'SELECT id_annonce, prix, titre, description, id_utilisateur, id_type, id_dept, id_region, photo1, 
                date_offre, DATE_FORMAT(time_offre, \'%H:%i\') as time_offre
                FROM multimedia UNION ALL 
                SELECT id_annonce, prix, titre, description, id_utilisateur, id_type, id_dept, id_region, photo1, 
                date_offre, DATE_FORMAT(time_offre, \'%H:%i\') as time_offre
                FROM immobilier
                ORDER BY date_offre DESC, time_offre DESC
                LIMIT ' . $arr[0] . ', ' . $arr[1];
        } else {
            $sql = 'SELECT id_annonce, prix, titre, description, id_utilisateur, id_type, id_dept, id_region, photo1, 
                date_offre, DATE_FORMAT(time_offre, \'%H:%i\') as time_offre
                FROM multimedia UNION ALL 
                SELECT id_annonce, prix, titre, description, id_utilisateur, id_type, id_dept, id_region, photo1, 
                date_offre, DATE_FORMAT(time_offre, \'%H:%i\') as time_offre
                FROM immobilier WHERE id_region = \'' . $i . '\'
                ORDER BY date_offre DESC, time_offre DESC
                LIMIT ' . $arr[0] . ', ' . $arr[1];
        }
        $query = $this->db->query($sql);

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Multimedia($donnees);
        }
        return $result;
    }

    /**
     *
     * @param type $user_id
     * @param type $offer_id
     * @param type $offerType
     * @return \Multimedia|\Immobilier 
     */
    public function getUsersOffer($user_id, $offer_id, $offerType) {
        if ($offerType == 'informatique' || $offerType == 'consolesjeux' || $offerType == 'telephonie') {
            $query = $this->db->query('SELECT * FROM multimedia WHERE id_annonce=' . $offer_id . ' 
                    AND id_utilisateur=' . $user_id);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return new Multimedia($result);
        } else if ($offerType == 'vente' || $offerType == 'location' || $offerType == 'colocation') {
            $query = $this->db->query('SELECT * FROM immobilier WHERE id_annonce=' . $offer_id . ' 
                    AND id_utilisateur=' . $user_id);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return new Immobilier($result);
        }
    }

    /**
     * Returns a departement name from a given id
     * @param int $id
     * @return string 
     */
    public function getDeptName($id) {
        $query = $this->db->query("SELECT nom_dept FROM departement WHERE id_dept='$id'");
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['nom_dept'];
    }

    /**
     * Return the region name from a given id
     * @param int $id
     * @return string 
     */
    public function getRegionName($id) {
        $query = $this->db->query("SELECT nom_region FROM region WHERE id_region='$id'");
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['nom_region'];
    }

    /**
     * Return the name of type of offer from a given id
     * @param int $id
     * @return string 
     */
    public function getNameType($id) {
        $query = $this->db->query("SELECT nom_type FROM type WHERE id_type='$id'");
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['nom_type'];
    }

}

?>
