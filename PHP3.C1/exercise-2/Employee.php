<?php

declare(strict_types=1);
class Employee{
    public string $name;
    public string $department;
    public float $salary;

    function __construct(string $name, string $department, float $salary){
        $this->name = $name;
        $this->department = $department;
        $this->salary = $salary;
    }

    public function viewSalary():void
    {
        echo $this->salary;
    }

    public function raiseSalary(float $percentage):void
    {
        $this->salary = $this->salary*(100+$percentage)/100;
    }
}

$companyEmployee = new Employee("John Doe", "Finance", 50000);

$companyEmployee->viewSalary();

echo PHP_EOL;

$companyEmployee->raiseSalary(10);

$companyEmployee->viewSalary();