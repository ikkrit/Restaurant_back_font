<!---------------------------- HEADER -------------------------------------->  

<?php include 'components/_header.php' ?>

<!---------------------------- NAVBAR -------------------------------------->    

<?php include 'components/_nav.php' ?>
    
<!---------------------------- FOOD SEARCH -------------------------------------->

<?php

    if(isset($_GET['food_id'])) {

        $food_id = strip_tags($_GET['food_id']);

        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1) {

            $row = mysqli_fetch_assoc($res);
            $title = strip_tags($row['title']);
            $price = strip_tags($row['price']);
            $image_name = strip_tags($row['image_name']);

        } else {

            header('Location:'.SITEURL);

        }

    } else {

        header('Location:'.SITEURL);

    }

?>

    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?=$title;?></h3>
                        <input type="hidden" name="food" value="<?=$title;?>">

                        <p class="food-price"><?=$price;?> €</p>
                        <input type="hidden" name="price" value="<?=$price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                if(isset($_POST['submit'])) {

                    $food = strip_tags($_POST['food']);
                    $price = strip_tags($_POST['price']);
                    $qty = strip_tags($_POST['qty']);

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:s");
                    $status = "Ordered";

                    $mail = strip_tags($_POST['full_name']);
                    $customer_contact = strip_tags($_POST['contact']);
                    
                    $customer_email = strip_tags($_POST['email']);
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $customer_email = $mail;
                    } else {
                        $_SESSION['mail'] = "<div class='error text-center'>Mail Invalid.</div>";
                        header('Location:'.SITEURL.'order.php');
                    }

                    $customer_address = strip_tags($_POST['address']);

                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {
        
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('Location:'.SITEURL);

                    } else {
                       
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('Location:'.SITEURL);
                    }

                }

            ?>

        </div>
    </section>
    
<!---------------------------- SOCIAL -------------------------------------->

<?php include 'components/_social.php' ?>
    
<!---------------------------- FOOTER -------------------------------------->

<?php include 'components/_footer.php' ?>