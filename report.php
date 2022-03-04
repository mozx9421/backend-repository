<?php include('connect.php')?>
<?php
    session_start();

    if(!isset($_SESSION['username'],$_SESSION['emp_level'])){
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
      unset($_SESSION['username'],$_SESSION['emp_level']);
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

<body class="bg-gradient-danger">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="mr-4" <?php
          if($_SESSION['emp_level'] == "พนักงาน" ){
            ?> href="index_employee.php" <?php
          }else{
            ?> href="index_manager.php" <?php
          } ?> >
            <img src="assets/img/brand/logo.png" width="175" height="75" alt="...">
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
              <a class="nav-link" href="emp.php">
                <i class="ni ni-single-02 text-orange"></i>
                <span class="nav-link-text">พนักงาน</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-paste text-orange" ></i>
                <span class="nav-link-text">รายงาน</span>
              </a>
            </li>
            <hr style="width:85%;ailgn:center;background-color:#D5C1B5">
            <li class="nav-item">
              <a class="nav-link" a href="index_manager.php?logout='1'">
                <i class="fas fa-sign-out-alt text-orange"></i>
                <span class="nav-link-text">ออกจากระบบ</span>
              </a>
            </li>
            <hr style="width:85%;ailgn:center;background-color:#D5C1B5">
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
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <div class="media align-items-center">
                <div class="media-body  ml-2 mt-1 mb-1 d-none d-lg-block">
                  <?php $showname = $_SESSION['emp_name']; ?>
                  <span class="mb-0 text-sm text-light">ชื่อผู้ใช้ : <?php echo $_SESSION['emp_name']," ",$_SESSION['emp_surname'] ?></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-danger pb-6 animate-left">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">รายงาน</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4"></nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6 animate-right">
      <div class="row"><div class="col-xl-1"></div><!-- แทน col-xl-10 center เพราะทับกับ Modal -->
        <div class="col-10">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
              
              <!-- POST -->
                <form action="TCPDF-master/examples/report_stock_out.php" method="POST">
               <!-- <input type="hidden" name="showname121" place="<?php echo $showname ?>"> -->
                  <div class="card-body col-12 ml-4">
                    <div class="row">
                      <div class="col-md-5 ml-4 mt-4 mb-4">
                        <label>ตั้งแต่วันที่</label>
                        <input type="date" name="from_date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; } ?>" class="form-control">
                      </div>
                      <div class="col-md-5 ml-5 mt-4 mb-4">
                        <label>ถึงวันที่</label>
                        <input type="date" name="to_date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; } ?>" class="form-control">
                      </div>
                      <div class="col-md-5 ml-4 mt-1 mb-4">
                        <label>สินค้า</label>
                        <select id="product_select" name="product_select" placeholder="" onkeyup="keyuppername(<?php echo $i ?>)" class="form-control">
                          <option value="">--ว่าง--</option>
                          <?php
                            $sqlpro = "SELECT * FROM product";
                            $resultpro = $conn->query($sqlpro);
                            while($row = $resultpro->fetch_assoc()):
                              echo "<option value=$row[product_id]> $row[product_name] ($row[product_id]) </option>"; 
                            endwhile
                          ?>
                        </select>
                      </div>
                      <div class="col-md-5 ml-5 mt-1 mb-4">
                        <label>พนักงาน</label>
                        <select id="emp_select" name="emp_select" placeholder="" onkeyup="keyuppername(<?php echo $i ?>)" class="form-control">
                          <option value="">--ว่าง--</option>
                          <?php
                            $sqlpro = "SELECT * FROM emp_data";
                            $resultpro = $conn->query($sqlpro);
                            while($row = $resultpro->fetch_assoc()):
                              echo "<option value=$row[emp_id]> $row[emp_name] $row[emp_surname] </option>"; 
                            endwhile
                          ?>
                        </select>
                        
                      </div>
                      
                      <div class="col-md-5 ml-4 mt-1 mb-4">
                        <label>สถานะ</label>
                        <select id="status_select" name="status_select" placeholder=""  class="form-control">
                          <option value="">--ว่าง--</option>
                          <option value="รับเข้าสินค้า">รับเข้า</option>
                          <option value="เบิกออกสินค้า">เบิกออก</option>
                          <option value="ปรับเคลม">เคลม</option>
                          <option value="ปรับลดสินค้า">สินค้าเสียหาย</option>
                          <option value="ปรับเพิ่มสินค้า">สินค้าเกิน</option>
                        </select>
                        
                      </div>
                    
                    <div class="col-md-4 ml-5 mt-4">
                      <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary fas fa-file" name="showname" value="<?php echo $_SESSION['emp_name']," ",$_SESSION['emp_surname'] ?> "> ออกรายงาน</button>
                        <button type="reset" class="btn btn-outline-warning"><i class="fas fa-undo"></i> เคลียข้อมูล</button>
                      </div>
                    </div>
                  </div>
                </form>
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