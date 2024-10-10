<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lender Sign In - Astra Lending</title>
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
        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #38a37f;
            text-decoration: none;
            font-weight: bold;
        }
        .forgot-password:hover {
            color: #f0ad4e;
        }
        .back-button {
            color: #f2ad4b;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            width: fit-content;
            margin-bottom: 20px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #ffc47d;
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

<form action="lender_sign_in_handler.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Sign In">
    <a href="user_selection.php" class="back-button">&larr; Back</a>
</form>

</body>
</html>