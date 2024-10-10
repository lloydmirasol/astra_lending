<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose User Type - Astra Lending</title>
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
            height: 100px;
            margin-right: 15px;
        }
        .hometitle h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #38a37f;
        }
        .applytitle {
            text-align: center;
            font-size: 2em;
            color: #38a37f;
            margin-bottom: 40px;
        }
        .user-selection {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            gap: 30px;
        }
        .user-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 200px;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .user-card img {
            width: 150px;
            height: 150px;
            margin-bottom: 15px;
        }
        .user-button {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1em;
            color: #ffffff;
            font-weight: bold;
            transition: background-color 0.3s, box-shadow 0.3s;
            display: inline-block;
        }
        .borrower {
            background-color: #38a37f;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .lender {
            background-color: #f0ad4e;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .user-button:hover {
            opacity: 0.9;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
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
    <nav>   
        <ul>
            <div class="navbutton">
            <li><a href="index.html">Home</a></li>
            </div>
            
            <div class="buttons">
                <a href="/astra_lending/apply_loan.php" class="applybutton">Apply for Loan</a>
            </div>
        </ul>
    </nav>
</header>

<div><h1 class="applytitle">Please choose your role to continue</h1></div>
<div class="user-selection">

    <!-- Borrower Card -->
    <div class="user-card">
        <img src="images/borrower_icon.svg" alt="Borrower Icon">
        <a href="borrower_sign_in.php" class="user-button borrower">Borrower</a>
    </div>

    <!-- Lender Card -->
    <div class="user-card">
        <img src="images/lender_icon.svg" alt="Lender Icon">
        <a href="lender_sign_in.php" class="user-button lender">Lender</a>
    </div>
</div>

</body>
</html>