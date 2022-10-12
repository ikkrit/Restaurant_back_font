<!---------------------------- HEADER -------------------------------------->  

<?php include 'components/_header.php' ?>

<!---------------------------- NAVBAR -------------------------------------->    

<?php include 'components/_nav.php' ?>
    
<!---------------------------- CATEGORIES -------------------------------------->

    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

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

                                        echo "<div class='error'>Category not found.</div>";

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
                    echo "<div class='error'>Category not found.</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    
<!---------------------------- SOCIAL -------------------------------------->

<?php include 'components/_social.php' ?>
    
<!---------------------------- FOOTER -------------------------------------->

<?php include 'components/_footer.php' ?>