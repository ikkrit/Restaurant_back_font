<?php include '../config/constants.php';?>

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

        <br><br>

        <?php
            if(isset($_SESSION['login'])) {
                
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])) {

                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>

        <br><br>

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

<?php

    if(isset($_POST['submit'])) {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = strip_tags(md5($_POST['password']));
        $password = mysqli_real_escape_string($conn, $raw_password);
    
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
        $res = mysqli_query($conn, $sql);
    
        $count = mysqli_num_rows($res);
    
        if($count == 1) {
    
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username;

            header('Location:'.SITEURL.'admin/');
        } else {
    
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not Match.</div>";
            header('Location:'.SITEURL.'admin/login_admin.php');
        }
    
    }

?>


