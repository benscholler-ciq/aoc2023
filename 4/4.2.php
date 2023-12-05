<?php

$file = fopen('input.txt', 'r');
$sum = $lineNum = 0;
$multiplierArray = [];

while (!feof($file)) {
    $sum++; # Include original card in total
    $lineNum++;
    $line = fgets($file, 4096);
    $params = explode('|', $line);
    preg_match_all('/(\d+)/', $params[0], $winningNums); # Find winning numbers
    preg_match_all('/(\d+)/', $params[1], $ourCard); # Find numbers on our card

    $winningCount = 0;
    foreach (array_slice($winningNums[0], 1) as $winner) { # Search for winners
        if (in_array($winner, $ourCard[0])) { # Winner found
            $winningCount++;
        }
    }

    if ($winningCount > 0) { # We have winners?
        for ($i = 0; $i <= $winningCount; $i++) {
            $key = $lineNum + $i; # Create line key
            if (!array_key_exists($key, $multiplierArray)) { # Init
                $multiplierArray[$key] = 1;
            } else {
                $multiplierArray[$key] *= $winningCount;
            }
        }
    }

    $sum += $winningCount * $multiplierArray[$lineNum];
}

echo $sum;