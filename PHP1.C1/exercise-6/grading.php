<?php
$mark = readline("Please Enter Your Mark\n\n");
$letter = "";
$percentage = 0;
$credit = 0;
/*
Assumed Grading Scale
This Grading Scale could be wrong!
A - 4.0
B - 3.0
C - 2.0
D - 1.0
F - 0.0
*/

if($mark <= 100 && $mark >=90)
{
	$letter = "A";
	$credit = 4;
}
elseif($mark <= 89 && $mark >=80)	
{
	$letter = "B";
	$credit = 3;
}
elseif($mark <= 79 && $mark >=70)
{
	$letter = "C";
	$credit = 2;
}
elseif($mark <= 69 && $mark >=60)
{
	$letter = "D";
	$credit = 1;
}
else
{
	$letter = "F";
	$credit = 0;
}
/*
Assumed Calculation
This calculation could be wrong!
*/
$percentage = ($credit/4)*100;

echo "Your grade of $mark corresponds to a letter grade of $letter and a percentage score of $percentage%.";
?>