<?php
// Include the database connection
include 'db_connect.php';

// Example email and password (replace these with actual form data if necessary)
$email = 'lender@example.com';
$password = 'password123';

// Hash the password using password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new lender account into the database
$sql = "INSERT INTO lenders (email, password) VALUES ('$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New lender account created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
