<?php

    // START SESSION
    session_start();


    // CONST GLOBAL
    define('SITEURL', 'http://vayashop/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($e));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($e));

?>