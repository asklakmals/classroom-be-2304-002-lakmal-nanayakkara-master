<?php
declare(strict_types=1);

$mysqli = new mysqli("localhost", "root", "", "techcorp");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sql = "CREATE TABLE employees (
id INT PRIMARY KEY,
firstname VARCHAR(50),
age INT,
department VARCHAR(50),
salary DECIMAL(10,2)
)";

//create table
if ($mysqli->query($sql) === true) {
    echo "Table employees created successfully" . PHP_EOL;
} else {
    echo "Error creating table: " . $mysqli->error . PHP_EOL;
}

//insert 5 records
$dummyData = "INSERT INTO employees(id,firstname, age, department, salary)
    VALUES(1,'John',45,'it',2000),(2,'Peter',25,'admin',1500),(3,'Kelly',31,'it',1600),(4,'lia',33,'finance',1750),(5,'Sean',35,'maintenance',1300)";

if ($mysqli->query($dummyData) === true) {
    echo "5 records have been inserted to employees table successfully" . PHP_EOL;
} else {
    echo "Error inserting data to table: " . $mysqli->error . PHP_EOL;
}

//get all records
function viewTable($mysqli)
{
    $allRecords = "SELECT *
FROM employees";

    $selectResult = $mysqli->query($allRecords);

    if ($selectResult) {
        echo "Get All records successfully" . PHP_EOL;
    } else {
        echo "Error fetching all  table: " . $mysqli->error . PHP_EOL;
    }

    $rows = $selectResult->fetch_all(MYSQLI_ASSOC);
    echo "------------------------------------------" . PHP_EOL;
    foreach ($rows as $row) {
        echo $row["id"] .
            " " .
            $row["firstname"] .
            " " .
            $row["age"] .
            " " .
            $row["department"] .
            " " .
            $row["salary"] .
            PHP_EOL;
    }
    echo "------------------------------------------" . PHP_EOL;
    $selectResult->free_result();
}

viewTable($mysqli);

//update records
$updateSalary = "UPDATE employees
SET employees.salary = employees.salary*1.1";

$updateResult = $mysqli->query($updateSalary);

if ($updateResult) {
    echo "Update all salaries by 10% successfully" . PHP_EOL;
} else {
    echo "Error updating all salaries by 10%  table: " . $mysqli->error . PHP_EOL;
}

viewTable($mysqli);

//delete employee with id number 3
$deleteEmployee = "DELETE FROM employees
WHERE id=3";

$deleteResult = $mysqli->query($deleteEmployee);

if ($deleteResult) {
    echo "Delete employee with id no 3 successfully" . PHP_EOL;
} else {
    echo "Delete employee with id no 3 table: " . $mysqli->error . PHP_EOL;
}

viewTable($mysqli);

//add column to employees table
$alterEmployee = "ALTER TABLE employees
ADD COLUMN position varchar(50) AFTER age";

$alterResult = $mysqli->query($alterEmployee);

if ($alterResult) {
    echo "Add position column to employee successfully" . PHP_EOL;
} else {
    echo "Add position column to employee table: " . $mysqli->error . PHP_EOL;
}

//truncate employees table
$truncateEmployee = "TRUNCATE employees";

$truncateResult = $mysqli->query($truncateEmployee);

if ($truncateResult) {
    echo "Truncate employee table successfully" . PHP_EOL;
} else {
    echo "Truncate employee table: " . $mysqli->error . PHP_EOL;
}

//drop table
$dropTable = "DROP TABLE employees";

$dropResult = $mysqli->query($dropTable);

if ($dropResult) {
    echo "Drop employee table successfully" . PHP_EOL;
} else {
    echo "Drop employee table: " . $mysqli->error . PHP_EOL;
}

$mysqli->close();
