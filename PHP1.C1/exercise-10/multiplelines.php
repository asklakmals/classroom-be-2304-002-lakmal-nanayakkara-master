<?php
$i = 0;
$j = readline("Input the number of lines to be written: ");
$file = "a.txt";
$fp = fopen($file,"a+");
echo PHP_EOL.":: The lines are ::".PHP_EOL;
while($i < $j)
{
//$line = readline("Input line ". $i+1 ." : ");
$line = readline();
fwrite($fp, $line.PHP_EOL);
$i++;
}
fclose($fp);
// print lines
$fp2 = fopen($file,"r");
echo PHP_EOL."The content of the file test.txt is:".PHP_EOL;
while(!feof($fp2))
{
$readfileline = fgets($fp2);
echo $readfileline;
}
fclose($fp2);