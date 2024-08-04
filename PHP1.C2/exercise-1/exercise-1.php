<?php
$input = readline("Input numbers 0 - 9 in text format. separate digits with comma (,)".PHP_EOL);
$numbers = explode(",",$input);

foreach($numbers as $number){
	
	switch(strtolower(trim($number)))
	{
		case "zero":
		echo "0";
		break;
		
		case "one":
		echo "1";
		break;
		
		case "two":
		echo "2";
		break;
		
		case "three":
		echo "3";
		break;
		
		case "four":
		echo "4";
		break;
		
		case "five":
		echo "5";
		break;
		
		case "six":
		echo "6";
		break;
		
		case "seven":
		echo "7";
		break;
		
		case "eight":
		echo "8";
		break;
		
		case "nine":
		echo "9";
		break;
		
		default:
		echo "NAN";
		break;
	}
}
?>