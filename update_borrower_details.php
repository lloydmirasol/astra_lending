<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';

    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update borrower's password in the database
    $update_sql = "UPDATE loan_applications SET password='$new_password' WHERE email='$borrower_email'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: borrower_dashboard.php");
        exit();
    } else {
        echo "Error updating details: ". $conn->error;
    }

    $conn->close();
}
?>