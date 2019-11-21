<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['TAIKHOAN']))
        header('Location: ../index.php');
    include '../sql.php';
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/4.3/examples/dashboard/"
    />
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/svg-with-js.css"
    />
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <title>He thong quan ly</title>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href=""
        >QUẢN LÝ BÁN BÁNH</a
      >
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cart"><i class="fas fa-shopping-basket"></i> Giỏ hàng</button>
        </li>
      </ul>
    </nav>

    <!-- Phan kiem tra thanh toan thanh cong hay chua -->
    <?php 
      if (isset($_SESSION['PAID'])) {
        if ($_SESSION['PAID']=='SUCCESS') {
        ?>
          <script type="text/javascript">
            Swal.fire({
            type: 'success',
            title: 'Thanh toán thành công!',
            showConfirmButton: false,
            timer: 1500
          })
          </script>
        <?php
        }else{
          ?>
          <script type="text/javascript">
            Swal.fire({
              type: 'error',
              title: 'Thanh toán thất bại!',
              showConfirmButton: false,
              timer: 1500
            })
          </script>
          <?php
        }
        unset($_SESSION['PAID']);
      }
    ?>

    <!-- Thong tin gio hang -->
    <div class="modal fade bd-example-modal-lg" id="cart" tabindex="-1" role="dialog" aria-labelledby="cart" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cart">Thông tin giỏ hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Hình</th>
                  <th scope="col">Tên</th>
                  <th scope="col" class="text-center">Giá</th>
                  <th scope="col" class="text-center">Số lượng</th>
                  <th scope="col" class="text-center">Thành tiền</th>
                  <th scope="col" class="text-right">Xóa</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $tongtien = 0;

                  if (isset($_SESSION['CART'])) {
                    foreach ($_SESSION['CART'] as $key => $value) {
                      $findProCmd = "SELECT * FROM hanghoa WHERE MSHH = '".$key."'";
                      $findPro = mysqli_query($con, $findProCmd);

                      if ($findPro->num_rows > 0) {
                        while ($Pro = mysqli_fetch_assoc($findPro)) {
                          $tongtien += $_SESSION['CART'][$key]*$Pro['GIA'];
                        ?>
                        <tr>
                          <td><img src="<?php echo $Pro['HINH'] ?>" width="50px"></td>
                          <th><?php echo $Pro['TENHH']; ?></th>
                          <td class="text-center"><?php echo number_format($Pro['GIA'], 0); ?>đ</td>
                          <td class="text-center"><?php echo $_SESSION['CART'][$key]; ?></td>
                          <td class="text-center"><?php echo number_format($_SESSION['CART'][$key]*$Pro['GIA'], 0); ?>đ</td>
                          <td class="text-center"><form method="post" action="delete_from_cart.php"><button type="submit" class="close" name="deleteCart" value="<?php echo $key; ?>"><span aria-hidden="true">&times;</span></button></form></td>
                        </tr>
                        <?php
                        }
                      }
                    }
                  }
                  $_SESSION['CART']['TOTAL'] = $tongtien;
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <h5 style="color: red;"><i class="fas fa-coins"></i> <?php echo number_format($tongtien, 0) ?>đ</h5>
            <form action="payment.php" method="post">
              <button type="submit" class="btn btn-outline-success" name="payBtn"><i class="fas fa-money-check-alt"></i> Thanh toán</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Phan hien thi san pham -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  Orders <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../product/">
                Sản phẩm
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../employee/">
                Nhân viên
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../customer/"> 
                Khách hàng
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../report/">  
                Hóa đơn
                </a>
              </li>
              <li class="nav-item">
                <a href="../logout.php" class="nav-link" style="color: red;">Đăng xuất</a>
              </li>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Menu</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>
          <div class="row">
            <?php
              include 'show_product.php';
                show();
            ?>
          </div>
        </main>
      </div>
    </div>
  </body>
  <script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"
  ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js"></script>

</html>
