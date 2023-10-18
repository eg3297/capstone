<?php
session_start();
session_destroy();
header("Location: index.html"); // Redirect the user to the login page or any other desired page after logout
?>
