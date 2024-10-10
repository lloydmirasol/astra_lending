<?php
session_start();

// Check if the user is logged in as a lender
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] != 'lender') {
    header("Location: lender_sign_in.php");
    exit();
}

// Include the database connection
include 'db_connect.php';

// Fetch all approved loan applications
$sql = "SELECT loan_applications.id, loan_applications.name, loan_applications.email, loan_applications.phone, loan_applications.amount, loan_applications.interest_rate, loan_applications.total_amount
        FROM loan_applications
        WHERE loan_applications.status = 'Approved'";

$result = $conn->query($sql);

$sql_pending_count = "SELECT COUNT(*) as pending_count FROM loan_applications WHERE status = 'Confirmed'";
$result_pending_count = $conn->query($sql_pending_count);
$pending_applications_count = 0;
if ($result_pending_count->num_rows > 0) {
    $row_pending_count = $result_pending_count->fetch_assoc();
    $pending_applications_count = $row_pending_count['pending_count'];
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Loans - Astra Lending Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        table thead th {
            padding: 12px 15px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        table tbody td {
            padding: 12px 15px;
            text-align: left;
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
        /* Styling for the notification count */

        #notification-count {
        background-color: #f0ad4e; /* Orange color */
        color: white;
        padding: 5px 10px;
        border-radius: 50%;
        font-weight: bold;
        }

        /* Edit Button Styling */
        .edit-button {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #e0963b;
        }

        /* Pop-up Styling */
        #editPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            z-index: 1000;
        }

        #editPopup h2 {
            color: #38a37f;
            text-align: center;
        }

        #editPopup form label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        #editPopup form input[type="text"],
        #editPopup form input[type="email"],
        #editPopup form input[type="tel"],
        #editPopup form input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #editPopup form input[type="submit"] {
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

        #editPopup form input[type="submit"]:hover {
            background-color: #2e8566;
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
<a href="#" class="hometitle"><div class="logo-container">
            <img src="images/astra_logo.svg" alt="Astra Lending Logo" class="logo">
        <h1> Astra Lending Co.</h1>
    </div></a>
    <nav>
    <ul>
        <li><a href="pending_applications.php">Pending Applications <span id="notification-count"><?php echo $pending_applications_count; ?></span></a></li>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a></li>
    </ul>
    </nav>
    <form id="logoutForm" action="logout.php" method="POST" style="display: none;"></form>
</header>

<!-- Table to display approved loans -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Loan Amount</th>
            <th>Interest Rate</th>
            <th>Total Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td data-label="Name"><?php echo $row['name']; ?></td>
            <td data-label="Email"><?php echo $row['email']; ?></td>
            <td data-label="Phone Number"><?php echo $row['phone']; ?></td>
            <td data-label="Loan Amount">₱<?php echo $row['amount']; ?></td>
            <td data-label="Interest Rate"><?php echo $row['interest_rate']; ?>%</td>
            <td data-label="Total Amount">₱<?php echo $row['total_amount']; ?></td>
            <td data-label="Actions">
                <button class="edit-button" onclick="openEditPopup('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['amount']; ?>')">Edit</button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div id="blurBackground"></div>
<div id="editPopup">
    <h2>Edit Borrower Details</h2>
    <form action="edit_borrower_handler.php" method="POST">
        <input type="hidden" id="editId" name="id">

        <label for="editName">Full Name:</label>
        <input type="text" id="editName" name="name" required>

        <label for="editEmail">Email:</label>
        <input type="email" id="editEmail" name="email" required>

        <label for="editPhone">Phone Number:</label>
        <input type="tel" id="editPhone" name="phone" required>

        <label for="editAmount">Loan Amount:</label>
        <input type="number" id="editAmount" name="amount" required>

        <input type="submit" value="Save Changes">
    </form>
    <button type="button" onclick="closeEditPopup()">Cancel</button>
</div>

<script>
    function openEditPopup(id, name, email, phone, amount) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhone').value = phone;
        document.getElementById('editAmount').value = amount;
        document.getElementById('editPopup').style.display = 'block';
        document.getElementById('blurBackground').style.display = 'block';
    }

    function closeEditPopup() {
        document.getElementById('editPopup').style.display = 'none';
        document.getElementById('blurBackground').style.display = 'none';
    }
</script>

</body>
</html>

<?php
$conn->close();
?>