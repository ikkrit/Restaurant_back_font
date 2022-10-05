<?php

    if(isset($_POST['submit'])) {

        $full_name = strip_tags(trim($_POST['full_name']));
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(md5($_POST['password']));

        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'";

        $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($e));
        $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error($e));
        $res = mysqli_query($conn, $sql) or die(mysqli_error($e));
        
    } 

?>

<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Add Admin</h1>

            <br><br>

            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Your Username"></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Your Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>
        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>
