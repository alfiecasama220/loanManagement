<?php include 'db_connect.php' ?>

<style>
    /* Remove default margin and padding from paragraphs */
    td p {
        margin: 0;
        padding: 0;
        text-align: justify; /* Justify text within paragraphs */
    }
    
    /* Set image dimensions */
    td img {
        width: 8vw;
        height: 12vh;
    }
    
    /* Set vertical alignment for table cells */
    td {
        vertical-align: middle !important;
        
        text-align: justify; 
    }

    /* Center align text within table cells */
    td p {
        text-align: left;
    }
</style>    

<div class="container-fluid" style="max-height: auto;">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <large class="card-title">
                    <b>Credit List</b>
                    <button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_application"><i class="fa fa-plus"></i> Create New Application</button>
                </large>
                
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="loan-list">
                    <colgroup>
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Borrower</th>
                            <th class="text-center">Credit Details</th>
                            <th class="text-center"> Payment Details</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
						
                        <?php
                            $i=1;
                            $type_arr = array();
                            $type = $conn->query("SELECT * FROM loan_types where id in (SELECT loan_type_id from loan_list) ");
                            while($row=$type->fetch_assoc()){
                                $type_arr[$row['id']] = $row['type_name'];
                            }
                            $plan_arr = array();
                            $plan = $conn->query("SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan FROM loan_plan where id in (SELECT plan_id from loan_list) ");
                            while($row=$plan->fetch_assoc()){
                                $plan_arr[$row['id']] = $row;
                            }
                            $qry = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id  order by id asc");
                            while($row = $qry->fetch_assoc()):
                                if(isset($plan_arr[$row['plan_id']])) {
									// Calculate the daily payment amount based on the loan plan
                                    $interest = $row['amount'] * ($plan_arr[$row['plan_id']]['interest_percentage']/100);
									$daily = ($row['amount'] + $interest) / ($plan_arr[$row['plan_id']]['months'] * 30);
									$penalty = $daily * ($plan_arr[$row['plan_id']]['penalty_rate']/100);
								} else {
									// Handle the case when $row['plan_id'] doesn't exist in $plan_arr
									$daily = 0;
									$penalty = 0;
								}
								
								$payments = $conn->query("SELECT * from payments where loan_id =".$row['id']);
								$paid = $payments->num_rows;
								$offset = $paid > 0 ? " offset $paid ": "";
								if($row['status'] == 2):
									$next_due_result = $conn->query("SELECT * FROM loan_schedules where loan_id = '".$row['id']."'  order by date(date_due) asc limit 1 $offset ");
									if ($next_due_result && $next_due_result->num_rows > 0) {
										$next_due_row = $next_due_result->fetch_assoc();
										$next = $next_due_row['date_due'];
									} else {
										$next = null;
									}
								endif;
								$sum_paid = 0;
								while($p = $payments->fetch_assoc()){
									$sum_paid += ($p['amount'] - $p['penalty_amount']);
								}
                         ?>
                         <tr>
                            
                         <td class="text-justify"><?php echo $i++ ?></td>

                            <td>
                                <p>Name :<b><?php echo $row['name'] ?></b></p>
                                <p><small>Contact # :<b><?php echo $row['contact_no'] ?></small></b></p>
                                <p><small>Address :<b><?php echo $row['address'] ?></small></b></p>
                            </td>
                            
                            <td>
                                <p>Reference :<b><?php echo $row['ref_no'] ?></b></p>
                                <p><small>Credit type :<b><?php echo isset($type_arr[$row['loan_type_id']]) ? $type_arr[$row['loan_type_id']] : '' ?></small></b></p>
                                <p><small>Plan :<b><?php echo isset($plan_arr[$row['plan_id']]) ? $plan_arr[$row['plan_id']]['plan'] : '' ?></small></b></p>
                                <p><small>Amount :<b><?php echo $row['amount'] ?></small></b></p>
								
                                <?php
$total_payable_amount = 0;
if(isset($plan_arr[$row['plan_id']])) {
    $total_payable_amount = $daily * ($plan_arr[$row['plan_id']]['months'] * 30);
}
?>

								<p><small>Total Payable Amount :<b><?php echo number_format($total_payable_amount, 2) ?></small></b></p>
                                <p><small>Daily Payable Amount: <b><?php echo number_format($daily,2) ?></small></b></p>
                                <p><small>Overdue Payable Amount: <b><?php echo number_format($penalty,2) ?></small></b></p>
                                <?php if($row['status'] == 2 || $row['status'] == 3): ?>
                                <p><small>Date Released: <b><?php echo date("M d, Y",strtotime($row['date_released'])) ?></small></b></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Add a link to download statement of account -->
                                <p><a href="generate_statement_of_account.php?id=<?php echo $row['id'] ?>" target="_blank" class="btn btn-info btn-sm">Download Statement of Account</a></p>
                                <!-- Include payment calendar or other payment details here -->
                            </td>
                            <td>
 
    <?php if($row['status'] == 2 ): ?>
        <p>Date: <b><?php echo date('M d, Y',strtotime($next)); ?></b></p>
        <p><small>Daily amount:<b><?php echo number_format($daily,2) ?></b></small></p>
        <p><small>Penalty :<b><?php echo $add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0; ?></b></small></p>
        <p><small>Payable Amount :<b><?php echo number_format($daily + $add,2) ?></b></small></p>
    <?php endif; ?>
</td>


                            <td class="text-justify">
                                <?php if($row['status'] == 0): ?>
                                    <span class="badge badge-warning">For Approval</span>
                                <?php elseif($row['status'] == 1): ?>
                                    <span class="badge badge-info">Approved</span>
                                <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-primary">Released</span>
                                <?php elseif($row['status'] == 3): ?>
                                    <span class="badge badge-success">Completed</span>
                                <?php elseif($row['status'] == 4): ?>
                                    <span class="badge badge-danger">Denied</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                    <button class="btn btn-outline-primary btn-sm edit_loan" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger btn-sm delete_loan" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
                            </td>

                         </tr>

                        <?php endwhile; ?>
                         
                        <?php
                        
                            $i=1;
                            // Fetch loan records from database
                            $qry = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id  order by id asc");
                            while($row = $qry->fetch_assoc()):
                         ?>
                        
                          
                         </tr>
                        <?php endwhile; ?>
                       
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Function to open modal for new credit application
        $('#new_application').click(function(){
            // Call the uni_modal function to open a modal for creating a new credit application
            uni_modal("New Credit Application", "manage_loan.php", 'mid-large');
        });

        // Add click event listeners for edit and delete buttons
        $('.edit_loan').click(function(){
            // Call the uni_modal function to open a modal for editing a loan
            uni_modal("Edit Loan","manage_loan.php?id="+$(this).attr('data-id'),'mid-large');
        });

        $('.delete_loan').click(function(){
            // Confirm deletion before calling delete_loan function
            _conf("Are you sure to delete this data?","delete_loan",[$(this).attr('data-id')]);
        });

        // Function to delete a loan
        function delete_loan($id){
            start_load();
            $.ajax({
                url:'ajax.php?action=delete_loan',
                method:'POST',
                data:{id:$id},
                success:function(resp){
                    if(resp==1){
                        alert_toast("Loan successfully deleted",'success');
                        setTimeout(function(){
                            location.reload();
                        },1500);
                    }
                }
            });
        }
    });
</script>

