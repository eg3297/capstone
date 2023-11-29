<?php
$directory = '/var/www/html/Forms'; 

$files = scandir($directory);
$files = array_diff($files, array('.', '..')); 

header('Content-Type: application/json');
echo json_encode(['files' => array_values($files)]);
?>
