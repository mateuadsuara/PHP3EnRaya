<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="#" method="GET"><?php   
            include 'board.php';
            include 'piece.php';
            include 'player.php';
            include 'ui.php';

            session_start();
            $board = &$_SESSION["board"];
            $players = &$_SESSION["players"];
            $turn = &$_SESSION["turn"];
            
            if (!$_GET)
            {
                $board = new Board();
                $players = array();
                $turn = 0;
                
                Ui::printNameTextsForm("X", "O");
            }
            else
            {
                $nameA = &$_GET["name_a"];
                $nameB = &$_GET["name_b"];
                
                if (isset($nameA) && isset($nameB)){
                    $players[0] = new Player($nameA, "X");
                    $players[1] = new Player($nameB, "O");
                }
                
                $action = &$_GET["action"];
                
                if (isset($action)){
                    $board->setPiece(
                            new Piece($players[$turn], $players[$turn]->getIcon()),
                            getX($action),
                            getY($action)
                        );
                    changeTurn($turn);
                }
                
                $linePiece = $board->getInitialPieceOfLine();
                if ($linePiece == null){
                    echo "Turno de " . $players[$turn]->getName() .
                            " (" . $players[$turn]->getIcon() . ")" ;
                    echo "<br /><br />";
                } else {
                    echo "El ganador es: " . $linePiece->getOwner()->getName();
                    echo "<br /><br />";
                }
                
                Ui::printBoard($board);
            }
            
            function changeTurn(&$currentTurn){
                $currentTurn = abs($currentTurn-1);
                return $currentTurn;
            }
            
            function getX($action){
                return substr($action, 1, 1);
            }
            
            function getY($action){
                return substr($action, 3, 1);
            }
        ?></form>
    </body>
</html>
