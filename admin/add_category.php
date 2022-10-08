<?php include '../config/constants.php'; ?>

<?php

    if(isset($_POST['submit'])) {

        $title = strip_tags($_POST['title']);

        if(isset($_POST['featured'])) {

            $featured = strip_tags($_POST['featured']);

        } else {

            $featured = "No";

        }

        if(isset($_POST['active'])) {

            $active = strip_tags($_POST['active']);

        } else {

            

        }

    }

?>

<!---------------------------- MENU --------------------------------------> 

<?php include 'components/_admin_menu.php'; ?>

<!---------------------------- MAIN --------------------------------------> 

    <div class="main-content">

        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>