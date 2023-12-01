<?php

$file = fopen('input.txt', 'r');
$sum = 0;

$nums = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
$replace = ['zero0zero', 'one1one', 'two2two', 'three3three', 'four4four', 'five5five', 'six6six', 'seven7seven', 'eight8eight', 'nine9nine'];

while (!feof($file)) {
    $line = str_replace($nums, $replace, fgets($file, 4096)); # Digits replacement
    preg_match_all('/[0-9]/', $line, $matches); # Read line into buffer, regex to find numbers
    if (count($matches) > 0) { # If there are numbers
        $first = $matches[0][0]; # First number from matches
        $last = array_slice($matches[0], -1, 1)[0]; # Last number
        $sum += intval("{$first}{$last}"); # Sum up
    }
}

echo $sum;