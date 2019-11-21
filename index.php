<!DOCTYPE html>
<?php session_start(); ?>
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
    <link href="assets/css/dashboard.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/svg-with-js.css"
    />
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .bg-dark {
        background-color: #138076 !important;
      }
    </style>
    <title>He thong quan ly</title>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href=""
        >QUẢN LÝ BÁN BÁNH</a
      >
    </nav>
    <div class="container-fluid">
      <div class="row justify-content-md-center">
        <main role="main" class="col-md col-lg px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        </div>
          <div class="col-md-4 offset-md-4">
            <h3 class="text-center">ĐĂNG NHẬP</h3>
            <form method="post" onsubmit="return validate()">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tên người dùng" name="username" id="username">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-success btn-block" name="submit">ĐĂNG NHẬP</button>
            </form>
          </div>
        </main>
      </div>
    </div>
  </body>
  <?php
    include 'sql.php';

    if (isset($_POST['submit'])) {
        $findCmd = "SELECT * FROM taikhoan WHERE TAIKHOAN = '".$_POST['username']."'";
        $find = mysqli_query($con, $findCmd);
        if ($find->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($find)) {
                if (sha1($_POST['password'])==$row['MATKHAU']) {
                    $_SESSION['TAIKHOAN'] = $row['TAIKHOAN'];
                    $_SESSION['MSNV'] = $row['MSNV'];
                    header('Location: order/');
                }else{
                    echo "<script>alert('Sai mật khẩu!');</script>";
                    header('Location: index.php');
                }
            }
        }else{
            echo "<script>alert('Tài khoản không tồn tại!');</script>"; 
            header('Location: index.php');
        }
    }
  ?>
  <script>
    function validate(){
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;

      switch ("") {
        case password:
          alert("Vui lòng nhập mật khẩu!");
          return false;
          break;
        case username:
          alert("Vui lòng nhập tên người dùng!");
          return false;
        default:
          return true;
          break;
      }
      return false;
    }
  </script>
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
