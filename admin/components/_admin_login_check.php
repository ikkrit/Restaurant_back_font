<?php

    if(!isset($_SESSION['user'])) {

        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        header('Location:'.SITEURL.'admin/login_admin.php');
    }

?>