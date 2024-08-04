<?php

if ($argc != 3) {
    echo "Incorrect number of arguments. Please provide exactly two digits.\n";
    exit(1);
}

$x = $argv[1];
$y = $argv[2];

if (!is_numeric($x) || !is_numeric($y) || intval($x) != $x || intval($y) != $y) {
    echo "Incorrect digits passed. Digits should be integers and x < y\n";
    exit(1);
}

$x = intval($x);
$y = intval($y);

if ($x >= $y) {
    echo "Incorrect digits passed. Digits should be integers and x < y\n";
    exit(1);
}

for ($i = $x; $i <= $y; $i++) {
    echo $i . "\n";
}

?>