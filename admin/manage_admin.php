<?php include '../config/constants.php'; ?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>
 
<!---------------------------- MAIN -------------------------------------->   
 
    <div class="main-content">

        <div class="wrapper">
            <h1>Manage Admin</h1>

            <br>

            <?php

                if(isset($_SESSION['add'])) {

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])) {

                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])) {

                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }


            ?>

            <br><br><br>

            <a href="add_admin.php" class="btn-primary">Add Admin</a>

            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;

                    if($res == true) {
                        $count = mysqli_num_rows($res);

                        if($count > 0) {
                            while($rows=mysqli_fetch_assoc($res)) {
                                $id = strip_tags($rows['id']);
                                $full_name = strip_tags($rows['full_name']);
                                $username = strip_tags($rows['username']);

                            ?>
                            <tr>
                                <td><?=$sn++;?>.</td>
                                <td><?=$full_name;?></td>
                                <td><?=$username;?></td>
                                <td>
                                    <a href="<?=SITEURL;?>admin/update_password.php?id=<?=$id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?=SITEURL;?>admin/update_admin.php?id=<?=$id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?=SITEURL;?>admin/delete_admin.php?id=<?=$id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php

                            }
                        } else {

                        }
                    }
                ?>

            </table>
        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>