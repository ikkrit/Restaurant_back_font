<!---------------------------- HEADER -------------------------------------->  

<?php include 'components/_header.php' ?>

<!---------------------------- NAVBAR -------------------------------------->    

<?php include 'components/_nav.php' ?>

<?php

    if(isset($_GET['category_id'])) {

        $category_id = strip_tags($_GET['category_id']);

        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $category_title = strip_tags($row['title']);

    } else {

        header('Location:'.SITEURL);

    }

?>
    
<!---------------------------- FOOD SEARCH -------------------------------------->

    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?=$category_title;?>"</a></h2>

        </div>
    </section>
    
<!----------------------------- FOOD MENU --------------------------------------->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0) {

                    while($row2 = mysqli_fetch_assoc($res2)) {

                        $title = strip_tags($row2['title']);
                        $price = strip_tags($row2['price']);
                        $description = strip_tags($row2['description']);
                        $image_name = strip_tags($row2['image_name']);
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php

                                        if($image_name == "") {

                                            echo "<div class='error'>Image not Available.</div>";

                                        } else {

                                            ?>

                                                <img src="<?=SITEURL;?>img/food/<?=$image_name;?>" alt="<?=$title;?>" class="img-responsive img-curve">

                                            <?php

                                        }

                                    ?>

                                </div>

                                <div class="food-menu-desc">
                                    <h4><?=$title;?></h4>
                                    <p class="food-price"><?=$title;?> €</p>
                                    <p class="food-detail"><?=$description;?></p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }

                } else {

                    echo "<div class='error'>Food not Available.</div>";

                }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    
<!---------------------------- SOCIAL -------------------------------------->

<?php include 'components/_social.php' ?>
    
<!---------------------------- FOOTER -------------------------------------->

<?php include 'components/_footer.php' ?>