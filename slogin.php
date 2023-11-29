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
$email = $_POST['email'];
$pw = $_POST['pw'];

// SQL query to retrieve user information
$sql = "SELECT * FROM staffINFO WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User with the provided email found
    $row = $result->fetch_assoc();
    $storedHashedPassword = $row['pw'];

    if (password_verify($pw, $storedHashedPassword)) {
        // Passwords match, user is valid
        session_start();
        $_SESSION['email'] = $email;
        header("Location: swelcome.php"); // Redirect to a welcome page
    } else {
        // Passwords do not match, show an error message and redirect after a delay
        echo "Invalid Password. You will be redirected in 15 seconds. <a href='index.html'>Click here</a> if you are not redirected.";

        // JavaScript to redirect after 15 seconds or when the user clicks the link
        echo "<script>
            setTimeout(function() {
                window.location.href = 'homepage.html';
            }, 15000); // 15 seconds delay
        </script>";
    }
} else {
    // User with the provided email not found, show an error message
    echo "Can't Find Account";
}

// Close the database connection
$conn->close();
?>
