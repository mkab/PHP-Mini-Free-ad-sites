<?php

/*
 * Database Configuration information is stored here.
 */

class DBConf {

    /** Databse URL */
    private $databaseURL = "sql.olympe-network.com";

    /** Database username */
    private $databaseUserName = "171155_jannonce";

    /** Database password */
    private $databasePWord = "soccernet234$";

    /** Database name */
    private $databaseName = "171155_jannonce";

    /**
     * Returns the database's url
     * @return string 
     */
    public function getDatabaseURL() {
        return $this->databaseURL;
    }

    /**
     * Returns the database username
     * @return string 
     */
    public function getDatabaseUserName() {
        return $this->databaseUserName;
    }

    /**
     * Returns the database password
     * @return string 
     */
    public function getDatabasePWord() {
        return $this->databasePWord;
    }

    /**
     * Returns the database name
     * @return string 
     */
    public function getDatabaseName() {
        return $this->databaseName;
    }

}

?>