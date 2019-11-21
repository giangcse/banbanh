<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['TAIKHOAN']))
      header('Location: ../index.php');

    if (!isset($_SESSION['CART'])) //Kiem tra xem co ton tai gio hang khong
      header('Location: index.php');
    else
      if ($_SESSION['CART']['TOTAL'] <= 0) //Kiem tra xem gio hang co hang hay khong
        header('Location: index.php');
    
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
    <title>He thong quan ly</title>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href=""
        >QUẢN LÝ BÁN BÁNH</a
      >
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
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
            <h1 class="h2">Thanh toán</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>
          <div class="row">
            <div class="col-6">
                <h3 class="text-center">Thông tin khách hàng</h3><hr>
                <form action="submit.php" method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="TenKH">Họ tên</label>
                        <input type="text" class="form-control" id="TenKH" name="TenKH" required>
                    </div>
                    <div class="form-group">
                        <label for="SdtKH">Số điện thoại</label>
                        <input type="text" class="form-control" id="SdtKH" name="SdtKH" pattern="\d{10,10}" required>
                    </div>
                    <div class="form-group">
                        <label for="DiaChiKH">Địa chỉ</label>
                        <input type="text" class="form-control" id="DiaChiKH" name="DiaChiKH" required>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-block btn-success"><i class="fas fa-hand-holding-usd"></i> THANH TOÁN</button>
                </form>
            </div>
            <!-- Script xac thuc form cua bootstrap -->
            <script>
                (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                    });
                }, false);
                })();
            </script>
            <div class="col-6">
                <h3 class="text-center">Chi tiết giỏ hàng</h3><hr>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Hình</th>
                            <th scope="col" class="text-center">Tên</th>
                            <th scope="col" class="text-center">Giá</th>
                            <th scope="col" class="text-center">Số lượng</th>
                            <th scope="col" class="text-center">Thành tiền</th>
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
                <hr>
                <h5 class="text-right" style="color: red;">Tổng tiền: <?php echo number_format($tongtien, 0); ?>đ</h5>
            </div>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</html>
