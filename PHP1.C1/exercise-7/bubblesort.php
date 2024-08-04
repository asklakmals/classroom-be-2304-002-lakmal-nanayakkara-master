<?php

$numbers = [72, 15, 69, 1, 62, 95, 8, 51, 55, 39];

$i = 0;
$j = count($numbers)-1;

//outer while
while ($j >0)
{
	//inner while
	while($i<$j)
	{
		if($numbers[$i] > $numbers[$i+1])
		{
			$temp = 0;
			
			$temp = $numbers[$i+1];
			$numbers[$i+1] = $numbers[$i];
			$numbers[$i] = $temp;
		
		}
		
		$i++;
	}
	
	$j--;
	$i = 0;
}

//sorted array
print_r($numbers);



?>