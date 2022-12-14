<h1 style="text-align: center">Tests</h1> 
<img src="https://img.freepik.com/vector-gratis/ilustracion-concepto-prueba-movil_114360-1564.jpg?w=2000&t=st=1665226438~exp=1665227038~hmac=dabd783f834a078bafc84785444532c1c9d41d4c551608a4933f299bd9f0df0e" alt="Ilustración del concepto de prueba móvil">
<hr>

## PHP Apps

<br>
### [ Three in a Row ]
<br>


Develop a game app based on "Three in Row", you need two players for it and every one of them will use `X` or `O` respectively and, whenever there's an empty position, there'll be a "-". The board itself will be a char type 3x3 matrix. The game will end whenever one of the players makes *three-in-a-row* or when there's no more free spaces in the board. The app, for it, will need to ask for every player movements and check if *three-in-a-row* condition is fulfilled and if the position is or no in use.

- [PHP file](php/three-in-row/ex1.php)

```php
<?php

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
```
<br>
<br>


## JavaScript
<hr>


## Bibliografía
<a href="http://www.freepik.com">Designed by stories | Freepik</a>

