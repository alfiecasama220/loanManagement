<?php include 'db_connect.php' ?>
<?php 
extract($_POST);

// Check if $loan_id is set and not empty
if(isset($loan_id) && !empty($loan_id)){
    // Fetch payment details based on the provided loan_id
    $payments_query = "SELECT * FROM payments WHERE loan_id =".$loan_id;
    $payments = $conn->query($payments_query);

    // Check if the query executed successfully
    if (!$payments) {
        // Print error message if query fails
        printf("Error: %s\n", $conn->error);
        exit();
    }
    
    // Fetch other necessary data related to the loan
    $loan_query = "SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename) as name, b.contact_no, b.address 
                    FROM loan_list l 
                    INNER JOIN borrowers b ON b.id = l.borrower_id 
                    WHERE l.id = ".$loan_id;
    $loan_result = $conn->query($loan_query);
    $loan = $loan_result->fetch_array();

    // Fetch loan type details
    $loan_type_query = "SELECT * FROM loan_types WHERE id = '".$loan['loan_type_id']."'";
    $loan_type = $conn->query($loan_type_query)->fetch_array();

    // Fetch loan plan details
    $loan_plan_query = "SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan 
                        FROM loan_plan 
                        WHERE id = '".$loan['plan_id']."'";
    $loan_plan = $conn->query($loan_plan_query)->fetch_array();

    // Calculate monthly amount and penalty
    $monthly = ($loan['amount'] + ($loan['amount'] * ($loan_plan['interest_percentage']/100))) / $loan_plan['months'];
    $penalty = $monthly * ($loan_plan['penalty_rate']/100);

    // Fetch payment details
    $paid = $payments->num_rows;
    $offset = $paid > 0 ? " OFFSET $paid " : "";
    $next_query = "SELECT * FROM loan_schedules WHERE loan_id = '".$loan_id."' ORDER BY DATE(date_due) ASC LIMIT 1 $offset";
    $next_due = $conn->query($next_query)->fetch_assoc()['date_due'];
    $add = (date('Ymd',strtotime($next_due)) < date("Ymd")) ? $penalty : 0;
    $sum_paid = 0;
    while($p = $payments->fetch_assoc()){
        $sum_paid += ($p['amount'] - $p['penalty_amount']);
    }
}
?>
<div class="col-lg-12">
<hr>
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label for="">Payee</label>
            <input name="payee" class="form-control" required="" value="<?php echo isset($payee) ? $payee : (isset($loan['name']) ? $loan['name'] : '') ?>">
        </div>
    </div>
    
</div>
<hr>
<div class="row">
    <div class="col-md-5">
        <p><small>Monthly amount:<b><?php echo isset($monthly) ? number_format($monthly,2) : '' ?></b></small></p>
        <p><small>Penalty :<b><?php echo isset($add) ? $add : '' ?></b></small></p>
        <p><small>Payable Amount :<b><?php echo isset($monthly) && isset($add) ? number_format($monthly + $add,2) : '' ?></b></small></p>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="">Amount</label>
            <input type="number" name="amount" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($amount) ? $amount : '' ?>">
            <input type="hidden" name="penalty_amount" value="<?php echo isset($add) ? $add : '' ?>">
            <input type="hidden" name="loan_id" value="<?php echo isset($loan_id) ? $loan_id : '' ?>">
            <input type="hidden" name="overdue" value="<?php echo isset($add) && $add > 0 ? 1 : 0 ?>">
        </div>
    </div>
</div>
</div>
