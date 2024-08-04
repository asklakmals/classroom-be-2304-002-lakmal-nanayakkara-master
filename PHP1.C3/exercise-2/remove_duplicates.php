<?php

// Input string
$input = "1,5,6,2,7,1,8,3,9,7,8";

// Convert input string to an array
$inputArray = explode(",", $input);

// Remove duplicates by converting the array to a set using array_unique
$uniqueArray = array_unique($inputArray);

// Convert the array back to a string with comma-separated values
$output = implode(",", $uniqueArray);

// Output the result
echo $output;

?>
