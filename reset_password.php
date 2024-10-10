<?php
session_start();

// Check if the reset token is provided
if (!isset($_GET['token'])) {
    echo "Invalid token.";
    exit();
}

$token = $_GET['token'];

// Include the database connection
include 'db_connect.php';

// Check if the token is valid
$sql = "SELECT * FROM loan_applications WHERE reset_token='$token' AND reset_expiry < NOW()";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Invalid or expired token. <br>";
    echo "Current Time: " . date("Y-m-d H:i:s") . "<br>";
    echo "Token: " . htmlspecialchars($token) . "<br>";
    exit();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo {
            height: 50px;
            margin-right: 15px;
        }
        .hometitle h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #38a37f;
        }
        section {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #38a37f;
            text-align: center;
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #38a37f;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            display: block;
            margin: 20px auto;
        }
        form input[type="submit"]:hover {
            background-color: #2e8566;
        }
    </style>
</head>
<body>

<header>
    <a href="index.html" class="hometitle">
        <div class="logo-container">
            <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
            <h1> Astra Lending Co.</h1>
        </div>
    </a>
</header>

<section>
    <h2>Reset Your Password</h2>
    <form action="reset_password_handler.php" method="POST" onsubmit="return validatePasswordMatch()">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter new password" required><br><br>

        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required><br><br>

        <input type="submit" value="Reset Password">
    </form>
</section>

<script>
    function validatePasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        if (password !== confirmPassword) {
            alert('Passwords do not match. Please try again.');
            return false;
        }
        return true;
    }
</script>

</body>
</html>
