<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $questions = isset($_POST['questions']) ? $_POST['questions'] : [];
    $defaultFilename = 'generated_form';

    // Generate HTML form content
    $htmlContent = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Question Form</title>
</head>
<body>

<h2>Fill out the Form</h2>

<form action="process_answers.php" method="post">
    <label for="filename">File Name:</label>
    <input type="text" name="filename" id="filename" placeholder="' . $defaultFilename . '" required>
    <br>';

    foreach ($questions as $question) {
        $htmlContent .= '<label>' . $question . ':</label>
                        <input type="text" name="answers[]" required>
                        <br>';
    }

    $htmlContent .= '<button type="submit">Submit Answers</button>
</form>

</body>
</html>';

    
    $directory = '/var/www/html/Forms';

    // Save the HTML content to a file with the user-provided filename
    if (isset($_POST['filename'])) {
        $filename = $_POST['filename'];
    } else {
        $filename = $defaultFilename;
    }

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

     

        exit;
    } else {
        echo 'Error saving the form: ' . error_get_last()['message'];
    }
}
?>
