<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\EXCEPTION;

// Include PHPMailer library files from the correct location
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';


// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Specify main SMTP server (Gmail)
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'llme.mirasol.up@phinmaed.com';   // SMTP username (your Gmail)
    $mail->Password   = 'giky jhmv tkii yljq';                           // SMTP password (your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
    $mail->Port       = 587;                              // TCP port to connect to

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Astra Lending');
    $mail->addAddress('recipient@example.com');           // Add a recipient (replace with actual email)

    // Email content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent using PHPMailer.';

    // Send email
    $mail->send();
    echo 'Email has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
