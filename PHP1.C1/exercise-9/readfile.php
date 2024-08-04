<?php
$filename = readline("Input the file name to be opened:");
if(file_exists($filename))
{
$file = fopen($filename, "r");
echo "The content of the file ".$filename." is:".PHP_EOL;
while(!feof($file))
{
$line = fgets($file);
echo $line;
}
fclose($file);
}
else
{echo "file doesn't exist";
}