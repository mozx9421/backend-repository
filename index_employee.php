<?php include('connect.php')?>
<?php
  session_start();

  if(!isset($_SESSION['username'])){
    echo "<script>
    alert('กรุณาเข้าสู่ระบบก่อน..');
    window.location.replace('login_page.php');
    </script>";
  }

//Change default password for first time login.
$otpcheck = $_SESSION['username'];
$sqlotp = "SELECT otp FROM emp_data WHERE emp_username ='$otpcheck'";
$resultotp = mysqli_query($conn, $sqlotp);
while($rowotp = mysqli_fetch_array($resultotp)){
if ($rowotp['otp'] == "no") {
  echo "<script>
  alert('เข้าสู่ระบบครั้งเเรกกรุณาเปลี่ยนรหัสผ่าน');
  window.location.replace('firsttime_login.php');
</script>";
}
}
  
  if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    echo "<script>
    alert('ออกจากระบบสำเร็จ');
    window.location.replace('login_page.php');
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
  <title>Pingan Backend</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/pingan_icon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>
 
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
         <!-- Nav items -->
         <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="billhistory.php">
                <i class="fas fa-history text-orange"></i>
                <span class="nav-link-text">รายการประวัติ</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="warehouse.php">
                <i class="fas fa-warehouse text-orange"></i>
                <span class="nav-link-text">คลังสินค้า</span>
              </a>
            </li>
            <br>
            <li class="nav-item">
              <a class="nav-link" a href="index_manager.php?logout='1'">
                <i class="fas fa-sign-out-alt text-orange"></i>
                <span class="nav-link-text" >ออกจากระบบ</span>
              </a>
            </li>
            <br>
            <li class="nav-item">
              <a class="nav-link" a href="tutorial.pdf">
                <i class="fas fa-book text-orange"></i>
                <span class="nav-link-text" >คู่มือ</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-danger border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
                <div class="media align-items-center">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm text-white">ชื่อผู้ใช้ : <?php echo $_SESSION['emp_name']," ",$_SESSION['emp_surname'] ?></span>
                  </div>
                </div>
              </a>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-danger pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              </nav>
              <div class="content">
            <?php if (isset($_SESSION['success'])): ?>
            <div class="success">
                  <h3 class = "text-white">
                      <?php
                          echo $_SESSION['success'];
                          unset ($_SESSION['success']);
                      ?>
                  </h3>
            </div>
            <?php endif ?>
          </div>

          <!-- logged in user information -->
          <?php if (isset($_SESSION['username'])):?>
            <h2 class="text-white">ยินดีต้อนรับ</h2><br>
                <div class="card">
                  <div class="card-body border-0">
                      <div class="col-xl-12">
                      
                      <h2 class="text-default">ข้อมูลผู้เข้าใช้</h2><hr>
                      
                      <h3>Username : <p class="text-black"><?php echo $_SESSION['username']?></p>
                          ชื่อ - สกุล : <p class = "text-black"><?php echo $_SESSION['emp_name']?>  <?php echo $_SESSION['emp_surname']?><br> </p> 
                          ตำเเหน่งงาน : <p class = "text-balck"> พนักงาน</h3>
                <?php endif; ?>
                </div>
              </div>
            </div>
             
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