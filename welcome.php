<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <div>
        <h2>Welcome to our website!</h2>
        <?php
        // Check if the user is authenticated and has a session
        session_start();
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

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

            // SQL query to retrieve the user's name
            $sql = "SELECT name FROM patientINFO WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                echo "<p>Hello, $name! We're glad you're here.</p>";
            } else {
                echo "<p>Welcome, guest!</p>";
            }

            // Close the database connection
            $conn->close();

            // Add a logout button
            echo '<form action="logout.php" method="post">';
            echo '<input type="submit" name="logout" value="Logout">';
            echo '</form>';
        } else {
            echo "<p>Welcome, guest!</p>";
        }
        ?>

        <p>Feel free to explore our website.</p>
    </div>
</body>
</html>
