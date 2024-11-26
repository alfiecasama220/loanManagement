<?php
// Check if a session is not already active
if(session_status() !== PHP_SESSION_ACTIVE) {
    // Start session
    session_start();
}
// Check if the 'login_name' session variable is set
$login_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '';

?>

<style>
    .logo {
        margin: auto;
        font-size: 20px;
        background: none;
        padding: 7px 11px;
        border-radius: 50% 50%;
        color: #000000b3;
    }
    .bg-custom-green {
        background-color: green;
    }
</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display: flex;">
                <div class="logo">
                    <!-- <span class="fa fa-money-bill-wave"></span> -->
                     <img width="50" src="assets/img/logo.png" alt="">
                </div>
            </div>
            <div class="col-md-4 float-left text-white">
                <large><b>Metro Dumaguete College Resource Cooperative</b></large>
            </div>
            <div class="col-md-2 float-right text-white">
                <?php if (!empty($login_name)) : ?>
                    <a href="ajax.php?action=logout" class="text-white"><?php echo $login_name; ?> <i class="fa fa-power-off"></i></a>
                <?php else : ?>
                    <!-- Handle case where login_name is not set -->
                    <a href="login.php" class="text-white">Logout <i class="fa fa-power-off"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</nav>
