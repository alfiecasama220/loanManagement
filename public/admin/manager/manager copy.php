<?php
// Start session
session_start();

// Include the database connection file from the parent directory
include '../db_connect.php';

// Check if the 'login_type' and 'login_name' session variables are set
$login_type = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : '';
$login_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
      /* Sidebar styles */
#sidebar {
    position: fixed;
    top: 3rem; /* Height of the navigation bar */
    left: 0;
    z-index: 1000;
    height: calc(100% - 3rem); /* Subtracting the height of the navigation bar */
    width: 250px; /* Adjust the width as needed */
    background: black;
    color: #fff;
    padding-top: 1rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column; /* Arrange items vertically */
}

.sidebar-list {
    flex-grow: 1; /* Take remaining space in the sidebar */
    display: flex;
    flex-direction: column; /* Arrange items vertically */
}
.sidebar-list a {
    padding: 0.5rem 1rem; /* Adjust padding as needed */
    color: gray; /* Default font color */
    text-decoration: none;
    transition: background-color 0.3s;
}

.sidebar-list a:first-child {
    color: #fff; /* Change font color of the first link to white */
}





.sidebar-list a:hover {
    background-color: gray; /* Adjust hover background color as needed */
}


.sidebar-list .active {
    background-color: black; /* Adjust active background color as needed */
}



        /* Adjust main content width */
        .main-content {
            width: calc(100% - 250px); /* Subtracting the width of the sidebar */
            max-width: 100%; /* Ensure the content doesn't exceed the screen width */
            margin-left: 250px; /* Same as the width of the sidebar */
            padding: 20px; /* Add some padding to the main content */
            padding-top: 5rem;
             top: 4rem;
        }
    </style>
</head>
<body>
<?php include '../topbar.php'; ?>

<!-- Sidebar -->


<<nav id="sidebar" class='mx-lt-5 bg-dark'>
    <div class="sidebar-list">
        <a href="../index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
        <a href="../index.php?page=loans" class="nav-item nav-loans"><span class='icon-field'><i class="fa fa-file-invoice-dollar"></i></span> Credits</a>
        <a href="../index.php?page=payments" class="nav-item nav-payments"><span class='icon-field'><i class="fa fa-money-bill"></i></span> Payments</a>
        <a href="../index.php?page=borrowers" class="nav-item nav-borrowers"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Borrowers</a>
        <a href="../index.php?page=plan" class="nav-item nav-plan"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Credit Plans</a>
        <a href="../index.php?page=loan_type" class="nav-item nav-loan_type"><span class='icon-field'><i class="fa fa-th-list"></i></span> Credit Types</a>
        <?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 1): ?>
            <a href="../index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php endif; ?>
    </div>
</nav>



<!-- Main Content -->

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-lg-12">
            
            <!-- Your content here -->
        </div>
    </div>    
                <?php include '../home.php'; ?>
                


                          
        </div>
    </div>
</div>

<!-- Bootstrap and FontAwesome Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
