<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['TAIKHOAN'])) {
        header('Location: ../index.php'); //Neu chua dang nhap thi chuyen ve trang dang nhap
    }else{
        if (!isset($_SESSION['CART'])) {
            header('Location: index.php'); //Neu da dang nhap nhung gio hang rong chuyen ve trang dat hang
        }
    }

    if (isset($_SESSION['CART'])) {
    //    foreach ($_SESSION['CART'] as $key => $value) {
    //        echo $key.' '.$value;
    //    }
    print_r($_SESSION['CART']);
    }
?>