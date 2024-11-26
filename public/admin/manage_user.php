<?php 
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'save_user') {
    // Check if the required fields are provided
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Update the user data in the database
        $update_query = "UPDATE users SET name='$name', username='$username', password='$password' WHERE id=$id";
        if ($conn->query($update_query) === TRUE) {
            echo 1; // Success
        } else {
            echo 0; // Error
        }
    } else {
        echo 0; // Error: Required fields are missing
    }
    exit; // Exit after processing the request
}

// Fetch user data if the user ID is provided in the URL
if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $user = $conn->query("SELECT * FROM users where id = $user_id");
    if($user->num_rows > 0) {
        $meta = $user->fetch_assoc();
    } else {
        echo "User not found!";
        exit; // Exit if user ID is not found
    }
}
?>
<div class="container-fluid">
    <form action="ajax.php?action=save_user" method="POST" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<script>

$('#manage-user').submit(function(e){
    e.preventDefault();
    start_load();
    console.log("Form Data:", $(this).serialize()); // Log the form data being sent
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp){
            console.log("Response:", resp); // Log the response from the server
            if(resp == 1){
                alert_toast("Data successfully saved", 'success');
                setTimeout(function(){
                    location.reload();
                }, 1500);
            } else {
                alert_toast("Failed to save data. Please try again later.", 'error'); // Provide a more generic error message
                end_load();
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); // Log the detailed error message in the browser console
            alert_toast("An error occurred while processing your request. Please try again later.", 'error'); // Provide a more generic error message
            end_load();
        }
    });
});
// Log received action parameter
error_log("Action: " . $action);

// Log response data
if ($save) {
    error_log("Data saved successfully");
    echo 1; // Return success response
} else {
    error_log("Failed to save data");
    echo 0; // Return error response
}
success: function(resp){
    console.log("Response:", resp); // Log the response from the server
    if(resp == 1){
        // Handle successful response
    } else {
        // Handle error response
    }
},

</script>
