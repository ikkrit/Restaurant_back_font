<!---------------------------- HEADER -------------------------------------->  

<?php include 'components/_header.php' ?>

<!---------------------------- NAVBAR -------------------------------------->    

<?php include 'components/_nav.php' ?>
    
<!---------------------------- FOOD SEARCH -------------------------------------->

<?php include 'components/_food_search.php' ?>
    
<!---------------------------- FOOD MENU -------------------------------------->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0) {

                    while($row = mysqli_fetch_assoc($res)) {

                        $id = strip_tags($row['id']);
                        $title = strip_tags($row['title']);
                        $description = strip_tags($row['description']);
                        $price = strip_tags($row['price']);
                        $image_name = strip_tags($row['image_name']);

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php

                                        if($image_name == "") {

                                            echo "<div class='error'>Image not Available.</div>";

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

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }

                } else {

                    echo "<div class='error'>Food not found.</div>";

                }
            ?>

            <div class="clearfix"></div>      

        </div>

    </section>
    
<!---------------------------- SOCIAL -------------------------------------->

<?php include 'components/_social.php' ?>
    
<!---------------------------- FOOTER -------------------------------------->

<?php include 'components/_footer.php' ?>