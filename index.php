<!---------------------------- HEADER -------------------------------------->  

<?php include 'components/_header.php' ?>

<!---------------------------- NAVBAR -------------------------------------->    

<?php include 'components/_nav.php' ?>
    
<!---------------------------- FOOD SEARCH -------------------------------------->

<?php include 'components/_food_search.php' ?>

<!---------------------------- CATEGORIES -------------------------------------->

    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0) {

                    while($row = mysqli_fetch_assoc($res)) {

                        $id = strip_tags($row['id']);
                        $title = strip_tags($row['title']);
                        $image_name = strip_tags($row['image_name']);
                        ?>

                        <a href="<?=SITEURL;?>category-foods.php?category_id=<?=$id;?>">
                            <div class="box-3 float-container">
                                <?php

                                    if($image_name == "") {
                                        echo "<div class='error'>Image not Available</div>";
                                    } else {

                                        ?>
                                            <img src="<?=SITEURL;?>img/category/<?=$image_name;?>" alt="<?=$title;?>" class="img-responsive img-curve">
                                        <?php

                                    }

                                ?>

                                <h3 class="float-text text-white"><?=$title;?></h3>
                            </div>
                        </a>

                        <?php
                    }

                } else {

                    echo "<div class=''error'>Category not Added.</div>";

                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>

<!---------------------------- FOOD MENU -------------------------------------->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0) {

                    while($row = mysqli_fetch_assoc($res2)) {

                        $id = strip_tags($row['id']);
                        $title = strip_tags($row['title']);
                        $price = strip_tags($row['price']);
                        $description = strip_tags($row['description']);
                        $image_name = strip_tags($row['image_name']);
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == "") {

                                            echo "<div class='error'>Image not available.</div>";

                                        } else {

                                            ?>

                                                <img src="<?=SITEURL;?>img/food/<?=$image_name;?>" alt="<?=$title;?>" class="img-responsive img-curve" height="100px">

                                            <?php

                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?=$title;?></h4>
                                    <p class="food-price"><?=$price;?> €</p>
                                    <p class="food-detail"><?=$description;?></p>
                                    <br>

                                    <a href="<?=SITEURL;?>order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php

                    }

                } else {

                    echo "<div class='error'>Food not available.</div>";

                }

            ?>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?=SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    
<!---------------------------- SOCIAL -------------------------------------->

<?php include 'components/_social.php' ?>
    
<!---------------------------- FOOTER -------------------------------------->

<?php include 'components/_footer.php' ?>