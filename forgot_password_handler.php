<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include database connection
include 'db_connect.php';

// Include PHPMailer library files
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and phone number from form
    $email = $_POST['forgotEmail'];
    $phone = $_POST['forgotPhone'];

    // Prepare and execute query to check for matching user in the database
    $sql = "SELECT * FROM loan_applications WHERE email = ? AND phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows > 0) {
        // Generate a password reset token
        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

        // Update database with reset token and expiry
        $updateSql = "UPDATE loan_applications SET reset_token = ?, reset_expiry = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sss", $token, $expiry, $email);
        $updateStmt->execute();

        // Send reset email
        $resetLink = "http://localhost/astra_lending/reset_password.php?token=" . $token;


        $mail = new PHPMailer(true);
        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'llme.mirasol.up@phinmaed.com'; // Replace niyo yung Gmail
            $mail->Password = 'giky jhmv tkii yljq'; // Replace yung email pass
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email settings
            $mail->setFrom('your_email@gmail.com', 'Astra Lending');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the link below to reset your password:<br><br><a href='" . $resetLink . "'>Reset Password</a>";

            $mail->send();
            echo 'A password reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "No matching user found with that email and phone number.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
