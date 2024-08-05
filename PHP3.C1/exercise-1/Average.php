<?php
declare(strict_types=1);
class Average{
    public  int $number1;
    public  int $number2;
    public  int $number3;
    public float $average;



    public  function setNumber(string $number1, string  $number2, string $number3):void
    {
        $this->number1 = intval($number1);
        $this->number2 = intval($number2);
        $this->number3 = intval($number3);
    }

    public function getAverage():void
    {
        $this->average = ($this->number1 + $this->number2 + $this->number3)/3;
    }

    public function printAverage():void
    {
        $this->getAverage();
        echo round($this->average,2);
    }
}

$number1 = readline('Enter number 1 :');
$number2 = readline('Enter number 2 :');
$number3 = readline('Enter number 3 :');

$calculateAverage = new Average();

$calculateAverage->setNumber($number1, $number2, $number3);

echo "The Average of $number1, $number2, $number3 is ";
echo $calculateAverage->printAverage();




