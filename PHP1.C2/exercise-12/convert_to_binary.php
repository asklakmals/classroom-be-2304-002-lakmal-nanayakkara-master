<?php

if ($argc != 2) {
    echo "Incorrect number passed. Number should be integer.\n";
    exit(1);
}

$input = $argv[1];

if (!is_numeric($input) || intval($input) != $input) {
    echo "Incorrect number passed. Number should be integer.\n";
    exit(1);
}

$number = intval($input);
$binary = str_pad(decbin($number), 8, '0', STR_PAD_LEFT);

echo "Binary representation: $binary\n";

?>
