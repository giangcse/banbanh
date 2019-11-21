<?php
    $server = "localhost"; // Server sql
    $username = "root"; //Tai khoan
    $password = ""; //Mat khau
    $database = "banbanh";  //Ten csdl

    $con = mysqli_connect($server, $username, $password, $database);
    if (!$con)
        die();
?>