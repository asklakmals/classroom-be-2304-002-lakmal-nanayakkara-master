<?php
$numbers = [1, 3, 67, 1, 8, 34, 90, 2, 88, 1, 777, 1, 0, 3, 8, 2, 9, 7, 8, 6, 5];


//solution #1

/*function findMax($numbers)
{
    rsort($numbers);

    return $numbers[0];
}*/

//solution #2
/*function findMax($numbers)
{
    $max = $numbers[0];
    foreach ($numbers as $number)
    {
        if($max < $number){
            $max = $number;
        }
    }

    return $max;
}*/

//solution #3
function findMax($numbers)
{
    $max = $numbers[0];

    for($i = 1; $i < sizeof($numbers); $i++)
    {
        if($max < $numbers[$i])
        {
            $max = $numbers[$i];
        }
    }

    return $max;
}

echo "output: Max is ".findMax($numbers);

