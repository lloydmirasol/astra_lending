<?php
session_start();

// Check if the user is logged in as a borrower
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] != 'borrower') {
    header("Location: borrower_sign_in.php");
    exit();
}

// Include the database connection
include 'db_connect.php';

// Get the borrower's email from session
$borrower_email = $_SESSION['user_email'];

// Fetch borrower's details and loan information from the database
$sql = "SELECT * FROM loan_applications WHERE email='$borrower_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $borrower = $result->fetch_assoc();
} else {
    echo "Error: Borrower details not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower Dashboard - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function toggleUpdateForm() {
            var form = document.getElementById('updateForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

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
    <style>
        body {
                font-family: 'Montserrat', sans-serif;
                margin: 0;
                padding: 0;
                background-color: rgb(243, 243, 243);
        }
        
        h1{
            font-family: 'Montserrat', sans-serif;
            font-weight:bold;
        }
        header {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            color: #38a37f;
            padding: 0.5rem;
            height: 150px;
            text-decoration: none;
            
        }
        
        .logo {
            width: 80px; /* Iadjust kung mediyo malaki */
            height: auto;
            margin-right: 20; /* Space to sa tabi nung title */
            display: inline-flex;
        }
        .logo-container {
            display: flex;
            align-items: center;
            list-style: none;
            
        }
        
        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            
        }
        .hometitle {
            text-decoration: none;
            color: #38a37f;
            font-family: 'Montserrat', sans-serif;
            display: inline-flex;

        }
        
        
        nav ul li a {
            color: rgb(48, 48, 48);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            justify-content: center;
        }
        nav ul li a:hover {
            color: #f0ad4e;
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
        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #38a37f;
            text-align: center;
        }
        button {
            background-color: #f0ad4e;
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
        button:hover {
            background-color: #e0963b;
        }
        #updateForm {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
        }
        form input[type="submit"]:hover {
            background-color: #2e8566;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <a href = "#" class= "hometitle">
        <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
        <h1 style="display: inline; margin-left: 15px;">Astra Lending Co.</h1></a>
    </div>
    <nav>
        <ul>
            <li><a href="logout.php" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a></li>
        </ul>
    </nav>
    <form id="logoutForm" action="logout.php" method="POST" style="display: none;"></form>
</header>

<section>
    <h2>Your Personal Details</h2>
    <p><strong>Full Name:</strong> <?php echo $borrower['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $borrower['email']; ?></p>
    <p><strong>Phone Number:</strong> <?php echo $borrower['phone']; ?></p>
    <p><strong>Address:</strong> <?php echo $borrower['address']; ?></p>
</section>

<section>
    <h2>Your Loan Details</h2>
    <p><strong>Loan Amount:</strong> <?php echo $borrower['amount']; ?> pesos</p>
    <p><strong>Interest Rate:</strong> <?php echo $borrower['interest_rate']; ?>%</p>
    <p><strong>Total Repayment Amount:</strong> <?php echo $borrower['total_amount']; ?> pesos</p>
    <p><strong>Loan Status:</strong> <?php echo $borrower['status']; ?></p>
</section>

<button onclick="toggleUpdateForm()">Update Password</button>

<section id="updateForm" style="display: none;">
    <h2>Update Your Password</h2>
    <form action="update_borrower_details.php" method="POST" onsubmit="return validatePasswordMatch()">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter new password" required><br><br>

        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required><br><br>

        <input type="submit" value="Update Password">
    </form>
</section>

</body>
</html>