<?php
    session_start();
    include '../sql.php';
    //Kiem tra dang nhap
    if (!isset($_SESSION['TAIKHOAN']))
        header('Location: ../index.php');

    if (isset($_POST['ThemHH'])) {
        $TENHH = trim($_POST['TenHH']);
        $GIAHH = $_POST['GiaHH'];
        $HINHHH = $_POST['HinhHH'];
        $SOLUONGHH = $_POST['SoLuongHH'];
        $NHOMHH = $_POST['NhomHH'];
        $MOTAHH = $_POST['MoTaHH'];

        //Tao id cho hang hoa
        $idCmd = "SELECT MAX(CAST(MSHH AS int)) AS MSHH FROM hanghoa";
        $idExe = mysqli_query($con, $idCmd);
            if ($idExe->num_rows > 0)
                while ($r = mysqli_fetch_assoc($idExe)){
                    if ($r['MSHH'] == '')
                        $id = 1; //Neu rong thi cho $id co gia tri la 1
                    else
                        $id = $r['MSHH'] + 1; //Neu da co gia tri thi lay gia tri max+1 = $id
                }

        $them_hanghoa = "INSERT INTO hanghoa VALUES ('".$id."', '".$NHOMHH."', '".$TENHH."', '".$GIAHH."', '".$SOLUONGHH."', '".$HINHHH."', '".$MOTAHH."')";
        $them = mysqli_query($con, $them_hanghoa);

        if ($them) {
            $_SESSION['ADD'] = "SUCCESS";
        } else {
            $_SESSION['ADD'] = "FAILED";
        }
        header('Location: index.php');
    }
?>