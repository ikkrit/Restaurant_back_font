<?php include '../config/constants.php'; ?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>
 
<!---------------------------- MAIN -------------------------------------->   

    <div class="main-content">

        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>

            <?php

                if(isset($_GET['id'])) {

                    $id = strip_tags($_GET['id']);

                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count == 1) {

                        $row = mysqli_fetch_assoc($res);

                        $title = strip_tags($row['title']);
                        $current_image = strip_tags($row['image_name']);
                        $featured = strip_tags($row['featured']);
                        $active = strip_tags($row['active']);

                    } else {

                        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                        header('Location:'.SITEURL.'admin/manage_category.php');
                    }

                } else {

                    header('Location:'.SITEURL.'admin/manage_category.php');

                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?=$title;?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image != "") {
                                    ?>
                                    <img src="<?=SITEURL;?>img/category/<?=$current_image;?>" width="150px" alt="<?=$title;?>">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?=$current_image;?>">
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                if(isset($_POST['submit'])) {
                    
                    $id = strip_tags($_POST['id']);
                    $title = strip_tags($_POST['title']);
                    $current_image = strip_tags($_POST['current_image']);
                    $featured = strip_tags($_POST['featured']);
                    $active = strip_tags($_POST['active']);

                    if(isset($_FILES['image']['name'])) {

                        $image_name = strip_tags($_FILES['image']['name']);

                        if($image_name != "") {

                            $ext = end(explode('.', $image_name));
                
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                            $source_path = strip_tags($_FILES['image']['tmp_name']);

                            $destination_path = "../img/category/".$image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload == false) {

                                $_SESSION['upload'] = "<div class='error text-center'>Failed to Upload Image. </div>";
                                header('Location:'.SITEURL.'admin/manage_category.php');
                                die();
                            }

                            // REMOVE CURRENT IMAGE

                            if($current_image != "") {

                                $remove_path = "../img/category/".$current_image;
                                $remove = unlink($remove_path);

                                if($remove == false) {

                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
                                    header('Location:'.SITEURL.'admin/manage_category.php');
                                    die();
                                }

                            }

                        } else {

                            $image_name = $current_image;
                        }

                    } else {

                        $image_name = $current_image;
                    }

                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {

                        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                        header('Location:'.SITEURL.'admin/manage_category.php');

                    } else {

                        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                        header('Location:'.SITEURL.'admin/manage_category.php');
                    }

                }

            ?>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>