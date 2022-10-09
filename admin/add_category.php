<?php include '../config/constants.php'; ?>


<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php

                if(isset($_SESSION['add'])) {

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload'])) {

                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
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
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>

<?php

    if(isset($_POST['submit'])) {

        $title = strip_tags($_POST['title']);

        if(isset($_FILES['image']['name'])) {

            $image_name = strip_tags($_FILES['image']['name']);

            $ext = end(explode('.', $image_name));
            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

            $source_path = strip_tags($_FILES['image']['tmp_name']);
            $destination_path = "../img/category/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload == false) {

                $_SESSION['upload'] = "<div class='error text-center'>Failed to Upload Image. </div>";
                header('Location:'.SITEURL.'admin/add_category.php');
                die();
            }

        } else {

            $image_name = "";

        }

        if(isset($_POST['featured'])) {

            $featured = strip_tags($_POST['featured']);

        } else {

            $featured = "No";

        }

        if(isset($_POST['active'])) {

            $active = strip_tags($_POST['active']);

        } else {

            $active = "No";

        }

        $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'";

        $res = mysqli_query($conn, $sql);

        if($res == true) {

            $_SESSION['add'] = "<div class='success text-center'>Category Added Successfully.</div>";
            header('Location:'.SITEURL.'admin/manage_category.php');

        } else {

            $_SESSION['add'] = "<div class='error text-center'>Failed to Add Category.</div>";
            header('Location:'.SITEURL.'admin/add_category.php');
        }

    }

?>