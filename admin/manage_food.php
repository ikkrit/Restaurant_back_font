<?php include '../config/constants.php'; ?>

<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Manage Food</h1>

            <br><br>

            <a href="<?=SITEURL;?>admin/add_food.php" class="btn-primary">Add Food</a>

            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <tr>
                    <td>1. </td>
                    <td>Vijay Thapas</td>
                    <td>vijaythapa</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>2. </td>
                    <td>Vijay Thapas</td>
                    <td>vijaythapa</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>3. </td>
                    <td>Vijay Thapas</td>
                    <td>vijaythapa</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

            </table>
        </div>
        
    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>