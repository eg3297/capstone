<?php

$servername = "sql9.freesqldatabase.com";
$username = "sql9649975";
$password = "dvneeFGNSS";
$dbname = "sql9649975";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$pw = $_POST['pw'];


$sql = "SELECT * FROM patientINFO WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
   
    $row = $result->fetch_assoc();
    $storedHashedPassword = $row['pw'];

    if (password_verify($pw, $storedHashedPassword)) {
       
        session_start();
        $_SESSION['email'] = $email;
        header("Location: welcome.php"); 
    } else {
        
        echo "Invalid Password";
    }
} else {
   
    echo "Cant Find Account";
}


$conn->close();
?>
