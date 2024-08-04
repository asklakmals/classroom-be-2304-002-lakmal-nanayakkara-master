<?php
$filename = "test.txt";
if(!is_writable($filename))
{
$somecontent = readline("Input a sentence for the file:");
$fp = fopen($filename, "w");
fwrite($fp, $somecontent);
fclose($fp);
echo "The file test.txt created successfully!";
}
else
{
echo "file $filename exist. Cannot create a new file";
}