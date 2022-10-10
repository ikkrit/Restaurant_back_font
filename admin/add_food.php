<?php include '../config/constants.php'; ?>


<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Add Food</h1>

            <br><br>

            <?php

                if(isset($_SESSION['upload'])) {

                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Title of the Food"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"></td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php

                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if($count > 0) {

                                        while($row = mysqli_fetch_assoc($res)) {

                                            $id = strip_tags($row['id']);
                                            $title = strip_tags($row['title']);

                                            ?>
                                            <option value="<?=$id;?>"><?=$title;?></option>
                                            <?php
                                        }

                                    } else {

                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php

                                    }

                                ?>

                            </select>
                        </td>
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
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                if(isset($_POST['submit'])) {

                    $title = strip_tags($_POST['title']);
                    $description = strip_tags($_POST['description']);
                    $price = strip_tags($_POST['price']);
                    $category = strip_tags($_POST['category']);

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

                    if(isset($_FILES['image']['name'])) {

                        $image_name = strip_tags($_FILES['image']['name']);

                        if($image_name != "") {

                            $ext = explode('.', $image_name);
                            $ext_file = end($ext);

                            $image_name = "Food-Name-".rand(000,999).'.'.$ext_file;

                            $src = strip_tags($_FILES['image']['tmp_name']);

                            $dst = "../img/food/".$image_name;

                            $upload = move_uploaded_file($src, $dst);

                            if($upload == false) {

                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                                header('Location:'.SITEURL.'admin/add_food.php');
                                die();

                            }

                        }

                    } else {

                        $image_name = "";

                    }

                    $sql2 = "INSERT INTO tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id=$category,
                        featured='$featured',
                        active='$active'";


                    $res2 = mysqli_query($conn, $sql2);
                    

                    if($res2 == true) {

                        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                        header('Location:'.SITEURL.'admin/manage_food.php');

                    } else {

                        $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                        header('Location:'.SITEURL.'admin/manage_food.php');

                    }

                }

            ?>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>