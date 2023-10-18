<?php
$servername = "sql9.freesqldatabase.com";
$username = "sql9649975";
$password = "dvneeFGNSS";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>