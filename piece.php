<?php
/**
 * Description of Ficha
 *
 * @author demonh3x
 */
class Piece {
    private $owner;
    private $icon;
    
    public function __construct($owner, $icon) {
        $this->owner = $owner;
        $this->icon = $icon;
    }
    
    public function getIcon() {
        return $this->icon;
    }
    
    public function getOwner() {
        return $this->owner;
    }
}

?>
