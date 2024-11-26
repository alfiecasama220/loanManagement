<?php
include 'db_connect.php';

if(isset($_POST['borrower_id'])){
    $borrower_id = $_POST['borrower_id'];
    $response = array();

    // Include manage_loan.php to access its functions and variables
    include 'manage_loan.php';

    // Call functions or access variables from manage_loan.php to calculate payable amount and daily payable amount
    $payable_amount = calculate_payable_amount($borrower_id);
    $daily_payable_amount = calculate_daily_payable_amount($borrower_id);

    // Fetch borrower details from the database
    $query = $conn->query("SELECT * FROM borrowers WHERE id = $borrower_id");
    $row = $query->fetch_assoc();

    // Prepare response data
    $response['name'] = $row['firstname'] . ' ' . $row['lastname'];
    $response['payable_amount'] = $payable_amount;
    $response['daily_payable_amount'] = $daily_payable_amount;
    $response['payment_type'] = $row['payment_type']; // Assuming payment_type is stored in the borrowers table
    $response['amount'] = $row['amount']; // Assuming amount is stored in the borrowers table

    // Return JSON response
    echo json_encode($response);
}
?>
