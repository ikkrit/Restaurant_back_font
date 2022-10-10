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

            <?php

                if(isset($_SESSION['add'])) {

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])) {

                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload'])) {

                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorize'])) {

                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

            ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $sql = "SELECT * FROM tbl_food";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count > 0) {

                        while($row = mysqli_fetch_assoc($res)) {

                            $id = strip_tags($row['id']);
                            $title = strip_tags($row['title']);
                            $price = strip_tags($row['price']);
                            $image_name = strip_tags($row['image_name']);
                            $featured = strip_tags($row['featured']);
                            $active = strip_tags($row['active']);

                            ?>
                                <tr>
                                    <td><?=$sn++;?></td>
                                    <td><?=$title;?></td>
                                    <td><?=$price;?>€</td>
                                    <td>
                                        <?php
                                            if($image_name == "") {
                                                echo "<div class='error'>Image not Added.</div>";
                                            } else {
                                                ?>
                                                    <img src="<?=SITEURL;?>img/food/<?=$image_name;?>" alt="<?=$title;?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?=$featured;?></td>
                                    <td><?=$active;?></td>
                                    <td>
                                        <a href="<?=SITEURL;?>admin/update_food.php?id=<?=$id;?>" class="btn-secondary">Update Food</a>
                                        <a href="<?=SITEURL;?>admin/delete_food.php?id=<?=$id;?>&image_name=<?=$image_name;?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                            <?php
                        }

                    } else {

                        echo "<tr><td colspan='7' class='error'> Food not Added Yet. </td></tr>";
                    }

                ?>

            </table>
        </div>
        
    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>