<?php
require_once("db_connect.php");

// Initialize error message
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful and if it returned any rows
    if ($result && $result->num_rows == 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, continue with the login process

            // Set session variables
            session_start();
            $_SESSION['login_id'] = $user['id']; // Assuming 'id' is the primary key of the users table
            $_SESSION['login_name'] = $user['username']; // Set the login_name session variable
            $_SESSION['login_type'] = $user['role']; // Set the login_type session variable to the user's role

            // Redirect user based on their role
            switch ($user['role']) {
                case 'admin':
                    header("Location: index.php");
                    exit();
                case 'manager':
                    header("Location: index.php");
                    exit();
                case 'cashier':
                    header("Location: cashier/cashier.php"); 
                    exit();
                case 'collector':
                    header("Location: collector.php");
                    exit();
                case 'client':
                    header("Location: client.php");
                    exit();
                default:
                    // Handle unknown roles or any other cases
                    $error = "Unknown role";
                    break;
            }
        } else {
            // Password is incorrect
            $error = "Incorrect password";
        }
    } else {
        // User not found or query unsuccessful
        $error = "User not found";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin | Loan Management System</title>
    <?php include('./header.php'); ?>
</head>

<style>
    .card {
    width: 100%; /* Adjust the width of the card */
    margin: 0 auto; /* Center the card horizontally */
    padding: 40px; /* Add padding to the card */
}

.card-body {
    padding: 30px; /* Add padding to the card body */
}

    body {
        width: 100%;
        height: calc(100%);
    }
    

    main#main {
        width: 100%;
        height: calc(100%);
        background: white;
    }

    #login-right {
        position: absolute;
        right: 0;
        width: 40%;
        height: calc(100%);
        background: white;
        display: flex;
        align-items: center;
    }

    #login-left {
        position: absolute;
        left: 0;
        width: 60%;
        height: calc(100%);
        background: #59b6ec61;
        display: flex;
        align-items: center;
        background: url(assets/img/bg.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }

    #login-right .card {
        margin: auto;
        z-index: 1
    }
    .logo {
    margin: auto;
    font-size: 8rem;
    background: none;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    
    color: #000000b3;
    z-index: 10;
    
}
.login-form {
    width: 100%; /* Adjust the width as needed */
    margin: 0 auto; /* Center the card horizontally */
}



.logo img {
    position: absolute; /* Position the image absolutely */
    top: 18%; /* Align to the top */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Adjust for centering */
    width: 120px; /* Set the width of the image */
    height: auto; /* Maintain aspect ratio */
}



    div#login-right::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: calc(100%);
        height: calc(100%);
        background: #000000e0;
    }
    .control-label {
    font-size: 18px; /* Increase font size for labels */
}

.btn-primary {
    /* Increase padding for button */
    font-size: 18px; /* Increase font size for button */
}
</style>

<body>
    <main id="main" class=" bg-dark">
        <div id="login-left"></div>
        <div id="login-right">
            <div class="card col-md-8">
                <div class="card-body">
                <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
</div>
                    <form id="login-form" method="POST" action="">
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <center><button type="submit" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                        <center><a href="register.php">Register Here</a></center> <!-- Added registration link -->
                    </form>
                    <div><?php echo $error; ?></div> <!-- Display error message -->
                </div>
            </div>
        </div>
    </main>
</body>

</html>
