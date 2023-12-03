<?php

$file = fopen('input.txt', 'r');
$lineNum = 0;
$allMatches = $register = [];

## Read matches from file into array
while (!feof($file)) {
    $lineNum++;
    $line = fgets($file, 4096);
    preg_match_all('/([^a-zA-Z0-9.\n])/', $line, $specials, PREG_OFFSET_CAPTURE);
    preg_match_all('/(\d+)/', $line, $nums, PREG_OFFSET_CAPTURE);
    $allMatches[$lineNum] = [
        'specials' => $specials[0],
        'nums' => $nums[0]
    ];
}

## Find special characters and add numbers next to specials
foreach ($allMatches as $lineNum => $matches) {
    if (empty($matches['specials'])) { # No special characters this line, nothing to include
        continue;
    }

    foreach ($matches['specials'] as $match) { # Every special character, look back/current/forward
        $specialPosition = $match[1]; # Where we are
        $previousNums = $allMatches[$lineNum - 1]['nums'];
        $nextNums = $allMatches[$lineNum + 1]['nums'];

        ## Determine neighbors
        determineNeighbors($lineNum - 1, $previousNums, $specialPosition, $register);
        determineNeighbors($lineNum + 1, $nextNums, $specialPosition, $register);
        determineNeighbors($lineNum, $matches['nums'], $specialPosition, $register);
    }
}

function determineNeighbors($lineNum, $numbers, $specialPosition, &$register) {
    foreach ($numbers as $num) {
        $start = $num[1]; # Box of number
        $end = $start + strlen((string) $num[0]);

        if ($specialPosition <= $end && $specialPosition + 1 >= $start) { # Are we in the bounding box
            $register[$lineNum][$num[1]] = $num[0]; # Register it
        }
    }
}

# Sum register values
$sum = $otherSum = 0;
foreach ($register as $lineNum => $line) {
    $sum +=  array_sum(array_values($line));
}

echo $sum;
