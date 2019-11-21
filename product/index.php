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
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="../order">
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
                Sản phẩm <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../employee">
                Nhân viên
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../customer"> 
                Khách hàng
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../report">  
                Hóa đơn
                </a>
              </li>
              <li class="nav-item">
                <a href="../logout.php" class="nav-link" style="color: red;">Đăng xuất</a>
              </li>
          </div>
        </nav>
        <!-- Phan kiem tra thanh toan thanh cong hay chua -->
        <?php 
          if (isset($_SESSION['ADD'])) {
            if ($_SESSION['ADD']=='SUCCESS') {
            ?>
              <script type="text/javascript">
                Swal.fire({
                type: 'success',
                title: 'Thêm sản phẩm thành công!',
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
                  title: 'Thêm sản phẩm thất bại!',
                  showConfirmButton: false,
                  timer: 1500
                })
              </script>
              <?php
            }
            unset($_SESSION['ADD']);
          }
        ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Sản phẩm</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them"><i class="fas fa-plus"></i> Thêm sản phẩm</button>
            </div>
          </div>
          <!-- Begin modal them -->
          <div class="modal fade" id="them" tabindex="-1" role="dialog" aria-labelledby="Them" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Them">Thêm sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_product.php" method="post" onsubmit="return validate()">
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-angle-right"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tên sản phẩm" aria-label="TenHH" aria-describedby="TenHH" name="TenHH" id="TenHH">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="text" class="form-control" pattern="\d{0,9}" placeholder="Giá sản phẩm" aria-label="GiaHH" aria-describedby="GiaHH" name="GiaHH" id="GiaHH">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-file-image"></i></span>
                    </div>
                    <input type="url" class="form-control" placeholder="Link ảnh sản phẩm" aria-label="HinhHH" aria-describedby="HinhHH" name="HinhHH" id="HinhHH">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                    </div>
                    <input type="text" pattern="\d{0,9}" class="form-control" placeholder="Số lượng sản phẩm" aria-label="SoLuongHH" aria-describedby="SoLuongHH" name="SoLuongHH" id="SoLuongHH">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                    </div>
                    <select name="NhomHH" id="NhomHH" class="custom-select">
                        <option selected disabled>Loại sản phẩm</option>
                        <?php
                        include '../sql.php';
                            $loaiCmd = "SELECT * FROM nhomhanghoa";
                            $loai = mysqli_query($con, $loaiCmd);
                            if ($loai->num_rows > 0) {
                                while ($l = mysqli_fetch_assoc($loai)) {
                                ?>
                        <option value="<?php echo $l['MANHOM']; ?>"><?php echo $l['TENNHOM']; ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-info"></i></span>
                    </div>
                    <textarea class="form-control" row="3" name="MoTaHH" id="MoTaHH"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="ThemHH" id="ThemHH" class="btn btn-primary">Thêm</button>
                </div>
                </form>
                </div>
            </div>
          </div>
          <!-- End modal -->
          <!-- Script kiem tra thong tin san pham -->
          <script>
              function validate(){
                  var ten = document.getElementById('TenHH').value;
                  var gia = document.getElementById('GiaHH').value;
                  var anh = document.getElementById('HinhHH').value;
                  var loai = document.getElementById('NhomHH').value;

                  switch ("") {
                      case ten:
                      case gia:
                      case anh:
                      case loai:
                          alert('Vui lòng điền đủ thông tin!');
                          return false;
                          break;
                      default:
                          return true;
                          break;
                  }
                  return false;
              }
          </script>
          <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Hình</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../sql.php';
                $showCmd = "SELECT * FROM hanghoa INNER JOIN nhomhanghoa ON nhomhanghoa.MANHOM = hanghoa.MANHOM";
                $show = mysqli_query($con, $showCmd);
                if ($show->num_rows > 0) {
                    while ($sh = mysqli_fetch_assoc($show)) {
                    ?>
                    <tr>
                        <td><?php echo $sh['MSHH']; ?></td>
                        <td><img src="<?php echo $sh['HINH']; ?>" width="70px"></td>
                        <th><?php echo $sh['TENHH']; ?></th>
                        <td><?php echo $sh['TENNHOM']; ?></td>
                        <td><?php echo $sh['SOLUONGHANG']; ?></td>
                        <td><?php echo number_format($sh['GIA'], 0); ?>đ</td>
                        <td><form action="products.php?edit" method="post"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#s<?php echo $sh['MSHH']; ?>"><i class="far fa-edit"></i></button></form></td>
                    </tr>
                    <!-- Modal sua -->
                    <div class="modal fade" id="s<?php echo $sh['MSHH']; ?>" tabindex="-1" role="dialog" aria-labelledby="sua" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Them">Cập nhật thông tin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="products.php?add" method="post" onsubmit="return validate()">
                            <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-angle-right"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Tên sản phẩm" aria-label="TenSP" aria-describedby="TenSP" name="TenSP" id="TenSP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" class="form-control" pattern="\d{0,9}" placeholder="Giá sản phẩm" aria-label="GiaSP" aria-describedby="GiaSP" name="GiaSP" id="GiaSP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-file-image"></i></span>
                                </div>
                                <input type="url" class="form-control" placeholder="Link ảnh sản phẩm" aria-label="HinhSP" aria-describedby="HinhSP" name="HinhSP" id="HinhSP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                                </div>
                                <input type="text" pattern="\d{0,9}" class="form-control" placeholder="Số lượng sản phẩm" aria-label="SoLuongSP" aria-describedby="SoLuongSP" name="SoLuongSP" id="SoLuongSP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                <select name="NhomSP" id="NhomSP" class="custom-select">
                                    <option selected disabled>Loại sản phẩm</option>
                                    <?php
                                    include 'sql.php';
                                        $loaiCmd = "SELECT * FROM nhomhanghoa";
                                        $loai = mysqli_query($con, $loaiCmd);
                                        if ($loai->num_rows > 0) {
                                            while ($l = mysqli_fetch_assoc($loai)) {
                                            ?>
                                    <option value="<?php echo $l['MANHOM']; ?>"><?php echo $l['TENNHOM']; ?></option>
                                            <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info"></i></span>
                                </div>
                                <textarea class="form-control" row="3" name="MoTaSP" id="MoTaSP"></textarea>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" name="SuaSP<?php echo $sh['MSHH']; ?>" id="SuaSP" class="btn btn-primary">Thêm</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Ket thuc Modal sua -->
                    <?php
                    $tenNut = "SuaSP".$sh['MSHH'];
                    if (isset($_POST[$tenNut])) {
                        $editCmd = "UPDATE hanghoa SET TENHH = '".trim($_POST['TenSP'])."', HINH = '".$_POST['HinhSP']."', GIA = '".$_POST['GiaSP']."', SOLUONGHANG = '".$_POST['SoLuongSP']."', MANHOM = '".$_POST['NhomSP']."' WHERE MSHH = '".$sh['MSHH']."'";
                        $edit = mysqli_query($con, $editCmd);
                        if ($edit) {
                            echo "<script>alert('Đã cập nhật thông tin!')</script>";
                        }else{
                            echo "<script>alert('Chưa cập nhật thông tin!')</script>";
                        }
                    }
                    }
                }
            ?>
            </tbody>
          </table>
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
