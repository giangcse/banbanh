<?php
    session_start();
    include '../sql.php';
    //Kiem tra dang nhap
    if (!isset($_SESSION['TAIKHOAN']))
        header('Location: ../index.php');

    if (isset($_POST['deleteCart'])) {
        $MSHH = $_POST['deleteCart'];
        unset($_SESSION['CART'][$MSHH]);
        echo "<script>history.go(-1)</script>";
    }
?>