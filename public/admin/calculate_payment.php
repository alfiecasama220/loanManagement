<?php
// Check if all required variables are set
if(isset($_POST['amount'], $_POST['interest'], $_POST['months'], $_POST['penalty'])) {
    // Extract form data
    extract($_POST);

    // Ensure all variables are properly initialized
    if(isset($amount) && isset($interest) && isset($months) && isset($penalty)) {
        // Convert interest rate to daily
        $daily_interest = ($interest / 100) / 30; // Assuming 30 days in a month

        // Perform the calculation
        $daily_payment = ($amount + ($amount * $daily_interest)) / ($months * 30);
        $penalty_amount = $daily_payment * ($penalty / 100);

        // Output the result
        echo '
        <table width="100%">
            <tr>
                <th class="text-center" width="33.33%">Total Payable Amount</th>
                <th class="text-center" width="33.33%">Daily Payable Amount</th>
                <th class="text-center" width="33.33%">Penalty Amount</th>
            </tr>
            <tr>
                <td class="text-center"><small>' . number_format($daily_payment * ($months * 30), 2) . '</small></td>
                <td class="text-center"><small>' . number_format($daily_payment, 2) . '</small></td>
                <td class="text-center"><small>' . number_format($penalty_amount, 2) . '</small></td>
            </tr>
        </table>';
    }
}
?>
