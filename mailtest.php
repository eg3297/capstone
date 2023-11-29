<?php
$to = 'test-se6qy3rsl@srv1.mail-tester.com';
$subject = 'Test Email';
$message = 'This is a test email.';
$headers = 'From: webmaster@example.com';

if (mail($to, $subject, $message, $headers)) {
    echo 'Test email sent successfully.';
} else {
    echo 'Error sending test email.';
}
?>
