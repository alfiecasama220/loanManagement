<?php
ob_start();

include('db_connect.php');
include 'admin_class.php'; // Include the file before using $crud object

$action = isset($_GET['action']) ? $_GET['action'] : '';
$crud = new Action(); // Instantiate the $crud object after including the class file

if($action == 'save_user'){
    $save = $crud->save_user();
    if($save) {
        echo 1; // Echoing '1' as the response to indicate successful data saving
    } else {
        echo 0; // Echoing '0' or any other value to indicate failure
    }
}

if($action == 'login'){
    $login = $crud->login();
    if($login)
        echo $login;
}
// Other action handling code goes here

if($action == 'login2'){
    $login = $crud->login2();
    if($login)
        echo $login;
}
if($action == 'logout'){
    $logout = $crud->logout();
    if($logout)
        echo $logout;
}
if($action == 'logout2'){
    $logout = $crud->logout2();
    if($logout)
        echo $logout;
}
if ($action == 'save_user') {
    $save = $crud->save_user();
    if ($save) {
        echo 1; // Return success response
    } else {
        echo 0; // Return error response
    }

}
if($action == 'delete_user'){
    $id = $_POST['id']; // Get the user ID from the POST request
    $delete = $crud->delete_user($id);
    if($delete)
        echo $delete;
}
if($action == 'edit_user'){
    $id = $_POST['id'];
    $edit = $crud->edit_user($id);
    if($edit)
        echo $edit;
}
if($action == "signup"){
    $save = $crud->signup();
    if($save)
        echo $save;
}
if($action == "save_settings"){
    $save = $crud->save_settings();
    if($save)
        echo $save;
}
if($action == "save_loan_type"){
    $save = $crud->save_loan_type();
    if($save)
        echo $save;
}
if($action == "delete_loan_type"){
    $save = $crud->delete_loan_type();
    if($save)
        echo $save;
}
if($action == "save_plan"){
    $save = $crud->save_plan();
    if($save)
        echo $save;
}
if($action == "delete_plan"){
    $save = $crud->delete_plan();
    if($save)
        echo $save;
}
if($action == "save_borrower"){
    $save = $crud->save_borrower();
    if($save)
        echo $save;
}
if($action == "delete_borrower"){
    $save = $crud->delete_borrower();
    if($save)
        echo $save;
}
if ($action == "save_loan") {
    $save = $crud->save_loan();
    if ($save) {
        // If save operation is successful, echo 1
        echo 1;
    } else {
        // If save operation fails or encounters an error, echo 0 and provide an error message
        echo 'Error: Unable to save loan data.';
    }
}

if($action == "delete_loan"){
    $save = $crud->delete_loan();
    if($save)
        echo $save;
}
if($action == "save_payment"){
    $save = $crud->save_payment();
    if($save)
        echo $save;
}
if($action == "delete_payment"){
    $save = $crud->delete_payment();
    if($save)
        echo $save;
}
?>
