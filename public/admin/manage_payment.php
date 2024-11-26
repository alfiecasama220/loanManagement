<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM payments where id=".$_GET['id']);
    foreach($qry->fetch_array() as $k => $val){
        $$k = $val;
    }
}

?>
<div class="container-fluid ">
    <div class="col-lg-12">
        <form id="manage-payment">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="control-label">Borrower ID</label>
                        <select name="borrower_id" id="borrower_id" class="custom-select browser-default select2">
                            <option value=""></option>
                            <?php 
                            $borrowers = $conn->query("SELECT * from borrowers");
                            while($row=$borrowers->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['id'] ? "selected" : '' ?>><?php echo $row['id'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="control-label">Payee</label>
                        <input type="text" class="form-control" id="payee_name" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="control-label">Payment Type</label>
                        <select name="payment_type" id="" class="custom-select browser-default">
                            <option value="daily" <?php echo isset($payment_type) && $payment_type == 'daily' ? "selected" : '' ?>>Daily Payable Amount</option>
                            <option value="manual" <?php echo isset($payment_type) && $payment_type == 'manual' ? "selected" : '' ?>>Manual Amount</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="amount_field" style="<?php echo isset($payment_type) && $payment_type == 'daily' ? 'display:none' : '' ?>">
                        <label for="" class="control-label">Amount</label>
                        <input type="number" class="form-control" name="amount" value="<?php echo isset($amount) ? $amount : '' ?>">
                    </div>
                </div>
            </div>
            <div class="row">
             
        </form>
    </div>
</div>

<script>
  $(document).ready(function(){
    // Load payee information when a borrower is selected
    $('#borrower_id').change(function(){
        var borrower_id = $(this).val();
        if(borrower_id){
            $.ajax({
                url:'get_payee_info.php',
                method:"POST",
                data:{borrower_id:borrower_id},
                dataType:"json",
                success:function(data){
                    $('#payee_name').val(data.name);
                    $('#payable_amount').text(data.payable_amount);
                    $('#daily_payable_amount').text(data.daily_payable_amount);
                    // Update payment type based on the borrower's details
                    $('[name="payment_type"]').val(data.payment_type);
                    // Update amount field based on the borrower's details
                    $('[name="amount"]').val(data.amount);
                    // Hide or show amount field based on payment type
                    if (data.payment_type == 'daily') {
                        $('#amount_field').hide();
                    } else {
                        $('#amount_field').show();
                    }
                }
            });
        }
    });
});
