<?php
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    include '../sql.php';
    //Kiem tra dang nhap
    if (!isset($_SESSION['TAIKHOAN']))
        header('Location: ../index.php');
    //Kiem tra co ton tai gio hang hay khong
    if (!isset($_SESSION['CART'])) 
        header('Location: index.php');

    if (isset($_POST['submit'])) {
        if ($_SESSION['CART']['TOTAL'] > 0){
            //Lay thong tin dau vao
            $TENKH = trim($_POST['TenKH']);
            $SDTKH = $_POST['SdtKH'];
            $DIACHI = trim($_POST['DiaChiKH']);
            //Gan SoDonDH
            $idCmd = "SELECT MAX(CAST(SODONHH AS int)) AS SODONDH FROM dathang";
            $idExe = mysqli_query($con, $idCmd);
                if ($idExe->num_rows > 0)
                while ($r = mysqli_fetch_assoc($idExe)){
                    if ($r['SODONDH'] == '')
                        $id = 1; //Neu rong thi cho $id co gia tri la 1
                    else
                        $id = $r['SODONDH'] + 1; //Neu da co gia tri thi lay gia tri max+1 = $id
                }
            
            //Gan MSKH
            $KHCmd = "SELECT MAX(CAST(MSKH AS int)) AS MSKH FROM khachhang";
            $KHExe = mysqli_query($con, $KHCmd);
                if ($KHExe->num_rows > 0)
                while ($k = mysqli_fetch_assoc($KHExe)){
                    if ($k['MSKH'] == '')
                        $K_id = 1; //Neu rong thi cho $id co gia tri la 1
                    else
                        $K_id = $k['MSKH'] + 1; //Neu da co gia tri thi lay gia tri max+1 = $id
                }
            
            $them_khachhang = "INSERT INTO khachhang VALUES ('".$K_id."', '".$TENKH."', '".$DIACHI."', '".$SDTKH."')";
            mysqli_query($con, $them_khachhang); //Them khach hang vao bang khach hang

            $NGAYDAT = date("Y-m-d G:i:s"); //Lay ngay cua he thong
            foreach ($_SESSION['CART'] as $MSHH => $SOLUONG) {
                $findProCmd = "SELECT * FROM hanghoa WHERE MSHH = '".$MSHH."'";
                $findPro = mysqli_query($con, $findProCmd);

                if ($findPro->num_rows > 0) {
                    while ($Pro = mysqli_fetch_assoc($findPro)) {
                        $GIADATHANG = $SOLUONG*$Pro['GIA'];
                        $CONLAI = $Pro['SOLUONGHANG'] - $SOLUONG; //Tinh so luong hang con lai
                        
                        $them_dathang = "INSERT INTO dathang VALUES ('".$id."', '".$_SESSION['MSNV']."', '".$K_id."', '".$NGAYDAT."', 'pending')";
                        $them_chitiet = "INSERT INTO chitietdathang VALUES ('".$id."', '".$MSHH."', '".$SOLUONG."', '".$GIADATHANG."')";
                        $capnhat_hanghoa = "UPDATE hanghoa SET SOLUONGHANG = '".$CONLAI."' WHERE MSHH = '".$MSHH."'";
                        
                        // print $them_khachhang.'<br>'.$them_dathang.'<br>'.$them_chitiet;
                        mysqli_query($con, $them_dathang); //Them thong tin dat hang vao bang dat hang 
                        mysqli_query($con, $them_chitiet); //Them thong tin dat hang vao bang chi tiet dat hang
                        mysqli_query($con, $capnhat_hanghoa); //Cap nhat so hang con lai trong kho
                    }
                    $_SESSION['PAID'] = "SUCCESS"; //De bao trang thai thanh cong
                }
            }
        }else
        $_SESSION['PAID'] = "FAILED";
    }else{
        $_SESSION['PAID'] = "FAILED"; 
    }
    unset($_SESSION['CART']); //Xoa SESSION gio hang tranh bi lap lai
    header('Location: index.php'); 
?>