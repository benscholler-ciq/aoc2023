<?php

$file = fopen('input.txt', 'r');
$sum = 0;

while (!feof($file)) { # Read line into buffer
    preg_match_all('/[0-9]/', fgets($file, 4096), $matches); # Regex to find numbers
    if (count($matches) > 0) { # If there are numbers
        $first = intval($matches[0][0]); # First number from matches
        $last = intval(array_slice($matches[0], -1, 1)[0]); # Last number
        $sum += intval("{$first}{$last}"); # Sum up
    }
}

echo $sum;