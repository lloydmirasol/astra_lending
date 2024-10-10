<?php
session_start();
include 'db_connect.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get login form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email && $password) {
        // Check if the email exists in the loan_applications table
        $sql = "SELECT * FROM loan_applications WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $borrower = $result->fetch_assoc();

            // Verify the entered password with the hashed password in the database
            if (password_verify($password, $borrower['password'])) {
                // Password matches, set session and redirect to borrower dashboard
                $_SESSION['user_email'] = $email;
                $_SESSION['user_type'] = 'borrower';
                header("Location: borrower_dashboard.php");
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "Invalid email!";
        }
    } else {
        echo "Please provide both email and password.";
    }
} else {
    echo "Please use the sign-in form.";
}

$conn->close();
?>
