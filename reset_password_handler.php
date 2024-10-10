<?php
// Include the database connection
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the token and the new password from the form
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate the passwords
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare a query to select the user based on the reset token
    $sql = "SELECT * FROM loan_applications WHERE reset_token = ? AND reset_expiry < NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the user exists, update the password
    if ($result->num_rows > 0) {
        $updateSql = "UPDATE loan_applications SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ss", $hashedPassword, $token);
        if ($updateStmt->execute()) {
            echo "Password has been reset successfully. You can now <a href='borrower_sign_in.php'>sign in</a>.";
        } else {
            echo "Error resetting password. Please try again later.";
        }
    } else {
        echo "Invalid or expired token.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
