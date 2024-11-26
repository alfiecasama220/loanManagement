<?php
// Start session
session_start();

// Include the database connection file from the parent directory
include '../db_connect.php';

// Check if user is logged in and is a cashier
if (!isset($_SESSION['login_id']) || $_SESSION['login_type'] !== 'cashier') {
    header("Location: ../login.php");
    exit();
}

// Fetch the cashier's name from the database based on the username
$login_name = '';
if (isset($_SESSION['login_username'])) {
    $username = $_SESSION['login_username'];
    $user_query = "SELECT name FROM users WHERE username = '$username'";
    $user_result = $conn->query($user_query);
    if ($user_result && $user_result->num_rows > 0) {
        $row = $user_result->fetch_assoc();
        $login_name = $row['name'];
    }
}

// Check if the 'login_type' and 'login_name' session variables are set
$login_type = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : '';
$login_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom styles for the navigation bar */
        .navbar {
            background-color: green; /* Set the background color to green */
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Assets Credit and Loans, Inc.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 float-right text-white">
                <?php if (!empty($login_name)) : ?>
                    <!-- Redirect to the logout action -->
                    <a href="../login.php" class="text-white"><?php echo $login_name; ?> <i class="fa fa-power-off"></i></a>
                <?php else : ?>
                    <!-- Redirect to the login form -->
                    <a href="../login.php" class="text-white">Login <i class="fa fa-power-off"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <!-- Main content -->
    <div>
        <h1>Welcome, <?php echo $_SESSION['login_name']; ?>!</h1>
        <p>This is the cashier dashboard.</p>

        <!-- Borrower Details -->
        <h2>Borrower Details</h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
            <?php
            // Fetch borrower details from the database
            $borrower_query = "SELECT * FROM borrowers";
            $borrower_result = $conn->query($borrower_query);

            // Display borrower details
            if ($borrower_result->num_rows > 0) {
                while ($row = $borrower_result->fetch_assoc()) {
                    // Check if keys exist before accessing them
                    $firstname = isset($row['firstname']) ? $row['firstname'] : 'N/A';
                    $lastname = isset($row['lastname']) ? $row['lastname'] : 'N/A';
                    $contact_no = isset($row['contact_no']) ? $row['contact_no'] : 'N/A';

                    echo "<tr>";
                    echo "<td>" . $firstname . " " . $lastname . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $contact_no . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No borrowers found</td></tr>";
            }
            ?>
        </table>

        <!-- Borrower Schedules -->
        <?php
        // Fetch borrower names and their due schedules from the database
        $query = "SELECT b.firstname, b.lastname, ls.date_due
                  FROM borrowers b
                  INNER JOIN loan_schedules ls ON b.id = ls.loan_id"; // Adjust the join condition here
        $result = $conn->query($query);

        // Display borrower names and due schedules
        echo "<h2>Borrower Schedules</h2>";
        echo "<ul>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check if the keys exist before accessing them
                $firstname = isset($row['firstname']) ? $row['firstname'] : 'N/A';
                $lastname = isset($row['lastname']) ? $row['lastname'] : 'N/A';
                $due_date = isset($row['date_due']) ? $row['date_due'] : 'N/A';

                echo "<li>Borrower: " . $firstname . " " . $lastname . ", Due on " . $due_date . "</li>";
            }
        } else {
            echo "<li>No schedules found</li>";
        }

        echo "</ul>";
        ?>


        <!-- Payments to be Paid -->
        <h2>Payments to be Paid</h2>
        <ul>
            <?php
            // Fetch payments from the database
            $payment_query = "SELECT * FROM payments";
            $payment_result = $conn->query($payment_query);

            // Display payments
            if ($payment_result->num_rows > 0) {
                while ($row = $payment_result->fetch_assoc()) {
                    // Check if the key exists before accessing it
                    $due_date = isset($row['date_due']) ? $row['date_due'] : 'N/A';
                    echo "<li>Payment: $" . $row['amount'] . " - Due on " . $due_date . "</li>";
                }
            } else {
                echo "<li>No payments found</li>";
            }
            ?>
        </ul>


        <!-- Accept or Decline Payments -->
        <h2>Accept or Decline Payments</h2>
        <form method="post" action="">
            <label for="payment_amount">Payment Amount:</label>
            <input type="number" id="payment_amount" name="payment_amount" required>
            <button type="submit" name="accept_payment">Accept Payment</button>
            <button type="submit" name="decline_payment">Decline Payment</button>
        </form>
        <?php
        // Process submitted payment
        if (isset($_POST['accept_payment'])) {
            // Process accepted payment
            echo "Payment Accepted!";
        }
        if (isset($_POST['decline_payment'])) {
            // Process declined payment
            echo "Payment Declined!";
        }
        ?>
    </div>

    <!-- Include any JavaScript files or scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>
