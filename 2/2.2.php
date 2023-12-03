<?php

$file = fopen('input.txt', 'r');
$sum = 0;

while (!feof($file)) {
    $line = fgets($file, 4096);
    $sub = 1;
    foreach (['red', 'green', 'blue'] as $color) {
        preg_match_all("/(\d+)\s$color/", $line, $matches);
        $sub *= max($matches[1]);
    }
    $sum += $sub;
}

echo $sum;