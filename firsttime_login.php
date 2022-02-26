
<?php 
include('connect.php');
    session_start();
    if(!isset($_SESSION['emp_id'])){
        echo "<script>
        alert('กรุณาใส่ชื่อผู้ใช้เเละรหัสบัตรประชาชนก่อน..');
        window.location.replace('forgot_password.php');
        </script>";
      }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Forgot Password</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/pingan_icon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-light">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-pink py-7 py-lg-4 pt-lg-2">
      <div class="container">
        <div class="header-body text-center mb-9">
          <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-4 col-md-6 px-5">
              <image src="assets/img/brand/logo.png" type="image/png" height="170px" width="400px">
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-fel" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <form action="new_password_db.php" method="post">
      <div class="container mt--9 pb-5 animate-left">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-4">
            <div class="card bg-secondary border-0 mb-0">
              <div class="card-header bg-transparent pb-5">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4 ">
                      
                    <h2>กำหนดรหัสผ่านใหม่</h2>
                    <p>รหัสพนักงาน <?php echo $_SESSION['emp_id']?> <br>
                       ชื่อ - สกุล : <?php echo $_SESSION['emp_name']?> <?php echo $_SESSION['emp_surname']?></p>
                  <div class="content">
                </div>
              </div>
            </div>
            <!-- section 1 -->
            <div class="form-group mb-3">
              <label class="input-group text-default">รหัสผ่าน</label>
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input type="password" name="emp_password" class="form-control"  placeholder="password">
              </div>
            </div>

            <div class="form-group">
              <label class="input-group text-default">ยืนยันรหัสผ่าน</label>
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input type="password" name="confirm_new_password" class="form-control" placeholder="new password">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" name ="forgot_bth" class="btn btn-danger my-4" >ยืนยัน</button>
            </form>
            </div>

          </div>
        </div>
      </div>
    
  </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>
</html>
