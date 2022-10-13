<?php include '../config/constants.php'; ?>

<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Manage Order</h1>

            <br><br><br>

            <?php
                if(isset($_SESSION['update'])) {

                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Fodd</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count > 0) {

                        while($row = mysqli_fetch_assoc($res)) {

                            $id = strip_tags($row['id']);
                            $food = strip_tags($row['food']);
                            $price = strip_tags($row['price']);
                            $qty = strip_tags($row['qty']);
                            $total = strip_tags($row['total']);
                            $order_date = strip_tags($row['order_date']);
                            $status = strip_tags($row['status']);
                            $customer_name = strip_tags($row['customer_name']);
                            $customer_contact = strip_tags($row['customer_contact']);
                            $customer_email = strip_tags($row['customer_email']);
                            $customer_address = strip_tags($row['customer_address']);

                            ?>

                                <tr>
                                    <td><?=$sn++;?>. </td>
                                    <td><?=$food;?></td>
                                    <td><?=$price;?></td>
                                    <td><?=$qty;?></td>
                                    <td><?=$total;?></td>
                                    <td><?=$order_date;?></td>

                                    <td>
                                        <?php
                                            if($status == "Ordered") {
                                                echo "<label style='color: blue;'>$status</label>";
                                            } elseif($status == "On Delivery") {
                                                echo "<label style='color: orange;'>$status</label>";
                                            } elseif($status == "Delivered") {
                                                echo "<label style='color: green;'>$status</label>";
                                            } elseif($status == "Cancelled") {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>

                                    <td><?=$customer_name;?></td>
                                    <td><?=$customer_contact;?></td>
                                    <td><?=$customer_email?></td>
                                    <td><?=$customer_address;?></td>
                                    <td>
                                        <a href="<?=SITEURL;?>admin/update_order.php?id=<?=$id;?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>

                            <?php

                        }

                    } else {

                        echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";

                    }

                ?>

            </table>
        </div>
        
    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>