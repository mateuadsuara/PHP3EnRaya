<?php
/**
 * Description of Jugador
 *
 * @author demonh3x
 */
class Player {
    private $name;
    private $icon;
    
    public function __construct($name, $icon) {
        $this->name = $name;
        $this->icon = $icon;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getIcon(){
        return $this->icon;
    }
}

?>
