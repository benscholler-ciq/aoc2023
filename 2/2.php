<?php

$file = fopen('input.txt', 'r');
$sum = 0;

while (!feof($file)) {
    $line = fgets($file, 4096);
    $sub = 1;
    foreach (['red', 'green', 'blue'] as $color) {
        $count = preg_match_all("/(\d+)\s$color/", $line, $matches);
        $sub = $sub * max(array_map('intval', $matches[1]));
    }

    $sum += $sub;
}

echo $sum;