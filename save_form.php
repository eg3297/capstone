<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input if needed
    $questions = isset($_POST['questions']) ? $_POST['questions'] : [];
    $filename = isset($_POST['filename']) ? $_POST['filename'] : 'generated_form';

    // Generate HTML form content
    $htmlContent = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Question Form</title>
  <link rel="stylesheet" href="../ploginstyle.css">
</head>

<body>
<div class="header">
        <a href="http://54.89.221.160/homepage.html" class="logo">
          <img src="../hoslogo.png" alt="CompanyLogo">
        </a>
      
        <div class="header-right">
            <a href="PlogIn.html">Patient Portal</a>
            <a href="Slogin.html">Staff Portal</a>
            <a href="registrationspage.html">Registration</a>
        </div>
      
        <a href="homepage.html" class="header-title">Med-E-Form</a>
      </div>


<h2>Fill out the Form</h2>

<form action="process_answers.php" method="post">';

    foreach ($questions as $question) {
        $htmlContent .= '<label>' . $question . ':</label>
                        <input type="text" name="answers[]" required>
                        <br>';
    }

    $htmlContent .= '<button type="submit">Submit Answers</button>
</form>

</body>
</html>';

    // Specify the full path to the directory
    $directory = '/var/www/html/Forms/';


    // Save the HTML content to a file with the user-provided filename
    $file = fopen($directory . $filename . '.html', 'w');

    if ($file) {
        fwrite($file, $htmlContent);
        fclose($file);

        // Set headers for file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '.html"');
        header('Content-Length: ' . filesize($directory . $filename . '.html'));

        // Output the file content for download
        readfile($directory . $filename . '.html');

        // Optional: You can delete the file after download if needed
        // unlink($directory . $filename . '.html');
        
        exit;
    } else {
        echo 'Error saving the form: ' . error_get_last()['message'];
    }
}
?>
