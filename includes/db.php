<?php
$host = "localhost";   // Database host
$user = "root";        // Database username (default: root for XAMPP)
$pass = "";            // Database password (leave empty for XAMPP default)
$dbname = "Homee"; // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
