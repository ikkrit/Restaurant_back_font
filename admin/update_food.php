<?php include '../config/constants.php'; ?>

<?php 

    if(isset($_GET['id'])) {

        $id = strip_tags($_GET['id']);

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $title = strip_tags($row['title']);
        $description = strip_tags($row['description']);
        $price = strip_tags($row['price']);
        $current_image = strip_tags($row['image_name']);
        $current_category = strip_tags($row['category_id']);
        $featured = strip_tags($row['featured']);
        $active = strip_tags($row['active']);

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
                            <textarea name="description" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><Input type="number" name="price"></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>Display the image if Available</td>
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

                                            <option value="<?=$category_id;?>"><?=$category_title;?></option>

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
                        <td><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                    </tr>

                </table>

            </form>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>