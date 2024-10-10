<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Loan - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function calculateInterest() {
            var amount = document.getElementById('loanAmount').value;
            var interestRate = 0;
            var totalAmount = 0;

            if (amount >= 10000) {
                interestRate = 12; // 12% for 10,000 pesos and above
            } else if (amount < 10000) {
                interestRate = 15; // 15% for below 10,000 pesos
            }

            totalAmount = parseFloat(amount * (interestRate / 100));
            document.getElementById('interestRate').value = interestRate + '%';
            document.getElementById('totalAmount').value = totalAmount.toFixed(2);
        }

        function showLoanDetails() {
            // Ensure all personal details are filled out before proceeding
            if (document.getElementById('name').value === '' ||
                document.getElementById('email').value === '' ||
                document.getElementById('password').value === '' ||
                document.getElementById('phone').value === '' ||
                document.getElementById('address').value === '') {
                alert('Please fill out all personal details before proceeding.');
                return;
            }

            // Get values from personal details form
            document.getElementById('hiddenName').value = document.getElementById('name').value;
            document.getElementById('hiddenEmail').value = document.getElementById('email').value;
            document.getElementById('hiddenPassword').value = document.getElementById('password').value;
            document.getElementById('hiddenPhone').value = document.getElementById('phone').value;
            document.getElementById('hiddenAddress').value = document.getElementById('address').value;

            // Hide personal details form and show loan details form
            document.getElementById('personalDetailsForm').style.display = 'none';
            document.getElementById('loanDetailsForm').style.display = 'block';
        }
    </script>
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
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            color: #38a37f;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #f0ad4e;
        }
        .form-section {
            background-color: #ffffff;
            padding: 30px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-section h2 {
            color: #38a37f;
            margin-bottom: 20px;
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        form input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"], .proceed-button {
            background-color: #38a37f;
            color: #ffffff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            display: block;
            margin: 20px auto;
        }
        form input[type="submit"]:hover, .proceed-button:hover {
            background-color: #2e8566;
        }
        #loanDetailsForm {
            display: none;
        }
        /* Styling to make loan details section look less like a form */
        #loanDetailsForm .loan-info {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<header>
    <a href="index.html" class="hometitle">
        <div class="logo-container">
            <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
            <h1> Astra <br> Lending Co.</h1>
        </div>
    </a>
    <nav>   
        <ul>
            <div class="navbutton">
                <li><a href="index.html">Home</a></li>
            </div>
            <div class="buttons">
                <a href="user_selection.php" class="signinbutton">Sign In</a>
                <a href="/astra_lending/apply_loan.php" class="applybutton">Apply for Loan</a>
            </div>
        </ul>
    </nav>
</header>

<h1 class="applytitle">Apply For Loan</h1>

<!-- Personal Details Form -->
<section id="personalDetailsForm" class="form-section">
    <h2>Personal Details</h2>
    <form>
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Create Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <button type="button" class="proceed-button" onclick="showLoanDetails()">Proceed to Loan Details</button>
    </form>
</section>

<!-- Loan Details Form -->
<section id="loanDetailsForm" class="form-section">
    <h2>Loan Details</h2>
    <div class="loan-info">
        <form action="apply_loan_handler.php" method="POST" enctype="multipart/form-data">
            <!-- Hidden Fields to Carry Over Personal Details -->
            <input type="hidden" name="name" id="hiddenName">
            <input type="hidden" name="email" id="hiddenEmail">
            <input type="hidden" name="password" id="hiddenPassword">
            <input type="hidden" name="phone" id="hiddenPhone">
            <input type="hidden" name="address" id="hiddenAddress">

            <label for="amount">Loan Amount (in pesos):</label>
            <input type="number" id="loanAmount" name="amount" required oninput="calculateInterest()">

            <div class="loan-info">
                <p><strong>Interest Rate:</strong> <span id="interestRateDisplay"></span></p>
                <input type="hidden" id="interestRate" name="interestRate" readonly>

                <p><strong>Total Repayment Amount:</strong> <span id="totalAmountDisplay"></span></p>
                <input type="hidden" id="totalAmount" name="totalAmount" readonly>
            </div>

            <label for="valid_id">Upload Valid ID (e.g., Passport, Driver's License):</label>
            <input type="file" name="valid_id" accept=".jpg,.jpeg,.png,.pdf" required>

            <input type="submit" value="Submit Application">
        </form>
    </div>
</section>

<script>
    // Update the display values for interest rate and total amount
    document.getElementById('loanAmount').addEventListener('input', function () {
        calculateInterest();
        document.getElementById('interestRateDisplay').innerText = document.getElementById('interestRate').value;
        document.getElementById('totalAmountDisplay').innerText = document.getElementById('totalAmount').value;
    });
</script>

</body>
</html>