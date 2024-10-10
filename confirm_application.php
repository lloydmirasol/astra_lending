<?php
// Include database connection
include 'db_connect.php';

// Get the confirmation token from the URL
$token = $_GET['token'];

// Update the loan status to "Confirmed" if the token is valid
$sql = "UPDATE loan_applications SET status='Confirmed' WHERE confirmation_token='$token'";

if (\$conn->query(\$sql) === TRUE) {
    \$message = "Loan application confirmed! Your application is now being processed.";
    \$message_type = "success";
} else {
    \$message = "Invalid confirmation token!";
    \$message_type = "error";
}

\$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Confirmation - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .confirmation-message {
            font-size: 1.2rem;
            color: #333;
        }
        .confirmation-message.success {
            color: #38a37f;
        }
        .confirmation-message.error {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1>Astra Lending Co.</h1>
        <p class="confirmation-message <?php echo htmlspecialchars(\$message_type); ?>">
            <?php echo htmlspecialchars(\$message); ?>
        </p>
    </div>
</body>
</html>