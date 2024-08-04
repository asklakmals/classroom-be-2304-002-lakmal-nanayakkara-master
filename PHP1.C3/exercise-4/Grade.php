<?php

$noOfStudents = trim(readline("enter number of students : ".PHP_EOL));


while(!(ctype_digit($noOfStudents) xor $noOfStudents == "0")){
    echo "enter a natural number except 0".PHP_EOL;
    $noOfStudents = readline("enter number of students : ".PHP_EOL);
}

$noOfStudents = (int) $noOfStudents;
$studentGrade = [];
$marks = [];
$names = [];

for($i = 0; $i< $noOfStudents; $i++)
    {
        echo PHP_EOL;
        //student name
        $oneName = trim(readline("enter student name #". ($i+1) ." : "));

        while( !(preg_match("/^[a-zA-Z\s]+$/", $oneName) xor in_array($oneName,$names))){
            echo "You may have entered non-alphabetic characters or a previously entered name.".PHP_EOL;
            $oneName = trim(readline("enter student name #".($i+1)." : "));
        }
        $studentGrade[$i][0] = $names[$i] = $oneName;

        //student mark
        $oneMark = trim(readline("enter student mark #".($i+1)." : "));

        while(!ctype_digit($oneMark)){
            echo "not a number. enter number only".PHP_EOL;
            $oneMark = trim(readline("enter student mark #".($i+1) ." : "));
        }

        $studentGrade[$i][1] = $marks[$i] = (int) $oneMark;

    }

    rsort($marks);

echo PHP_EOL."average grade of the class : ". number_format(array_sum($marks)/$noOfStudents, 2).PHP_EOL;

echo PHP_EOL."student(s) with the highest grade".PHP_EOL;

foreach ($studentGrade as $value )
{
    if($value[1] == $marks[0])
    {
        echo "name: ".$value[0]." grade: ".$value[1].PHP_EOL;
    }
}
