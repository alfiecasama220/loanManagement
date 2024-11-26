<?php
// Check if all required variables are set and not empty
if(isset($_POST['amount'], $_POST['months'], $_POST['interest'], $_POST['penalty']) && !empty($_POST['amount']) && !empty($_POST['months']) && !empty($_POST['interest']) && !empty($_POST['penalty'])) {
    // Extract form data and sanitize
    $amount = floatval($_POST['amount']);
    $months = intval($_POST['months']);
    $interest = floatval($_POST['interest']);
    $penalty = floatval($_POST['penalty']);

    // Ensure all variables are numeric and valid
    if(is_numeric($amount) && is_numeric($months) && is_numeric($interest) && is_numeric($penalty)) {
        // Convert interest rate to daily
        $daily_interest = ($interest / 100) / 30; // Assuming 30 days in a month

        // Perform the calculation
        $daily_payment = ($amount + ($amount * $daily_interest)) / ($months * 30);
        $penalty_amount = $daily_payment * ($penalty / 100);
        $total_payable_amount = $daily_payment * ($months * 30);

        // Output the results
        echo '
        <table width="100%">
            <tr>
                <th class="text-center" width="33.33%">Total Payable Amount</th>
                <th class="text-center" width="33.33%">Daily Payable Amount</th>
                <th class="text-center" width="33.33%">Penalty Amount</th>
            </tr>
            <tr>
                <td class="text-center"><small>'.number_format($total_payable_amount, 2).'</small></td>
                <td class="text-center"><small>'.number_format($daily_payment, 2).'</small></td>
                <td class="text-center"><small>'.number_format($penalty_amount, 2).'</small></td>
            </tr>
        </table>';
    } else {
        echo "Invalid input. Please enter numeric values for amount, months, interest, and penalty.";
    }
} else {
    echo "Please fill in all required fields.";
}
?>
