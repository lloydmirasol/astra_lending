<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Forgot Password</h1>
    </header>

    <form action="forgot_password_handler.php" method="POST">
        <label for="email">Enter your email to reset your password:</label>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Reset Password">
    </form>

</body>
</html>
