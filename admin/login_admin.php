<?php

    include '../config/constants.php';

    if(isset($_POST['submit'])) {

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1) {

            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            header('Location:'.SITEURL.'admin/');
        } else {

            $_SESSION['login'] = "<div class='error'>Username or Password did not Match.</div>";
            header('Location:'.SITEURL.'admin/login_admin.php');
        }

    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin login</title>
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>

        <br>

        <?php
            if(isset($_SESSION['login'])) {
                
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>

        <br>

        <form action="" method="POST" class="text-center">

            <p>Username: </p>
            <input type="text" name="username" placeholder="Enter username"><br><br>

            <p>Password: </p>
            <input type="password" name="password" placeholder="Enter Password"><br>
            <br>
            
            <input type="submit" name="submit" value="Login" class="btn-primary">

        </form>

    </div>

<!--------------------------- FOOTER ------------------------------------->
 
<?php include 'components/_admin_footer.php'; ?>

    
</body>
</html>
