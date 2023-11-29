<?php
// Database connection details
$servername = "sql9.freesqldatabase.com";
$username = "sql9649975";
$password = "dvneeFGNSS";
$dbname = "sql9649975";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the confirmation code from the URL
$confirmationCode = isset($_GET['code']) ? $_GET['code'] : '';

// Find the user with the given confirmation code
$sql = "SELECT * FROM patientINFO WHERE confirmation_code = '$confirmationCode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, update the account status
    $row = $result->fetch_assoc();
    $userId = $row['id']; // Adjust this based on your actual user ID column name

    // Update the user's account status (e.g., set 'confirmed' to true)
    $updateSql = "UPDATE patientINFO SET confirmed = 1 WHERE id = $userId";

    if ($conn->query($updateSql) === TRUE) {
        echo "Account confirmed successfully. You can now log in.";
    } else {
        echo "Error updating account status: " . $conn->error;
    }
} else {
    echo "Invalid confirmation code or user not found.";
}

// Close the database connection
$conn->close();
?>
