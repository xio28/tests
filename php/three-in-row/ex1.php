<?php

// Notifica todos los errores (E_ALL) excepto (^) E_WARNING y E_NOTICE.
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
/*
    Realizar el juego del 3 en raya, donde habrá dos jugadores que tengan que hacer el 3 en raya, los
    signos serán la X y la O y cuando exista una posición vacía habrá un -. El tablero de juego será una
    matriz de 3x3 de tipo char. El juego termina cuando uno de los jugadores hace 3 en raya o si no hay
    más posiciones que poner. Para ello, el juego deberá solicitar a cada jugador actual donde quiere
    poner el valor (X o O dependiendo del jugador), ver si ya tiene el tres en raya y comprobar que no
    haya un valor en esa posición.
*/
function cls() {
    print("\033[2J\033[;H");
}

function board() {
    $board = [];

    for($i = 0; $i < 3; $i++) {
        $arr = [];
        for($x = 0; $x < 3; $x++) {
            array_push($arr, '-');
        }
        array_push($board, $arr);
    }
    
    return $board;
}

function checkMove($board, $move) {
    if($board[$move[0]][$move[1]] === '-') {
        return true;
    }
    return false;
}

function threeInRow($board, $player) {

    $mark = ($player === 1) ? 'X' : 'O';

    foreach($board as $bInd => $row) {
        if(($board[$bInd][0] === $mark) && ($board[$bInd][1] === $mark) && ($board[$bInd][2] === $mark)) {
            return true;
        }
        else if(($board[0][$bInd] === $mark) && ($board[1][$bInd] === $mark) && ($board[2][$bInd] === $mark)) {
            return true;
        }
        else if($board[1][1] === $mark) {
            if((($board[0][0] === $mark) && ($board[2][2] === $mark)) || (($board[0][2] === $mark) && ($board[2][0] === $mark))) {
                return true;
            }
        }
    }

    return false;
}

function printBoard($board) {
    $table = str_repeat("-", 13);

    foreach($board as $rInd => $row) {
        foreach($row as $cInd => $col) {
            if($cInd === 0) {
                echo '| '.$col.' | ';
            } else {
                echo $col.' | ';
            }
        }
        
        if($rInd !== sizeof($board) - 1) {
            echo "\n";
            echo $table;
            echo "\n";
        }
    }
}

function fullBoard($board) {
    $counter = 0;

    foreach($board as $row) {
        foreach($row as $col) {
            if(($col === "-")) {
                $counter++;
            }
        }
    }

    if($counter === 0) {

        echo 'Ha habido un empate.';
        echo "\n";
        return true;
    }

    return false;
}


function letsGame() {
    $continue = readline("¿Quieres jugar al tres en raya?(s/n): ");

    while(strtolower($continue) === "s") {
        echo "\n\nIndica tu jugada de la siguiente forma: fila-posición,\nejemplo: 2-1; marca el primer lugar de la fila 2.\n\n";

        $board = board();
        $i = 1;

        while(!threeInRow($board, $i) || !fullBoard($board)) {
            printBoard($board);
            echo "\n\n";
            $move = preg_split("/[\s\-_,.]+/", readline('Jugador '.$i.', elige jugada: '));
            echo "\n";

            if(checkMove($board, $move)) {
                ($i === 1) ? $board[$move[0]][$move[1]] = 'X' : $board[$move[0]][$move[1]] = 'O';
                if(threeInRow($board, $i)) {
                    cls();
                    echo "\n¡Tres en raya del jugador $i!\n\n";
                    break;
                }
                ($i === 1) ? $i = 2 : $i = 1;
                cls();
            } else {
                cls();
                echo "La posición está ocupada o está fuera de rango; elige otra.\n";
                echo "\n";
            }
        }
        printBoard($board);
        echo "\n\n";
        $continue = readline("¿Quieres jugar otra partida?(s/n): ");
    }
    
    // La despedida.
    echo "\nGracias por jugar :).\n\n";
    echo "";
    return;
}

letsGame();

?>
