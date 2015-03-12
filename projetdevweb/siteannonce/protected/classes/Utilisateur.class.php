<?php

/**
 * Description of utilisateur
 * This class represents a user in the database
 * @author mkab
 * @version 1.0
 */
class Utilisateur extends Constructor {

    /** The id of the user */
    private $id;

    /** The name/pseudo of the user */
    private $nom;

    /** The user's password */
    private $passwd;

    /** The user's telephone number */
    private $telephone;

    /** The user's mail */
    private $mail;

    /** The type of user - <b>particulier</b> or <b>professionnel</b> */
    private $type_util;

    /** The user's status <br/> <b>verify</b> or <b>activated</b> */
    private $status;

    /** The user's activation key */
    private $activationkey;

    /**
     * Sets the id of the user
     * @param type $id - the id to set
     */
    public function setId($id) {
        $this->id = (int) $id;
    }

    /**
     * Sets the name/pseudo of the user
     * @param type $nom - the name to set
     */
    public function setNom($nom) {
        $this->nom = $nom;
    }

    /**
     * Encrypts the password and then sets this password to that of the user
     * @param type $passwd - the password to set
     */
    public function setPasswd($passwd) {
        $this->passwd = hash("sha256", $passwd);
    }

    /**
     * Sets the telephone number of the user
     * @param type $telephone - the telephone to set
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    /**
     * Sets the mail of the user
     * @param type $mail - the mail to set
     */
    public function setMail($mail) {
        $this->mail = $mail;
    }

    /**
     * Sets the type of the user
     * @param type $type_util - the type to set
     */
    public function setType_util($type_util) {
        $this->type_util = $type_util;
    }

    /**
     * Sets the status of the user
     * @param string $status the status to set
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Sets the activation key for the user
     * @param string $activationkey the activation key to set
     */
    public function setActivationkey($activationkey) {
        $this->activationkey = $activationkey;
    }

    /**
     * Returns the id of the user
     * @return int Returns the id of the user
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the name/pseudo of the user
     * @return string Returns the name/pseudo of the user
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Returns the password of the user.
     * @return string  This password is in an encrypted form
     */
    public function getPasswd() {
        return $this->passwd;
    }

    /**
     * Returns the telephone number of the user
     * @return string - Returns the telephone number of the user
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Returns the mail of the user
     * @return string Returns the mail of the user
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * Returns the type of the user
     * @return type The type of the user is either:<br />
     * <ul>
     *   <li>particulier</li> or
     *   <li>professionnel</li>
     * </ul>
     */
    public function getType_util() {
        return $this->type_util;
    }

    /**
     * Returns the status of the user
     * @return type 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Returns the activation key of the user
     * @return string 
     */
    public function getActivationkey() {
        return $this->activationkey;
    }

}

?>