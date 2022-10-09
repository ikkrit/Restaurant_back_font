<?php include '../config/constants.php'; ?>

<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Manage Category</h1>

            <br><br>

            <?php

                if(isset($_SESSION['add'])) {

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['remove'])) {

                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete'])) {

                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

            ?>
            
            <br><br>

            <a href="<?=SITEURL;?>admin/add_category.php" class="btn-primary">Add Category</a>

            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count > 0) {

                        while($row = mysqli_fetch_assoc($res)) {

                            $id = strip_tags($row['id']);
                            $title = strip_tags($row['title']);
                            $image_name = strip_tags($row['image_name']);
                            $featured = strip_tags($row['featured']);
                            $active = strip_tags($row['active']);

                            ?>

                            <tr>
                                <td><?=$sn++;?></td>
                                <td><?=$title;?></td>
                                <td>
                                    <?php

                                        if($image_name != "") {

                                            ?>
                                                <img src="<?=SITEURL;?>img/category/<?=$image_name;?>" alt="<?=$title;?>" width="100px">
                                            <?php

                                        } else {
                                            echo "<div class='error'>Image not Added.</div>";
                                        }

                                    ?>
                                </td>
                                <td><?=$featured;?></td>
                                <td><?=$active;?></td>
                                <td>
                                    <a href="<?=SITEURL;?>admin/update_category.php" class="btn-secondary">Update Category</a>
                                    <a href="<?=SITEURL;?>admin/delete_category.php?id=<?=$id;?>&image_name=<?=$image_name;?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>

                            <?php

                        }

                    } else {

                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>

                        <?php

                    }

                ?>

            </table>
        </div>
        
    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>