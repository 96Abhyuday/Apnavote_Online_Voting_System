<?php
$host = "localhost";
$username = "root";
$password = "abhi123"; // leave empty if using XAMPP default
$database = "apnavote";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



