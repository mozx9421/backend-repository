<?php include('connect.php')?>
<?php
    session_start();

    if(!isset($_SESSION['username'])){
      echo "<script>
      alert('กรุณาเข้าสู่ระบบก่อน..');
      window.location.replace('login_page.php');
      </script>";
    }

    if (isset($_GET['logout'])){
      session_destroy();
      unset($_SESSION['username']);
      echo "<script>
      alert('ออกจากระบบสำเร็จ');
      window.location.replace('login_page.php');
      </script>";
    }

    if($_SESSION['emp_level'] == "พนักงาน" ){
      echo "<script>
      alert('คุณไม่มีสิทธิ์เข้าถึงเนื้อหานี้..');
      window.location.replace('index_employee.php');
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
  <!--Modal-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" <?php
          if($_SESSION['emp_level'] == "พนักงาน" ){
            ?> href="index_employee.php" <?php
          }else{
            ?> href="index_manager.php" <?php
          } ?> >
            <img src="assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
         <!-- Nav items -->
         <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="ni ni-tv-2 text-orange"></i>
                <span class="nav-link-text">ภาพรวม</span>
              </a>
            </li>
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
            <li class="nav-item">
            <a class="nav-link active">
                <i class="ni ni-single-02 text-orange"></i>
                <span class="nav-link-text">พนักงาน</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="report.php">
                <i class="fas fa-paste text-orange"></i>
                <span class="nav-link-text">รายงาน</span>
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
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <div class="media align-items-center">
                <div class="media-body  ml-2 mt-1 mb-1 d-none d-lg-block">
                  <span class="mb-0 text-sm text-light">ชื่อผู้ใช้ : <?php echo $_SESSION['emp_name']," ",$_SESSION['emp_surname'] ?></span>
                </div>
              </div>
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
            <div class="col-lg-2 col-7">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6 animate-bottom">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <table class="table-white col-xl-12">
                  <tr>
                    <td align="left">
                      <div class="col-xl-12"><br>
                        <h5 class="mb-0">รายละเอียดพนักงาน</h5><br>
                      </div>
                    </td>
                    <td align="right">
                      <div class="col-xl-12">
                        <a href="register_page.php">
                          <button class='btn btn-outline-primary'><span><i class="fas fa-plus"></i> เพิ่มพนักงาน</button>
                        </a>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- Projects table -->
            <div class="table-responsive ">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th><h6 class="text-gray mb-0">รหัสพนักงาน</h6></th>
                    <th><h6 class="text-gray mb-0">ชื่อ-นามสกุล</h6></th>
                    <th><h6 class="text-gray mb-0">ตำเเหน่งงาน</h6></th>
                    <th><h6 class="text-gray mb-0">username</h6></th>
                    <th><h6 class="text-gray mb-0">เพศ</h6></th>
                    <th><h6 class="text-gray mb-0">เบอร์โทรศัพท์มือถือ</h6></th>
                    <th><h6 class="text-gray mb-0" align="center">ตัวเลือก</h6></th>
                  </tr>
                </thead>

                <!-- Edit And Delete -->
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM emp_data ORDER BY emp_id ASC") or die(mysqli_error());
                  while($fetch = mysqli_fetch_array($query)){
                 ?>
                <tr>
                  <td><?php echo $fetch['emp_id']?></td>
                  <td><?php echo $fetch['emp_name'],$fetch['emp_surname']?></td>
                  <td><?php echo $fetch['emp_level']?></td>
                  <td><?php echo $fetch['emp_username']?></td>
                  <td><?php echo $fetch['emp_gender']?></td>
                  <?php
                    $tel= $fetch['emp_tel'];
                    if($tel == 0){
                      echo "<td> - </td>";
                    }else{
                      echo "<td> 0$fetch[emp_tel] </td>";
                    }
                  ?>
                  <td align="center">
                    <!-- Update Button -->
                    <button type="button" class="btn btn-outline-warning btn-sm text-black" data-toggle="modal" data-target="#emp_update_modal<?php echo $fetch['emp_id']?>">
                    <span><i class="far fa-edit"></i> แก้ไข
                    </button>
                    <!-- Delete Button -->
                    <a href="emp_delete.php?emp_id=<?php echo $fetch['emp_id']?>"
                      <?php
                        echo "onclick=\"return confirm('คุณต้องการลบข้อมูลนี้ใช้หรือไม่')\" ";
                      ?>
                    >
                      <button class='btn btn-outline-danger btn-sm'><span><i class="far fa-trash-alt"></i> ลบ</button>
                    </a>
                  </td>
                </tr>
                <?php
                  include 'emp_update.php';
                }
                ?>
              </table>
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