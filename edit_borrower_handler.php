<?php
// Include database connection
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];

    // Calculate the interest rate and total amount based on the loan amount
    $interest_rate = ($amount > 10000) ? 12 : 15;
    $total_amount = ($amount * ($interest_rate / 100));

    // Prepare the SQL update query
    $sql = "UPDATE loan_applications SET name = ?, email = ?, phone = ?, amount = ?, interest_rate = ?, total_amount = ? WHERE id = ?";

    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdddi", $name, $email, $phone, $amount, $interest_rate, $total_amount, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: lender_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>