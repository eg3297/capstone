<?php
$directory = '/var/www/html/Forms'; // Replace with the actual path

$files = scandir($directory);
$files = array_diff($files, array('.', '..')); // Remove . and .. from the list

header('Content-Type: application/json');
echo json_encode(['files' => array_values($files)]);
?>
