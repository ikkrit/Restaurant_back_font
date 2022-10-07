<?php

    include '../config/constants.php'; 

    if(isset($_GET['id'])) { $id_get = $_GET['id'];}

    if(isset($_POST['submit'])) {

        $id = strip_tags($_POST['id']);
        $current_password = strip_tags(md5($_POST['current_password']));
        $new_password = strip_tags(md5($_POST['new_password']));
        $confirm_password = strip_tags(md5($_POST['confirm_password']));

        $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res == true) {

            $count = mysqli_num_rows($res);

            if($count == 1) {

                if($new_password == $confirm_password) {

                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id='$id'";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {

                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                        header('Location:'.SITEURL.'admin/manage_admin.php');

                    } else {

                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                        header('Location:'.SITEURL.'admin/manage_admin.php');
                    }

                } else {

                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match. </div>";
                    header('Location:'.SITEURL.'admin/manage_admin.php');
                }

            } else {

                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                header('Location:'.SITEURL.'admin/manage_admin.php');
            }
        }
    }

?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN -------------------------------------->   

    <div class="main-content">

        <div class="wrapper">
            <h1>Change Password</h1>

            <br><br>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?=$id_get;?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>