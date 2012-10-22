<?php
/**
 * Description of Tablero
 *
 * @author demonh3x
 */
class Board {
    private $square;
    
    function __construct() {
        $this->square = array(
                            array(null, null, null),
                            array(null, null, null),
                            array(null, null, null)
                          );
    }
    
    function xSize() {
        return count($this->square[0]);
    }
    
    function ySize() {
        return count($this->square);
    }
    
    private function _isInRange($x, $y) {
        return (($x >= 0 && $x < $this->xSize()) &&
                ($y >= 0 && $y < $this->ySize()));
    }
    
    function getPiece($x, $y) {
        if ($this->_isInRange($x, $y)) {
            return $this->square[$y][$x];
        }
    }
    
    function setPiece($piece, $x, $y){
        if ($this->getInitialPieceOfLine() == null) {
            if ($this->_isInRange($x, $y)) {
                $this->square[$y][$x] = $piece;
            }
        }
    }
    
    private function _hasVerticalLine(){
        $line = false;
        $initialPiece = null;
        
        for ($x = 0; $x < $this->xSize(); $x++) {
            $initialPiece = $this->getPiece($x, 0);
            if ($initialPiece == null){
                continue;
            }
            
            for ($y = 1; $y < $this->ySize(); $y++) {
                if ($initialPiece != $this->getPiece($x, $y)){
                    $line = false;
                    break;
                } else {
                    $line = true;
                }
            }
            
            if ($line){
                break;
            }
        }
        
        if ($line){
            return $initialPiece;
        } else {
            return null;
        }
    }
    
    private function _hasHorizontalLine(){
        $line = false;
        $initialPiece = null;
        
        for ($y = 0; $y < $this->ySize(); $y++) {
            $initialPiece = $this->getPiece(0, $y);
            if ($initialPiece == null){
                continue;
            }
            
            for ($x = 1; $x < $this->xSize(); $x++) {
                if ($initialPiece != $this->getPiece($x, $y)){
                    $line = false;
                    break;
                } else {
                    $line = true;
                }
            }
            
            if ($line){
                break;
            }
        }
        
        if ($line){
            return $initialPiece;
        } else {
            return null;
        }
    }
    
    private function _hasDiagonalALine(){
        $line = false;
        
        $initialPiece = $this->getPiece(0, 0);
        if ($initialPiece == null){
            return null;
        }

        $minSize = min($this->xSize(), $this->ySize());
        for ($i = 1; $i < $minSize; $i++) {
            if ($initialPiece != $this->getPiece($i, $i)){
                $line = false;
                break;
            } else {
                $line = true;
            }
        }

        if ($line){
            return $initialPiece;
        } else {
            return null;
        }
    }
    
    private function _hasDiagonalBLine(){
        $line = false;
        
        $minSize = min($this->xSize(), $this->ySize()) -1;
        $initialPiece = $this->getPiece(0, $minSize);
        if ($initialPiece == null){
            return null;
        }
        
        for ($i = $minSize; $i >= 0; $i--) {
            if ($initialPiece != $this->getPiece(abs($i-$minSize), $i)){
                $line = false;
                break;
            } else {
                $line = true;
            }
        }

        if ($line){
            return $initialPiece;
        } else {
            return null;
        }
    }
    
    private function _hasDiagonalLine(){
        $diagonalA = $this->_hasDiagonalALine();
        if ($diagonalA != null){
            return $diagonalA;
        }
        
        $diagonalB = $this->_hasDiagonalBLine();
        if ($diagonalB != null){
            return $diagonalB;
        }
        
        return null;
    }
    
    function getInitialPieceOfLine(){
        $horizontal = $this->_hasHorizontalLine();
        if ($horizontal != null){
            return $horizontal;
        }
        
        $vertical = $this->_hasVerticalLine();
        if ($vertical != null){
            return $vertical;
        }
        
        $diagonal = $this->_hasDiagonalLine();
        if ($diagonal != null){
            return $diagonal;
        }
        
        return null;
    }
}
?>
