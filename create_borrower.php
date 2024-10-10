<?php
// Include database connection
include 'db_connect.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new borrower account into the database
$sql = "INSERT INTO borrowers (name, email, phone, address, password) VALUES ('$name', '$email', '$phone', '$address', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New borrower account created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lender Sign In - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Lender Sign In</h1>
</header>

<form action="lender_sign_in_handler.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Sign In">
</form>

</body>
</html>