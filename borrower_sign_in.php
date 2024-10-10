<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower Sign In - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9fafb;
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
            justify-content: center;
        }
        .logo {
            height: 50px;
            margin-right: 15px;
        }
        .hometitle h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #38a37f;
            text-align: center;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            margin: 30px auto;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        form input[type="email"],
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
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
        }
        form input[type="submit"]:hover {
            background-color: #2e8566;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .back-button {
            color: #f2ad4b;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #ffc47d;
        }
        .forgot-password {
            color: #38a37f;
            text-decoration: none;
            font-weight: bold;
            margin-left: 10px;
        }
        .forgot-password:hover {
            color: #f0ad4e;
        }
        #forgotPasswordPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            z-index: 1000;
        }
        #forgotPasswordPopup h2 {
            color: #38a37f;
            text-align: center;
        }
        #forgotPasswordPopup form {
            text-align: center;
        }
        #forgotPasswordPopup button {
            background-color: #e0e0e0;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        #blurBackground {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            z-index: 999;
            display: none;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
        <h1>Astra Lending Co.</h1>
    </div>
</header>

<form action="borrower_sign_in_handler.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Sign In">
    <div class="button-container">
        <a href="user_selection.php" class="back-button">&larr; Back</a>
        <a href="#" onclick="openForgotPassword()" class="forgot-password">Forgot Password?</a>
    </div>
</form>

<div id="blurBackground"></div>
<div id="forgotPasswordPopup">
    <h2>Forgot Password</h2>
    <form action="forgot_password_handler.php" method="POST" onsubmit="return validateForgotPasswordForm()">
        <label for="forgotEmail">Email:</label>
        <input type="email" id="forgotEmail" name="forgotEmail" required><br><br>

        <label for="forgotPhone">Phone Number:</label>
        <input type="tel" id="forgotPhone" name="forgotPhone" required><br><br>

        <input type="submit" value="Submit">
        <button type="button" onclick="closeForgotPassword()">Cancel</button>
    </form>
</div>

<script>
    function openForgotPassword() {
        document.getElementById('forgotPasswordPopup').style.display = 'block';
        document.getElementById('blurBackground').style.display = 'block';
    }

    function closeForgotPassword() {
        document.getElementById('forgotPasswordPopup').style.display = 'none';
        document.getElementById('blurBackground').style.display = 'none';
    }

    function validateForgotPasswordForm() {
        var email = document.getElementById('forgotEmail').value;
        var phone = document.getElementById('forgotPhone').value;
        // Add custom validation if needed
        if (email === '' || phone === '') {
            alert('Please fill out all fields.');
            return false;
        }
        return true;
    }
</script>

</body>
</html>