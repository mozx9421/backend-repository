<?php include('connect.php') ?>
<?php
session_start();

if (!isset($_SESSION['username'], $_SESSION['emp_level'])) {
  echo "<script>
      alert('กรุณาเข้าสู่ระบบก่อน..');
      window.location.replace('login_page.php');
      </script>";
}

//Change default password for first time login.
$otpcheck = $_SESSION['username'];
$sqlotp = "SELECT otp FROM emp_data WHERE emp_username ='$otpcheck'";
$resultotp = mysqli_query($conn, $sqlotp);
while ($rowotp = mysqli_fetch_array($resultotp)) {
  if ($rowotp['otp'] == "no") {
    echo "<script>
  alert('เข้าสู่ระบบครั้งเเรกกรุณาเปลี่ยนรหัสผ่าน');
  window.location.replace('firsttime_login.php');
</script>";
  }
}



if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username'], $_SESSION['emp_level']);
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
        <a class="mr-4" <?php
                        if ($_SESSION['emp_level'] == "พนักงาน") {
                        ?> href="index_employee.php" <?php
                                                            } else {
                                                              ?> href="index_manager.php" <?php
                                                                                        } ?>>
          <img src="assets/img/brand/logo.png" width="175" height="75" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <?php
            if ($_SESSION['emp_level'] == "ผู้จัดการ") { ?>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="ni ni-tv-2 text-orange"></i>
                  <span class="nav-link-text">ภาพรวม</span>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link active">
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
            <?php
            if ($_SESSION['emp_level'] == "ผู้จัดการ") {
              echo
              "<li class='nav-item'>
                  <a class='nav-link' href='emp.php'>
                    <i class='ni ni-single-02 text-orange'></i>
                    <span class='nav-link-text'>พนักงาน</span>
                  </a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='report.php'>
                    <i class='fas fa-paste text-orange'></i>
                    <span class='nav-link-text'>รายงาน</span>
                  </a>
                </li>";
            }
            ?>
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
                <span class="nav-link-text">คู่มือ</span>
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
                  <span class="mb-0 text-sm text-light">ชื่อผู้ใช้ : <?php echo $_SESSION['emp_name'], " ", $_SESSION['emp_surname'] ?></span>
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
          <div class="fetch align-items-center py-4">
            <div class="col-lg-2 col-7">
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    //  $perpage = 5;
    //  if (isset($_GET['page'])) {
    //  $page = $_GET['page'];
    //  } else {
    //  $page = 1;
    //  }

    //  $start = ($page - 1) * $perpage;

    //  $sql = "SELECT * FROM product 
    //  JOIN stock ON  product.product_id = stock.product_id
    //  JOIN emp_data ON emp_data.emp_id = stock.emp_id
    //  GROUP BY stock_id
    //  ORDER BY stock_datetime DESC limit {$start} , {$perpage} ";
    //  $query = mysqli_query($con, $sql);
    ?>
    <!-- Content -->
    <div class="container-fluid mt--6 animate-bottom">
      <div class="fetch">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="fetch align-items-center">
                <div class="col-xl-12">
                  <h5 class="mb-0">รายละเอียด</h5>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <form action="billhistory.php" method="post">
                <!-- SearchText -->
                <form class="navbar-search navbar-search-light form-inline mr-sm-5" id="navbar-search-main">
                  <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                      <!-- <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div> -->
                      <!-- <input class="form-control" placeholder="&nbsp&nbsp ค้นหารายการ" type="text" id="txtKeyword" name="txtKeyword"> -->
                    </div>
                  </div>
                  <button name="search" class="close" type="submit"></button>
                </form><br>
                <div class="table-responsive">
                  <table class="table bg-light table table-bordered">
                    <tr>
                      <th>ลำดับที่</th>
                      <th>รหัสรายการสินค้า</th>
                      <th>สถานะรายการ</th>
                      <th>วันที่</th>
                      <th>ผู้ทำรายการ</th>
                      <th>ตัวเลือก</th>
                    </tr>
                    <?php if (isset($_POST['search'])) {
                      $txtKeyword = $_POST['txtKeyword'];
                      if ($txtKeyword != "") {
                    ?>
                        <?php
                        //error_reporting(E_ALL ^ E_NOTICE);
                        $query = "SELECT * FROM stock
                      JOIN product ON product.product_id = stock.product_id
                      JOIN emp_data ON emp_data.emp_id = stock.emp_id
                      WHERE (stock_id LIKE '%" . $_POST["txtKeyword"] . "%'
                      or stock_status LIKE '%" . $_POST["txtKeyword"] . "%'
                      or stock_datetime LIKE '%" . $_POST["txtKeyword"] . "%'
                      or emp_name LIKE '%" . $_POST["txtKeyword"] . "%'
                      or emp_surname LIKE '%" . $_POST["txtKeyword"] . "%' ) 
                      GROUP BY stock_id";

                        include 'DT.php';
                        $result = mysqli_query($conn, $query);
                        @$i++;
                        while ($fetch = mysqli_fetch_array($result)) {
                          $dateData = $fetch['stock_datetime'];
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetch['stock_id']; ?></td>
                            <td><?php echo $fetch['stock_status']; ?></td>
                            <td><?php echo thai_date_and_time_short(strtotime($dateData)); ?></td>
                            <td><?php echo $fetch['emp_name'], "&nbsp&nbsp&nbsp", $fetch['emp_surname']; ?></td>
                            <td>
                              <a href="billhistory_detail.php?stock_id=<?php echo $fetch['stock_id'] ?>">
                                <button type="button" class="btn btn-outline-primary btn-sm text-black">
                                  <span><i class="fas fa-list"></i> รายละเอียด</span>
                                </button>
                              </a>
                            </td>
                          </tr>
                        <?php $i++;
                        }
                      } else {
                        $query = "SELECT stock_id,stock_status,stock_datetime,emp_id FROM stock
                        JOIN product ON product.product_id = stock.product_id
                        JOIN emp_data ON emp_data.emp_id = stock.emp_id GROUP BY stock_id";

                        $result = mysqli_query($conn, $query);
                        @$i = 1;
                        while ($fetch = mysqli_fetch_array($result)) {
                          $dateData = $fetch['stock_datetime'];
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetch['stock_id']; ?></td>
                            <td><?php echo $fetch['stock_status']; ?></td>
                            <td><?php echo thai_date_and_time_short(strtotime($dateData)); ?></td>
                            <td><?php echo $fetch['emp_name'], "&nbsp&nbsp&nbsp", $fetch['emp_surname']; ?></td>
                            <td>
                              <a href="billhistory_detail.php?stock_id=<?php echo $fetch['stock_id'] ?>">
                                <button type="button" class="btn btn-outline-primary btn-sm text-black">
                                  <span><i class="fas fa-list"></i> รายละเอียด</span>
                                </button>
                              </a>
                            </td>
                          </tr>
                        <?php $i++;
                        }
                      }
                    } else {
                      $perpage = 10;
                      
                      if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        
                      } else {
                        $page = 1;
                        
                      }
                      $start = ($page - 1) * $perpage;




                      $query = "SELECT * FROM product 
                        JOIN stock ON  product.product_id = stock.product_id
                        JOIN emp_data ON emp_data.emp_id = stock.emp_id
                        GROUP BY stock_id
                        ORDER BY stock_datetime DESC limit {$start} , {$perpage} ";
                      include 'DT.php';
                      $result = mysqli_query($conn, $query);
                      @$i = 1;
                      while ($fetch = mysqli_fetch_array($result)) {

                        $dateData = $fetch['stock_datetime'];
                        ?>
                        <tr>
                          <td><?php $start++;
                              echo $start; ?></td>
                          <td><?php echo $fetch['stock_id']; ?></td>
                          <td><?php echo $fetch['stock_status']; ?></td>
                          <td><?php echo thai_date_and_time_short(strtotime($dateData)); ?></td>
                          <td><?php echo $fetch['emp_name'], "&nbsp&nbsp&nbsp", $fetch['emp_surname']; ?></td>
                          <td>
                            <a href="billhistory_detail.php?stock_id=<?php echo $fetch['stock_id'] ?>">
                              <button type="button" class="btn btn-outline-primary btn-sm text-black">
                                <span><i class="fas fa-list"></i> รายละเอียด</span>
                              </button>
                            </a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                    <!-- <div id="result"></div> -->
                  </table>
                  <?php
                  $sql2 = "SELECT * FROM product 
                  JOIN stock ON  product.product_id = stock.product_id
                  JOIN emp_data ON emp_data.emp_id = stock.emp_id
                  GROUP BY stock_id
                  ORDER BY stock_datetime DESC";
                  $query2 = mysqli_query($conn, $sql2);
                  $total_record = mysqli_num_rows($query2);
                  $total_page = ceil($total_record / $perpage);
                  $previous_page = $page - 1;
                  $next_page = $page + 1;
                  if($previous_page === 0){
                    $previous_page = 1;
                  } else if($next_page > $total_page){
                    $next_page = $total_page;
                  }else{
                  $previous_page = $page - 1;
                  $next_page = $page + 1;
                  }
                  ?>
                </div>
            </div>
            </form>
          </div>
          <nav aria-label="Page navigation example mb-4">
            <div class="container-fluid mt--2">
              <ul class="nav nav-pills nav-pills-circle">
              <li class="page-item">
                  <a class="page-link" href="billhistory.php?page=1" aria-label="Frist">
                    <span class="fas fa-angle-double-left"></span>
                    <span class="sr-only">Frist</span>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="billhistory.php?page=<?= $previous_page; ?>" aria-label="Previous">
                    <span class="fas fa-angle-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <?php for ($it = 1; $it <= $total_page; $it++) { ?>
                  <li class="page-item"><a class="page-link" href="billhistory.php?page=<?php echo $it; ?>"><?php echo $it; ?></a></li>
                <?php } ?>
                <li class="page-item">
                  <a class="page-link" href="billhistory.php?page=<?= $next_page; ?>" aria-label="Next">
                    <span class="fas fa-angle-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="billhistory.php?page=<?php echo $total_page; ?>" aria-label="Last">
                    <span class="fas fa-angle-double-right"></span>
                    <span class="sr-only">Last</span>
                  </a>
                </li>
              </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>