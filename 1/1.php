<?php

$file = fopen('input.txt', 'r');
$sum = 0;
while (!feof($file)) { # Read line into buffer
    preg_match_all('/[0-9]/', fgets($file, 4096), $matches); # Regex to find numbers
    if (count($matches) > 0) { # If there are numbers
        $first = array_shift($matches[0]); # Pop off first number from matches
        $last = (count($matches[0]) > 0) ? array_slice($matches[0], -1, 1)[0] : ''; # Get last number if it exists and not first element
        $sum += "{$first}{$last}"; # Sum up
    }
}

echo $sum;