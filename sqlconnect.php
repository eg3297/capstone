<?php
$mysqli = new mysqli(
    "sql9649975",
    "sql9649975",
    "dvneeFGNSS",
    "sql9649975"
);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Enable SSL/TLS for the connection
$mysqli->ssl_set(NULL, NULL, NULL, NULL, NULL);

// Establish the connection with SSL/TLS
if (!$mysqli->real_connect()) {
    die("Failed to connect to MySQL with SSL/TLS: " . $mysqli->connect_error);
}

echo "Connected successfully!";
?>
