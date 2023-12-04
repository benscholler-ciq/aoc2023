<?php

$file = fopen('input.txt', 'r');
$sum = 0;

while (!feof($file)) {
    $line = fgets($file, 4096);
    $params = explode('|', $line);
    preg_match_all('/(\d+)/', $params[0], $winningNums); # Find winning numbers
    preg_match_all('/(\d+)/', $params[1], $ourCard); # Find numbers on our card

    $winningCount = $sub = 0;
    foreach (array_slice($winningNums[0], 1) as $winner) { # Search for winners
        if (in_array($winner, $ourCard[0])) { # Winner found
            if ($winningCount == 0) { # Init on first winner
                $sub = 1;
            } else { # Double after new winners found
                $sub *= 2;
            }
            $winningCount++;
        }
    }

    $sum += $sub;
}

echo $sum;