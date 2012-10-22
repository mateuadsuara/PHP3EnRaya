<?php

/**
 * Description of display
 *
 * @author demonh3x
 */
class Ui {
    static function printBoard($board){
        echo "<table border='1'>";
        
        for ($y = 0; $y < $board->xSize(); $y++) {
            echo "<tr>";
            
            for ($x = 0; $x < $board->ySize(); $x++) {
                echo "<td style='width: 50px;' align='center'>";
                
                $piece = $board->getPiece($x, $y);
                if ($piece != null){
                    echo $piece->getIcon();
                } else {
                    if ($board->getInitialPieceOfLine() == null){
                        Ui::printSubmitButton($x, $y);
                    } else{
                        echo "-";
                    }
                }
                
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    private static function printSubmitButton($x, $y){
        echo "<input type='submit' name='action' value='x" . $x . "y" . $y . "'/>";
    }
    
    static function printNameTextsForm($iconA, $iconB) {
        echo 'Jugador A (' . $iconA . '):<input type="text" name="name_a"/>
            Jugador B (' . $iconB . '):<input type="text" name="name_b"/>
            <input type="submit"/>';
    }
}

?>
