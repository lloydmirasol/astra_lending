<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include database connection
include 'db_connect.php';

// Include PHPMailer library files
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$amount = $_POST['amount'];
$interestRate = $_POST['interestRate'];
$totalAmount = $_POST['totalAmount'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Generate a unique confirmation token
$token = bin2hex(random_bytes(32));

// Insert the loan application into the database with a "Pending" status
$sql = "INSERT INTO loan_applications (name, email, phone, address, password, amount, interest_rate, total_amount, status, confirmation_token)
        VALUES ('$name', '$email', '$phone', '$address', '$hashed_password', '$amount', '$interestRate', '$totalAmount', 'Pending', '$token')";


if ($conn->query($sql) === TRUE) {
    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'llme.mirasol.up@phinmaed.com';         // Your Gmail address
        $mail->Password   = 'giky jhmv tkii yljq';            // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Astra Lending');
        $mail->addAddress($email); // Send to borrower's email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Confirm Your Loan Application';
        $confirmation_link = "http://localhost/astra_lending/confirm_application.php?token=$token";
        $mail->Body    = "Hello $name,<br><br>Please confirm your loan application by clicking the link below:<br><a href='$confirmation_link'>$confirmation_link</a><br><br>Thank you!";

        // Send email
        $mail->send();
        echo 'Loan application submitted successfully. Please check your email to confirm the application.';
        
        // Redirect to check email page
        header("Location: check_email.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
