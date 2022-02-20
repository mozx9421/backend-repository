<?php include('connect.php') ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
  echo "<script>
      alert('กรุณาเข้าสู่ระบบก่อน..');
      window.location.replace('login_page.php');
      </script>";
}

if (isset($_GET['logout'])) {
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
  <title>ภาพรวม</title>
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
  <style>
    .alert {
      padding: 20px;
      background-color: #FF8333;
      color: white;
      box-shadow: 2px 4px;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }
  </style>
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" <?php
                                if ($_SESSION['emp_level'] == "พนักงาน") {
                                ?> href="index_employee.php" <?php
                                                            } else {
                                                              ?> href="index_manager.php" <?php
                                                                                        } ?>>
          <img src="assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active">
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
            <br>
            <li class="nav-item">
              <a class="nav-link" a href="index_manager.php?logout='1'">
                <i class="fas fa-sign-out-alt text-orange"></i>
                <span class="nav-link-text">ออกจากระบบ</span>
              </a>
            </li>
            <br>
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
    <div class="header bg-gradient-danger pb-6 ">
      <div class="container-fluid">
        <div class="header-body">
          <div class="header bg-danger pb-6">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">ภาพรวม</h6>
                  </div>
                  <?php
                  $round = 0;
                  $sqlcheck = 'SELECT product_qty FROM product';
                  $resultcheck = mysqli_query($conn, $sqlcheck);
                  while ($rowcheck = $resultcheck->fetch_assoc()) {
                    $rowcheckqty = $rowcheck['product_qty'];

                    if ($round == 0) {
                      if ($rowcheckqty > 0 && $rowcheckqty < 20) { ?>
                        <div class="alert col-md-4 ml-10 animate-left">
                          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                          <strong>เเจ้งเตือน:</strong> ปริมาณสินค้าในคลังเหลือน้อย
                        </div>
                  <?php
                        $round = 1;
                      }
                    }
                  }
                  // }
                  ?>
                </div>
                <div class="" align="right">
                <a href="dashboard.php"><button type="button" class="mb-2 mr-2 btn btn-primary btn-sm" >7 วัน</button></a>
                <button type="button" class="mb-2 mr-2 btn btn-secondary btn-sm" >30 วัน</button>
                <a href="dashboard3.php"><button type="button" class="mb-2 mr-2 btn btn-primary btn-sm" >1 ปี </button></a>
                </div>
              </div>
            </div>
          </div>
          <!-- Page content -->
          <div class="container-fluid mt--6 animate-right">
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header bg-transparent ">
                    <div class="row align-items-center">
                      <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">PingAn</h6>
                        <h4 class="card-title text-uppercase mb-0">จำนวนสินค้า(แพ็ค)ใน 30 วันที่ผ่านมา</h4>
                        <div class="" align="right">
                          <i style="color:rgba(75, 192, 192)"><i class="fas fa-square"></i></i> รับเข้า
                          <i style="color:rgba(255, 128, 0)"><i class="fas fa-square"></i></i> เบิกออก
                          <i style="color:rgba(204, 0, 0)"><i class="fas fa-square"></i></i> เคลม
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                      <canvas id="chart-bars2"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <center>
                          <h5 class="card-title text-uppercase text-muted mb-0">จำนวนรับเข้าสินค้าทั้งหมด</h5>
                          <?php
                          $result1 = mysqli_query($conn, "SELECT SUM(product_count) FROM stock
                            WHERE `stock_id` LIKE 'R%'
                            AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)");
                          $row1 = mysqli_fetch_array($result1);
                          $total1 = $row1[0];
                          ?>
                          <span class="h3 font-weight-bold mb-0"><?php echo $total1; ?></span> <span class="h5 text-muted mb-0">แพ็ค</span>
                        </center>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="fas fa-box-open"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <center>
                          <h5 class="card-title text-uppercase text-muted mb-0">จำนวนเบิกออกสินค้าทั้งหมด</h5>
                          <?php
                          $result2 = mysqli_query($conn, "SELECT SUM(product_count) FROM stock WHERE `stock_id` LIKE 'T%'
                            AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)");
                          $row2 = mysqli_fetch_array($result2);
                          $total2 = $row2[0];
                          ?>
                          <span class="h3 font-weight-bold mb-0"><?php echo $total2; ?></span> <span class="h5 text-muted mb-0">แพ็ค</span>
                        </center>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="fas fa-cube"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <center>
                          <h5 class="card-title text-uppercase text-muted mb-0">จำนวนสินค้าคงเหลือทั้งหมด</h5>
                          <?php $total3 = $total1 - $total2; ?>
                          <span class="h3 font-weight-bold mb-0"><?php echo $total3; ?></span> <span class="h5 text-muted mb-0">แพ็ค</span>
                        </center>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                          <i class="fas fa-boxes"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="row align-items-center mb-2">
                      <div class="col-auto">
                        <h6 class="mb-0 mt-2">สินค้า"รับเข้า"มากสุด(แพ็ค)</h6>
                      </div>
                      <div class="col text-right">
                        <button type="button" class="btn btn-outline-primary btn-sm text-black mt-1" data-toggle="modal" data-target="#see_all_in">ดูทั้งหมด</button>
                        <?php include 'see_all_in.php'; ?>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th>
                            <h6 class="mb-0">ชื่อสินค้า</h6>
                          </th>
                          <th>
                            <h6 class="mb-0" align="center">จำนวน</h6>
                          </th>
                        </tr>
                      </thead>
                      <?php
                      $sql = "SELECT product.product_id, product.product_name, SUM(stock.product_count) AS product_count FROM stock JOIN product
                        WHERE product.product_id = stock.product_id
                        AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
                        AND stock_id LIKE 'R%'
                        GROUP BY product_name
                        ORDER BY product_count DESC";
                      $result = mysqli_query($conn, $sql);
                      $n = 1;
                      while ($n <= 3 && $row = mysqli_fetch_array($result)) {
                      ?>
                        <tbody>
                          <tr>
                            <td><?php echo $row['product_name'] ?></td>
                            <td align="center"><?php echo $row['product_count']; ?></td>
                          </tr>
                        <?php $n++;
                      } ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="row align-items-center mb-2">
                      <div class="col-auto">
                        <h6 class="mb-0 mt-2">สินค้า"เบิกออก"มากสุด(แพ็ค)</h6>
                      </div>
                      <div class="col text-right">
                        <button type="button" class="btn btn-outline-primary btn-sm text-black mt-1" data-toggle="modal" data-target="#see_all_out">ดูทั้งหมด</button>
                        <?php include 'see_all_out.php'; ?>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>
                            <h6 class="mb-0">ชื่อสินค้า</h6>
                          </th>
                          <th>
                            <h6 class="mb-0" align="center">จำนวน</h6>
                          </th>
                        </tr>
                      </thead>
                      <?php
                      $sql = "SELECT product.product_id, product.product_name, SUM(stock.product_count) AS product_count FROM stock JOIN product
                        WHERE product.product_id = stock.product_id
                        AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
                        AND stock_id LIKE 'T%'
                        GROUP BY product_name
                        ORDER BY product_count DESC";
                      $result = mysqli_query($conn, $sql);
                      $n = 1;
                      while ($n <= 3 && $row = mysqli_fetch_array($result)) {
                      ?>
                        <tbody>
                          <tr>
                            <td><?php echo $row['product_name'] ?></td>
                            <td align="center"><?php echo $row['product_count']; ?></td>
                          </tr>
                        <?php $n++;
                      } ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="row align-items-center mb-2">
                      <div class="col-auto">
                        <h6 class="mb-0 mt-2">สินค้า"เสียหาย"มากสุด(แพ็ค)</h6>
                      </div>
                      <div class="col text-right">
                        <button type="button" class="btn btn-outline-primary btn-sm text-black mt-1" data-toggle="modal" data-target="#see_all_damage">ดูทั้งหมด</button>
                        <?php include 'see_all_damage.php'; ?>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>
                            <h6 class="mb-0">ชื่อสินค้า</h6>
                          </th>
                          <th>
                            <h6 class="mb-0" align="center">จำนวน</h6>
                          </th>
                        </tr>
                      </thead>
                      <?php
                      $sql = "SELECT product.product_id, product.product_name, SUM(stock.product_count) AS product_count FROM stock JOIN product
                        WHERE product.product_id = stock.product_id
                        AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
                        AND stock_id LIKE 'D%'
                        GROUP BY product_name
                        ORDER BY product_count DESC";
                      $result = mysqli_query($conn, $sql);
                      $n = 1;
                      while ($n <= 3 && $row = mysqli_fetch_array($result)) {
                      ?>
                        <tbody>
                          <tr>
                            <td><?php echo $row['product_name'] ?></td>
                            <td align="center"><?php echo $row['product_count']; ?></td>
                          </tr>
                        <?php $n++;
                      } ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <center>
                        <h5 class="card-title text-uppercase text-muted mb-0">จำนวนเคลมสินค้าทั้งหมด</h5>
                        <?php
                        $result1 = mysqli_query($conn, "SELECT SUM(product_count) FROM stock
                            WHERE `stock_id` LIKE 'C%'
                            AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)");
                        $row1 = mysqli_fetch_array($result1);
                        $total1 = $row1[0];
                        ?>
                        <span class="h3 font-weight-bold mb-0"><?php echo $total1; ?></span> <span class="h5 text-muted mb-0">แพ็ค</span>
                      </center>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="fas fa-box-open"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="row align-items-center mb-2">
                      <div class="col-auto">
                        <h6 class="mb-0 mt-2">สินค้า"เคลม"มากสุด (แพ็ค)</h6>
                      </div>
                      <div class="col text-right">
                        <button type="button" class="btn btn-outline-primary btn-sm text-black mt-1" data-toggle="modal" data-target="#see_all_claim">ดูทั้งหมด</button>
                        <?php include 'see_all_claim.php'; ?>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th>
                            <h6 class="mb-0">ชื่อสินค้า</h6>
                          </th>
                          <th>
                            <h6 class="mb-0" align="center">จำนวน</h6>
                          </th>
                        </tr>
                      </thead>
                      <?php
                      $sql = "SELECT product.product_id, product.product_name, SUM(stock.product_count) AS product_count FROM stock JOIN product
                        WHERE product.product_id = stock.product_id
                        AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
                        AND stock_id LIKE 'C%'
                        GROUP BY product_name
                        ORDER BY product_count DESC";
                      $result = mysqli_query($conn, $sql);
                      $n = 1;
                      while ($n <= 3 && $row = mysqli_fetch_array($result)) {
                      ?>
                        <tbody>
                          <tr>
                            <td><?php echo $row['product_name'] ?></td>
                            <td align="center"><?php echo $row['product_count']; ?></td>
                          </tr>
                        <?php $n++;
                      } ?>
                        </tbody>
                    </table>
                  </div>
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
  <script src="assets/js/components/charts/chart-line.js"></script>
  <!-- <script src="assets/js/components/charts/chart-bars.php"></script> -->
  <?php include('chart-bars.php') ?>
</body>

</html>