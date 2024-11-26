<?php include 'db_connect.php' ?>
<?php include 'topbar.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<div class="container-fluid bg-success text-dark" style="height: auto; padding-top: 60px;">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-striped table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve users from the database
                            $users = $conn->query("SELECT * FROM users order by name asc");
                            // Initialize counter
                            $i = 1;
                            // Loop through each user
                            while ($row = $users->fetch_assoc()) :
                            ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm edit_borrower" href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-outline-danger btn-sm delete_borrower" href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery script for handling user actions
    $('#new_user').click(function () {
        uni_modal('New User', 'manage_user.php')
    })
    $('.edit_borrower').click(function () {
        uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
    $('.delete_borrower').click(function () {
        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
    })

    function delete_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
