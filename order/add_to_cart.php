<?php
    session_start();
    include '../sql.php';
    //Kiem tra dang nhap
    if (!isset($_SESSION['TAIKHOAN']))
        header('Location: ../index.php');

    if (isset($_POST['addToCart']) && $_POST['quantity'] > 0) {
        $MSHH = $_POST['addToCart'];
        $SLHH = $_POST['quantity'];
        //Kiem tra SP da co trong gio hang chua
        if(isset($_SESSION['CART'][$MSHH]))
            $SoLuong = $_SESSION['CART'][$MSHH] + $SLHH; //Neu co thi cong them
        else
            $SoLuong = $SLHH; //Neu chua co thi gan so moi nhap la so luong

        //Kiem tra so luong hang con trong kho
        $checkCmd = "SELECT * FROM hanghoa WHERE MSHH = '".$MSHH."'";
        $check = mysqli_query($con, $checkCmd);

        if($check->num_rows > 0)
            while ($row = mysqli_fetch_assoc($check)) {
                if ($row['SOLUONGHANG'] < $SLHH){
                    $_SESSION['HETHANG'] = "true"; //Dat session de thong bao het hang
                }else{
                    $_SESSION['CART'][$MSHH] = $SoLuong; //Neu con thi them so luong vua nhap
                }
            }
        header('Location: index.php');
    }
    header('Location: index.php');
?>