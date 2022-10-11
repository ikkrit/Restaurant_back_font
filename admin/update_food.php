<?php include '../config/constants.php'; ?>

<?php 

    if(isset($_GET['id'])) {

        $id = strip_tags($_GET['id']);

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $title = strip_tags($row2['title']);
        $description = strip_tags($row2['description']);
        $price = strip_tags($row2['price']);
        $current_image = strip_tags($row2['image_name']);
        $current_category = strip_tags($row2['category_id']);
        $featured = strip_tags($row2['featured']);
        $active = strip_tags($row2['active']);

    } else {

        header('Location:'.SITEURL.'admin/manage_food.php');
    }

?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>
 
<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Update Food</h1>

            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?=$title;?>"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?=$description;?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><Input type="number" name="price" value="<?=$price;?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php

                                if($current_image == "") {

                                    echo "<div class='error'>Image not Available.</div>";

                                } else {

                                    ?>
                                    <img src="<?=SITEURL;?>img/food/<?=$current_image;?>" alt="<?=$title;?>" width="150px">
                                    <?php

                                }

                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image: </td>
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

                                            $category_title = strip_tags($row['title']);
                                            $category_id = strip_tags($row['id']);

                                            ?>

                                            <option <?php if($current_category == $category_id){echo "selected";} ?>value="<?=$category_id;?>"><?=$category_title;?></option>

                                            <?php
                                        }

                                    } else {

                                        echo "<option value='0'>Category Not Available.</option>";
                                    }

                                ?>

                            </select>
                        </td>
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
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="hidden" name="current_image" value="<?=$current_image;?>">

                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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

        $id = strip_tags($_POST['id']);
        $title = strip_tags($_POST['title']);
        $description = strip_tags($_POST['description']);
        $price = strip_tags($_POST['price']);
        $current_image = strip_tags($_POST['current_image']);
        $category = strip_tags($_POST['category']);

        $featured = strip_tags($_POST['$featured']);
        $active = strip_tags($_POST['active']);

        if(isset($_FILES['image']['name'])) {

            $image_name = strip_tags($_FILES['image']['name']);

            if($image_name != "") {

                $ext = end(explode('.', $image_name));

                $image_name = "Food-Name-".rand(000,999).'.'.$ext;

            }

        } else {

            $image_name = $current_image;
        }

    }

?>