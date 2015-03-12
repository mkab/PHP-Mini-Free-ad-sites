<?php

/**
 * Description of UtilisateurManager
 * This class's function is to access the table 'utilisateur' in the database
 * so as to perform various SQL queries.
 * 
 * @author mkab
 * @version 1.0
 */
class UtilisateurManager {

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
     * Adds a user to the database
     * @param Utilisateur $user: the user to be added to the database
     * @return boolean Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.   
     */
    public function add(Utilisateur $user) {
        if ($user->getTelephone() === '') {
            $user->setTelephone(NULL);
        }

        //prepared staement to insert the user in the database
        $query = $this->db->prepare("INSERT INTO utilisateur 
            VALUES(:id, :nom, :passwd, :telephone, :mail, :type_util, :status, :activationkey)");


        return $query->execute(array('id' => $user->getId(),
                    'nom' => $user->getNom(),
                    'passwd' => $user->getPasswd(),
                    'telephone' => $user->getTelephone(),
                    'mail' => $user->getMail(),
                    'type_util' => $user->getType_util(),
                    'status' => $user->getStatus(),
                    'activationkey' => $user->getActivationkey()
                ));
    }

    /**
     * Returns a user from the database
     * @param type $username
     * @param type $password
     * @return \Utilisateur|boolean Returns a user who has a username of  
     * <b>$username</b> and  a password <b>$password</b> in the database, else it returns <b>FALSE</b>
     */
    public function login($mail, $password) {
        //query to find the user in the database
        $password = hash('sha256', $password);
        $query = $this->db->query("SELECT * FROM utilisateur WHERE mail='$mail' AND passwd='$password'");

        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if ($donnees) {
            return new Utilisateur($donnees);
        }

        return FALSE;
    }

    /**
     *
     * @param Utilisateur $user
     * @return boolean 
     */
    public function sendActivationMail(Utilisateur $user) {
        $to = $user->getMail();
        $subject = 'Annoncegratuit.com: Registration';
        $message = "Bienvenue sur notre site " . $user->getNom() . "! \r \r 
                        Vous, ou quelqu'un utilisant votre adresse e-mail, a complété l'inscription à annoncegratuit.olympe-network.com. 
                        Vous pouvez compléter l'inscription en cliquant sur le lien suivant: \r
                        http://annoncegratuit.olympe-network.com/verify.php?" . $user->getActivationkey() .
                "\r \r S'il s'agit d'une erreur, ignorez ce message et vous serez retiré de notre liste.
                        \r \r Cordialement, \r =============================\r
                        Equipe Annoncegratuit :annoncegratuit.olympe-network.com \r
                        Email: annoncegratuit@olympe-network.com";

        $headers = 'From: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
                'Reply-To: noreply@annoncegratuit.olympe-network.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        return mail($to, $subject, $message, $headers);
    }

    /**
     * Returns a user from a given id
     * @param type $id
     * @return \Utilisateur|boolean 
     */
    public function getUserFromId($id) {
        $query = $this->db->query("SELECT * FROM utilisateur WHERE id ='$id'");
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if ($donnees) {
            return new Utilisateur($donnees);
        }

        return FALSE;
    }

    /**
     *
     * @param type $key
     * @return \Utilisateur|boolean 
     */
    public function getUserFromActivationKey($key) {
        $query = $this->db->query("SELECT * FROM utilisateur WHERE activationkey = '$key'");

        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if ($donnees) {
            return new Utilisateur($donnees);
        }

        return FALSE;
    }

    /**
     * Returns a user who has the given mail
     * @param type $mail
     * @return \Utilisateur|boolean 
     */
    public function getUserFromMail($mail) {
        $query = $this->db->query("SELECT * FROM utilisateur WHERE mail = '$mail'");

        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if ($donnees) {
            return new Utilisateur($donnees);
        }

        return FALSE;
    }

    /**
     * Activates a user's account
     * @param Utilisateur $user
     * @return boolean true on success, false on failure 
     */
    public function activateUser(Utilisateur $user) {
        $query = $this->db->prepare("UPDATE utilisateur SET status = :status, activationkey = :activationkey 
            WHERE id = :id");

        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':status', 'activated', PDO::PARAM_STR);
        $query->bindValue(':activationkey', '', PDO::PARAM_STR);

        return $query->execute();
    }

    /**
     * Updates a user's password
     * @param Utilisateur $user
     * @return boolean TRUE on success, FALSE on failure
     */
    public function updateUserPasswd(Utilisateur $user) {
        $query = $this->db->prepare("UPDATE utilisateur SET passwd = :passwd WHERE id = :id");

        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':passwd', $user->getPasswd(), PDO::PARAM_STR);

        return $query->execute();
    }

}

?>
