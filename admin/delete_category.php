<?php

    include '../config/constants.php';

    if(isset($_GET['id']) && isset($_GET['image_name'])) {

        $id = strip_tags($_GET['id']);
        $image_name = strip_tags($_GET['image_name']);

        if($image_name != "") {

            $path = "../img/category/".$image_name;
            $remove = unlink($path);

            if($remove == false) {

                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                header('Location:'.SITEURL.'admin/manage_category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true) {

            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header('Location:'.SITEURL.'admin/manage_category.php');

        } else {

            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            header('Location:'.SITEURL.'admin/manage_category.php');

        }

    } else {

        header('Location:'.SITEURL.'admin/manage_category.php');
    }

?>