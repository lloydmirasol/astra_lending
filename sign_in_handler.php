<?php
session_start();

// Include the database connection
include 'db_connect.php';

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Handle sign-in based on user type
if ($user_type == 'lender') {
    // Check if the email and password match a lender in the database
    $sql = "SELECT * FROM lenders WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_type'] = 'lender';
        header("Location: lender_dashboard.php");
    } else {
        echo "Invalid email or password for lender!";
    }
} elseif ($user_type == 'borrower') {
    // Check if the email and password match a borrower in the database
    $sql = "SELECT * FROM borrowers WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_type'] = 'borrower';
        header("Location: borrower_dashboard.php");
    } else {
        echo "Invalid email or password for borrower!";
    }
}

$conn->close();
?>
