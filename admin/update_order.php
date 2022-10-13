<?php include '../config/constants.php'; ?>

<!---------------------------- MENU -------------------------------------->  

<?php include 'components/_admin_menu.php'; ?>
 
<!---------------------------- MAIN -------------------------------------->   

    <div class="main-content">

        <div class="wrapper">
            <h1>Update Order</h1>

            <br><br>

            <?php

                if(isset($_GET['id'])) {

                    $id = strip_tags($_GET['id']);

                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count == 1) {

                        $row = mysqli_fetch_assoc($res);

                        $food = strip_tags($row['food']);
                        $price = strip_tags($row['price']);
                        $qty = strip_tags($row['qty']);
                        $status = strip_tags($row['status']);
                        $customer_name = strip_tags($row['customer_name']);
                        $customer_contact = strip_tags($row['customer_contact']);
                        $customer_email = strip_tags($row['customer_email']);
                        $customer_address = strip_tags($row['customer_address']);

                    } else {

                        header('Location:'.SITEURL.'admin/manage_order.php');
                    }

                } else {

                    header('Location:'.SITEURL.'admin/manage_order.php');
                }

            ?>

            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Food Name</td>
                        <td><b><?=$food;?></b></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><b><?=$price;?> €</b></td>
                    </tr>

                    <tr>
                        <td>Qty</td>
                        <td><input type="number" name="qty" value="<?=$qty;?>"></td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status == "Ordered"){echo "selected"; } ?> value="Ordered">Ordered</option>
                                <option <?php if($status == "On Delivery"){echo "selected"; } ?> value="On Delivery">On Delivery</option>
                                <option <?php if($status == "Delivered"){echo "selected"; } ?> value="Delivered">Delivered</option>
                                <option <?php if($status == "Cancelled"){echo "selected"; } ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name: </td>
                        <td><input type="text" name="customer_name" value="<?=$customer_name;?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Contact: </td>
                        <td><input type="text" name="customer_contact" value="<?=$customer_contact;?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Email: </td>
                        <td><input type="text" name="customer_email" value="<?=$customer_email;?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Address: </td>
                        <td><textarea name="customer_address" cols="30" rows="5"><?=$customer_address;?></textarea></td>
                    </tr>

                    <tr>
                        <td clospan="2">
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="hidden" name="price" value="<?=$price;?>">

                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                if(isset($_POST['submit'])) {

                    $id = strip_tags($_POST['id']);
                    $price = strip_tags($_POST['price']);
                    $qty = strip_tags($_POST['qty']);

                    $total = $price * $qty;

                    $status = strip_tags($_POST['status']);
                    $customer_name = strip_tags($_POST['customer_name']);
                    $customer_contact = strip_tags($_POST['customer_contact']);
                    $customer_email = strip_tags($_POST['customer_email']);
                    $customer_address = strip_tags($_POST['customer_address']);

                    $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE id=$id";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {

                        $_SESSION['update'] = "<div class='success text-center'>Order Updated Successfully.</div>";
                        header('Location:'.SITEURL.'admin/manage_order.php');

                    } else {

                        $_SESSION['update'] = "<div class='error text-center'>Failed to Update Order.</div>";
                        header('Location:'.SITEURL.'admin/manage_order.php');

                    }

                }

            ?>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>