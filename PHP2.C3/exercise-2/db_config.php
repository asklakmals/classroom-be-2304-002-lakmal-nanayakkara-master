<?php
$servername = "localhost"; // change if your server is different
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "product_reviews"; // the database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>