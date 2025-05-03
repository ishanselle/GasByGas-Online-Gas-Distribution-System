<?php
$servername = "localhost"; // Change if not running locally
$username = "root"; // Your database username
$password = "ishan@2001"; // Your database password
$dbname = "gasbygas"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
