<?php
session_start();

// Check if the user is logged in as a lender
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] != 'lender') {
    header("Location: lender_sign_in.php");
    exit();
}

// Include the database connection
include 'db_connect.php';

// Fetch all pending loan applications
$sql = "SELECT loan_applications.id, loan_applications.name, loan_applications.email, loan_applications.amount, loan_applications.interest_rate, loan_applications.total_amount
        FROM loan_applications
        WHERE loan_applications.status = 'Confirmed'";

$result = $conn->query($sql);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Borrowers - Astra Lending</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1em;
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table thead {
            background-color: #38a37f;
            color: #ffffff;
        }

        table thead th {
            padding: 15px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:hover {
            background-color: #e8f5e9;
        }

        table tbody td {
            padding: 15px;
            text-align: left;
        }

        table tbody td button {
            background-color: #f0ad4e;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            margin: 0 auto;
            display: block;
        }

        table tbody td button:hover {
            background-color: #e0963b;
        }

        /* Responsive Table */
        @media screen and (max-width: 600px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tbody tr {
                margin-bottom: 15px;
            }

            table tbody td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
        /* Header Styling */
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

        /* Section Styling */
        section {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #38a37f;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <a href="lender_dashboard.php" class="hometitle">
        <div class="logo-container">
            <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
            <h1> Astra Lending Co.</h1>
        </div>
    </a>
    <nav>
        <ul>
            <li><a href="lender_dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<h1>Pending Applications</h1>
<!-- Table to display pending borrowers -->
<section>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Loan Amount</th>
                <th>Interest Rate</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td data-label="Name"><?php echo $row['name']; ?></td>
                <td data-label="Email"><?php echo $row['email']; ?></td>
                <td data-label="Loan Amount"><?php echo $row['amount']; ?></td>
                <td data-label="Interest Rate"><?php echo $row['interest_rate']; ?>%</td>
                <td data-label="Total Amount"><?php echo $row['total_amount']; ?></td>
                <td data-label="Action">
                    <!-- Form with Approve button -->
                    <form action="approve_application.php" method="POST">
                        <input type="hidden" name="loan_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Approve</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

</body>
</html>

<?php
$conn->close();
?>