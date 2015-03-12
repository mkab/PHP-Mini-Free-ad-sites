<?php

/**
 * Description of Constructor
 * An abstract class that contains common contructors for other classes
 * Other classes will inherit this class
 * @author mkab
 * @version 1.0
 */
abstract class Constructor {

    /**
     * Default constructor of the class
     * @param array $donnees an array of data to populate the object in question
     */
    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    /**
     * Provides the data necessary for an object for its proper functioning
     * This method uses the settersof the class to hydrate the object
     * @param array $donnees an array of data to populate an object
     */
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

}

?>
