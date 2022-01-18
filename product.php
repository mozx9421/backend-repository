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
              <a class="nav-link active">
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
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row"><div class="col-xl-1"></div><!-- แทน col-xl-10 center เพราะทับกับ Modal -->
        <div class="col-xl-10">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <!-- Tabs List -->
                <div class="table-responsive">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" href="warehouse.php"><i class="fas fa-warehouse"></i> สินค้าคงคลัง</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="stock_in.php"><i class="fas fa-file-import"></i> รับเข้าสินค้า</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="stock_out.php"><i class="fas fa-file-export"></i> เบิกสินค้า</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="editstock.php"><i class="fas fa-cubes"></i> ปรับสต็อก</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active"><i class="fas fa-list"></i> รายการสินค้า</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="category.php"><i class="fas fa-adjust"></i> หมวดหมู่</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="unit.php"><i class="fas fa-ruler-vertical"></i> หน่วยนับ</a>
                    </li>
                  </ul>
                  <!-- Modal Button -->
                  <table class="table-white col-xl-12 animate-left">
                    <tr>
                      <td align="left">
                        <div class="col-xl-12"><br>
                          <h4>สินค้า</h4>
                        </div>
                      </td>
                      <td align="right">
                        <div class="col-xl-12">
                          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#product_add_modal">
                            <span><i class="fas fa-plus"></i> เพิ่มรายการ</span>  
                          </button>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                <!-- Projects table -->
                <div class="table-responsive table-white table-striped animate-right">
                  <table class="table align-items-center table-flush ">
                    <tr class="thead-light" align="center">
                      <th><h6 class="text-gray text-ml mb-0">ลำดับ</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">รหัสสินค้า</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">ชื่อ</h6</th>
                      <th><h6 class="text-gray text-ml mb-0">หมวดหมู่</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">หน่วยนับหลัก(ย่อย)</h6></th>
                      <th><h6 class="text-gray text-ml mb-0">ตัวเลือก</h6></th>
                    </tr>
                    <?php
                      require 'connect.php';
                        $query = mysqli_query($conn, "SELECT * FROM product JOIN unit JOIN category
                        WHERE product.unit_id = unit.unit_id
                        AND product.ctg_id = category.ctg_id
                        ORDER BY product_id ASC") or die(mysqli_error());
                      $x = 1;
                      while($fetch = mysqli_fetch_array($query)){
                    ?>
                      <tr align="center">
                        <td><?php echo $x; $x++; ?></td>
                        <td><?php echo $fetch['product_id']?></td>
                        <td><?php echo $fetch['product_name']?></td>
                        <td><?php echo $fetch['ctg_name']?></td>
                        <td><?php echo $fetch['unit_name']?></td>
                        <td>
                          <!-- Update Button -->
                          <button type="button" class="btn btn-outline-warning btn-sm text-black" data-toggle="modal" data-target="#product_update_modal<?php echo $fetch['product_id']?>">
                            <span><i class="far fa-edit"></i> แก้ไข</span>
                          </button>
                          <!-- Delete Button -->
                          <a href="product_delete.php?product_id=<?php echo $fetch['product_id']?>"
                            <?php
                              echo "onclick=\"return confirm('คุณต้องการลบข้อมูลนี้ใช้หรือไม่')\" ";
                            ?>
                          >
                            <button class='btn btn-outline-danger btn-sm'><span><i class="far fa-trash-alt"></i> ลบ</span></button>
                          </a>
                        </td>
                      </tr>
                      <?php
                        include 'product_update.php';
                        }
                      ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Add -->
        <div class="modal fade" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">เพิ่มรายการสินค้า</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="product.php" class="was-validated">
                  <?php
                  include('connect.php'); 
                    // $connect = new mysqli('localhost', 'root', '', 'backend_db');
                    // if ($connect->connect_error){
                    //   die("Something wrong.: " . $connect->connect_error);
                    // }
                      $sqlcat = "SELECT * FROM category";
                      $resultcat = $conn->query($sqlcat);
                      $sqlunit = "SELECT * FROM unit";
                      $resultunit = $conn->query($sqlunit);
                  ?>
                  <?php require('runid.php'); ?>
                  <?php require('product_duplicate_name.php'); ?>
                  <table class="col-xl-9 center">
                    <tr>
                      <td align="right">รหัสสินค้า : &nbsp</td>
                      <td>
                        <input type="text" name="product_id" value="<?php echo $product_id; ?>" class="form-control" disabled='disabled'>
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td align="right">ชื่อสินค้า : &nbsp</td>
                      <td>
                        <input type="text" name="product_name" class="form-control" required>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">หมวดหมู่ : &nbsp</td>
                      <td>
                        <select name="ctg_id" class="form-control" required>
                          <option value="" selected>เลือกหมวดหมู่</option>
                            <?php while($row = $resultcat->fetch_assoc()):
                              echo "<option value=$row[ctg_id]> $row[ctg_name] </option>"; 
                            endwhile ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">หน่วยของวัตถุดิบ : &nbsp</td>
                      <td>
                        <select name="unit_id" class="form-control" required>
                          <option value="" selected>เลือกหน่วยของวัตถุดิบ</option>
                            <?php while($row = $resultunit->fetch_assoc()):
                              echo "<option value=$row[unit_id]> $row[unit_name] </option>"; 
                            endwhile ?>
                        </select>
                      </td>
                    </tr>
                  </table><br>
                  <center>
                    <button type="submit" class= "btn btn-outline-success" name="save">บันทึก</button>
                    <button type="reset" class="btn btn-outline-warning" name="reset">เคลีย</button>
                  </center>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ปิด</button>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
