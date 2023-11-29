<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
* {box-sizing: border-box;}

body { 
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.header {
  position: relative;
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
  pointer-events: none; /* Prevent the logo from being clickable */
}

.header a.logo img {
  height: 50px; 
  width: auto; /* Maintain aspect ratio */
  vertical-align: middle;
}

.header a:hover {
  background-color: #ddd;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

.header a.button-container {
  position: relative;
  display: inline-block;
  margin-right: 5px;
}

.header a.button-container:before,
.header a.button-container:after {
  content: '|';
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  color: black;
  font-weight: bold;
  font-size: 18px;
}

.header a.button-container:before {
  left: -10px;
}

.header a.button-container:after {
  right: -10px;
}

/* Hide the last "|" on the last button */
.header a.button-container:last-child:after {
  display: none;
}


.header-title {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 24px;
  font-weight: bold;
  color: #000; /* Set the title color to black */
  text-decoration: none; /* Remove underline */
}

#welcome {
  padding: 10px; /* Adjust the padding */
  text-align: right; /* Align text to the right */
  margin-top: 5px; /* Adjust the margin to move it up */
  display: flex;
  align-items: center;
}

#welcome-container {
  display: flex;
  align-items: center;
}

#profile-picture {
  width: 50px; /* Set the width of the circular image space */
  height: 50px; /* Set the height of the circular image space */
  background-color: #ccc; /* Set a background color for the image space */
  border-radius: 50%; /* Make it circular */
  margin-right: 10px; /* Add margin to separate it from the text */
}

#logout-button-container {
  margin-left: auto; /* Push it to the far right */
  display: flex;
  align-items: center;
}

#dashboard {
  display: flex;
  justify-content: space-between;
  padding: 20px;
}

#upcoming-appointments {
  width: 30%;
  background-color: #f0f0f0;
  padding: 20px;
  margin-right: 10px;
}

#care-team-messages {
  width: 60%;
  background-color: #f0f0f0;
  padding: 20px;
  margin-right: 10px;
}

#action-links {
  width: 30%;
  background-color: #f0f0f0;
  padding: 20px;
}

.action-link {
  margin-bottom: 10px;
}

/* Style headers and horizontal rules */
.category-header {
  background-color: lightblue; /* Light blue background */
  padding: 10px;
  border-top: 1px solid #ccc; /* Top border to separate from content */
  border-bottom: 1px solid #ccc; /* Bottom border to separate from content */
}
.header-title:hover {
  text-decoration: none;
  color: #000;
}
</style>
    <title>Welcome</title>
</head>
<body>
<div class="header">
  <a href="#" class="logo">
    <img src="hoslogo.png" alt="CompanyLogo">
  </a>

  <div class="header-right">
    <a href="PlogIn.html">Patient Portal</a>
    <a href="Slogin.html">Staff Portal</a>
    <a href="registrationspage.html">Registration</a>
  </div>

  <a href="homepage.html" class="header-title">Med-E-Form</a>
</div>
<div id="welcome">
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
        $sql = "SELECT name FROM staffINFO WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            
            echo '<div id="welcome-container">';
            echo '<div id="profile-picture"></div>'; // Circular image space
            echo '<div id="welcome">Hello, ' . $name . '!</div>';
            
            // Add a logout button
            echo '<form action="logout.php" method="post">';
            echo '<input type="submit" name="logout" value="Logout">';
            echo '</form>';
            
            echo '</div>';
        } else {
            echo "<div id=\"welcome-container\"><div id=\"welcome\">Welcome, guest!</div></div>";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "<div id=\"welcome-container\"><div id=\"welcome\">Welcome, guest!</div></div>";
    }
    ?>
</div>
<hr>
<div id="dashboard">
  <div id="upcoming-appointments">
    <h3 class="category-header">Upcoming Appointments</h3>
    <hr>
    
  </div>

  <div id="care-team-messages">
    <h3 class="category-header">Messages from Patients</h3>
    <hr>
    
  </div>

  <div id="action-links">
    <h3 class="category-header">Quick Actions</h3>
    <hr>
    <div class="action-link">
      <a href="sampleform.html">Create Form</a>
    </div>
    <div class="action-link">
      <a href="#">New Patient Message</a>
    </div>
    <div class="action-link">
      <a href="patient_list.php">Patient List</a>
	</div>

      <div class="action-link">
        <a href="FormsDirectory.html">Forms Directory</a>
    </div>
  </div>
</div>
<hr>
</body>
</html>
