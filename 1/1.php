<?php

$file = fopen('input.txt', 'r');
$sum = 0;

while (!feof($file)) {
    preg_match_all('/[0-9]/', fgets($file, 4096), $matches); # Read line into buffer, regex to find numbers
    if (count($matches) > 0) { # If there are numbers
        $first = $matches[0][0]; # First number from matches
        $last = array_slice($matches[0], -1, 1)[0]; # Last number
        $sum += intval("{$first}{$last}"); # Sum up
    }
}

echo $sum;