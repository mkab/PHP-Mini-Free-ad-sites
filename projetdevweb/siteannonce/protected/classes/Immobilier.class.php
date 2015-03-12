<?php

/**
 * Description of Immobilier
 *
 * @author mkab
 */
class Immobilier extends Multimedia {

    private $surface;
    private $nbPieces;
    private $classe_energie;
    private $ges;

    public function setSurface($surface) {
        $this->surface = intval($surface);
    }

    public function setNbPieces($nbPieces) {
        $this->nbPieces = intval($nbPieces);
    }

    public function setClasse_energie($classe_energie) {
        $this->classe_energie = $classe_energie;
    }

    public function setGes($ges) {
        $this->ges = intval($ges);
    }

    public function getSurface() {
        return intval($this->surface);
    }

    public function getNbPieces() {
        return intval($this->nbPieces);
    }

    public function getClasse_energie() {
        return $this->classe_energie;
    }

    public function getGes() {
        return $this->ges;
    }

}

?>
