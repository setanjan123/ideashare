<?php
$servername = "localhost";
$username = "moi";
$password = "12345";
$dbname = "isdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>