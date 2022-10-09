<?php

    include '../config/constants.php';

?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>
 
<!---------------------------- MAIN -------------------------------------->   

    <div class="main-content">

        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value=""></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>Image will be displayed here</td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td><input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
                    </tr>

                </table>

            </form>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>