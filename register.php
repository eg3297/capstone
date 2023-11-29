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

// Retrieve user input from the HTML form
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$password = isset($_POST['pw']) ? $_POST['pw'] : '';
$accountType = isset($_POST['account-type']) ? $_POST['account-type'] : '';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Determine the table name based on the selected account type
if ($accountType === "patient") {
    $tableName = "patientINFO";
} elseif ($accountType === "staff") {
    $tableName = "staffINFO";
} else {
    // Handle invalid account types or provide an error message.
    echo "Invalid account type selected.";
    $conn->close();
    exit; // Exit the script
}

// SQL query to insert user information into the appropriate table
$sql = "INSERT INTO $tableName (name, email, phone, pw) VALUES ('$name', '$email', '$phone', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful. <a href='" . ($accountType === 'patient' ? 'PlogIn.html' : 'Slogin.html') . "'>Click here to login</a>.";
    // You can redirect the user to a login page or display a confirmation message here.
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
	<link rel="stylesheet" href="ploginstyle.css">
</head>
<body>

</body>
</html>