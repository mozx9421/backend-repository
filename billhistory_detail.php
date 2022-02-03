<?php include('connect.php')?>
<?php
    session_start();

    if(!isset($_SESSION['username'],$_SESSION['emp_level'])){
      echo "<script>
      alert('กรุณาเข้าสู่ระบบก่อน..');
      window.location.replace('login_page.php');
      </script>";
    }

    if (isset($_GET['logout'])){
      session_destroy();
      unset($_SESSION['username'],$_SESSION['emp_level']);
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
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
           <!-- Nav Items -->
           <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="ni ni-tv-2 text-orange"></i>
                <span class="nav-link-text">ภาพรวม</span>
              </a>
            </li>
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
              if($_SESSION['emp_level'] == "ผู้จัดการ" ){
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

  <!-- Main Content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-danger border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar Links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav Toggler -->
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
          </div>
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6">
      <div class="row"><div class="col-xl-1"></div><!-- แทน col-xl-10 center เพราะทับกับ Modal -->
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">

                <div class="table-responsive">
                  

                  <!-- Modal Button -->
                  <table class="table-white col-xl-12">
                    <tr>
                      <td align="left">
                        <div class="col-xl-12"><br>
                          <h6 class="mb-0">รายละเอียด</h6><br>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>

                <!-- Projects Table -->
                <div class="table-responsive table-white table-striped">
                  <table class="table align-items-center table-flush">
                    <tr class="thead-light" align=center>
                      <th><h6 class="text-gray text-ml mb-0">ลำดับ</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">หมายเลขรายการ</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">สถานะ</h6</th>
                      <th><h6 class="text-gray text-ml mb-0">วันเวลาที่รับเข้าสินค้า</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">ผู้รับเข้าสินค้า</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">สินค้า</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">จำนวน</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">หมายเหตุ</h6></th>
                    </tr>
                    <?php
                        $stock_id = $_REQUEST["stock_id"];

                        $querymo = "SELECT * FROM product JOIN stock JOIN emp_data
                        WHERE product.product_id = stock.product_id
                        AND emp_data.emp_id = stock.emp_id
                        AND stock_id LIKE '%$stock_id%'
                        ORDER BY stock_id DESC";

                      $resultmo = mysqli_query($conn, $querymo);

                      include 'DT.php';
                      $x = 1;
                      while($fetch = mysqli_fetch_array($resultmo)){
                        $dateData1 = $fetch['stock_datetime'];
                    ?>
                    <tr align="center">
                        <td><?php echo $x; $x++; ?></td>
                        <td><?php echo $fetch['stock_id']?></td>
                        <?php
                            if($fetch['stock_status'] == 'รับเข้าสินค้า'){
                                echo "<td class='text-success'>";
                            }else if($fetch['stock_status'] == 'เบิกออกสินค้า'){
                                echo "<td class='text-danger'>";
                            }else{
                                echo "<td class='text-info'>";
                            }
                        ?>
                            <?php echo $fetch['stock_status']?>
                        </td>
                        <td><?php echo thai_date_and_time_short(strtotime($dateData1));?></td>
                        <td><?php echo $fetch['emp_name'],"&nbsp&nbsp",$fetch['emp_surname']?></td>
                        <td><?php echo $fetch['product_name']?></td>
                        <td><?php echo $fetch['product_count']?></td>
                        <td>
                            <?php
                                if($fetch['stock_status'] == 'ปรับเพิ่มสินค้า' or $fetch['stock_status'] == 'ปรับลดสินค้า' or $fetch['stock_status'] == 'ปรับเคลม'){
                                    echo $fetch['stock_comment'];
                                }else{
                                    echo "-";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                      }
                    ?>
                    <table class="table">
                        <tr>
                            <td align="left">
                                <br>
                                <a href="billhistory.php">
                                    <button type="button" class="btn btn-outline-primary"><i class="fas fa-reply"></i> ย้อนกลับ</button>
                                </a>
                            </td>
                        </tr>
                    </table>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- Page Content -->
  </div><!-- Main Content -->

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</body>
</html>