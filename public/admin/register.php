<?php
// Include the file containing the database connection
require_once("db_connect.php");

// Initialize error message
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validate password
    if (strlen($password) < 6 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        $error = "Password must be at least 6 characters long and contain both letters and numbers.";
    } elseif ($password != $confirm_password) {
        $error = "Password and Confirm Password do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement to insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $error = "Error preparing SQL statement: " . $conn->error;
        } else {
            $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $role);
            if (!$stmt->execute()) {
                $error = "Error executing SQL statement: " . $stmt->error;
            } else {
                // Registration successful, redirect to login page
                header("Location: login.php");
                exit();
            }
        }
    }
}

// Close the database connection when done
if (isset($conn)) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Preserve original styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Ensure container handles floating children */
        }

        h2 {
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        input[type="submit"] {
            width: calc(100% - 20px); /* Account for padding */
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- Preserve original structure and design -->
    <div class="container">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="cashier">Cashier</option>
                    <option value="collector">Collector</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Register">
            </div>
        </form>
        <?php if (!empty($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <!-- Added link to login page -->
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>
