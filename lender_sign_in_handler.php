<?php
session_start(); // Start session to store user info

// Include the database connection
include 'db_connect.php';

// Get the form data from the sign-in form
$email = $_POST['email'];
$password = $_POST['password'];

// Query the database to find the lender's account by email
$sql = "SELECT * FROM lenders WHERE email='$email'";
$result = $conn->query($sql);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo '<div class="alert success" id="successMessage">Connected successfully</div>';
}

if ($result->num_rows > 0) {
    // Fetch the lender's details
    $lender = $result->fetch_assoc();

    // Debugging: Output entered password and hashed password from database
    var_dump($password);  // Entered password
    var_dump($lender['password']); // Hashed password from the database

    // Verify the password using password_verify()
    if (password_verify($password, $lender['password'])) {
        // If password is correct, set session variables and redirect to the dashboard
        $_SESSION['user_email'] = $email;
        $_SESSION['user_type'] = 'lender';
        header("Location: lender_dashboard.php");
    } else {
        // Password is incorrect
        echo "Invalid password!";
    }
} else {
    // Email does not exist in the database
    echo "Invalid email!";
}

$conn->close();
?>


