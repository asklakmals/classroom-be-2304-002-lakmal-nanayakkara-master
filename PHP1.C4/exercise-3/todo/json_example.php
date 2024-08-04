<?php

$testArray = [
    "students" => ["student1", "student2", "student3"],
    "classes" => ["class1", "class2", "class3"],
    "iteration" => 2,
];

$jsonData = json_encode($testArray);

print_r($jsonData);

$arrayData = json_decode($jsonData, true);

print_r($arrayData["students"]);