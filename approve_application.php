<?php
session_start();

// Check if the user is logged in as a lender
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] != 'lender') {
    header("Location: lender_sign_in.php");
    exit();
}

// Include the database connection
include 'db_connect.php';

// Check if loan_id is set
if (isset($_POST['loan_id'])) {
    $loan_id = $_POST['loan_id'];

    // Update the status of the loan application to 'Approved'
    $sql = "UPDATE loan_applications SET status = 'Approved' WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $loan_id);

    if ($stmt->execute()) {
        // Redirect back to pending applications page after approval
        header("Location: pending_applications.php");
        exit();
    } else {
        echo "Error approving application: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
