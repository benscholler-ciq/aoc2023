<?php

$file = fopen('input.txt', 'r');
$max = ["red" => 12, "green" => 13, "blue" => 14];
$sum = 0;

while (!feof($file)) {
    $line = fgets($file, 4096); # Read file
    $roundStart = strpos($line, ':');
    $gameNum = preg_match('/Game\s(\d+)\:/', $line, $gameMatch);

    $redCount = preg_match_all('/(\d+)\sred/', $line, $redMatches);
    $blueCount = preg_match_all('/(\d+)\sblue/', $line, $blueMatches);
    $greenCount = preg_match_all('/(\d+)\sgreen/', $line, $greenMatches);

    $maxRedCount = max(array_map('intval', $redMatches[1]));
    $maxBlueCount = max(array_map('intval', $blueMatches[1]));
    $maxGreenCount = max(array_map('intval', $greenMatches[1]));

    if ($maxRedCount > $max["red"] || $maxBlueCount > $max["blue"] || $maxGreenCount > $max["green"]) {
        continue;
    }

    $sum += intval($gameMatch[1]);
}

echo $sum;