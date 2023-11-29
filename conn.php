
<?php
// Connect to the database 
$host = "localhost";
$username = "root";
$password = "";
$database = "e-commerce_db";

//create database connection

$conn = new mysqli($host, $username, $password, $database);

//check the connection


if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
}


if ($conn ===true) {
    echo "connection successful!!";

} 
?>