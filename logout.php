<?php
    session_start();
    if (isset($_SESSION['TAIKHOAN'])) {
        session_destroy();
        header('Location: index.php');
    }
    header('Location: index.php');
?>