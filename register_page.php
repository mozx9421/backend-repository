<?php include('connect.php'); include('runid.php');?>
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

<!--HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>register page</title>
       <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/pingan_icon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  

</head>
<!--body-->
<body class="bg-light">

<?php sleep(1.5); ?>
    <div class="main-wraper">

    <!-- Header -->
    <div class="header bg-gradient-pink py-7 py-lg-4 pt-lg-2">
      <div class="container">
        <div class="header-body text-center mb-9">
          <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-4 col-md-6 px-5">
              <a href="emp.php"> <image src="assets/img/brand/logo.png" type="image/png" height="170px" width="400px"> </a>
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

<!--Content-->
<div class="container mt--9 pb-5 animate-bottom">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-md-4">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
        <h2>ลงทะเบียนพนักงาน</h2>
        <p>กรุณากรอกข้อมูลของท่านลงในฟอร์ม</p>
        <br>
        <form role="form" action="register_db.php" method="post">
            
        <!-- name -->
            <div class="form-group">
                <div class="form-group mb-3">
                <label class="input-group text-default"> ชื่อ - นามสกุล </label>
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div>
                        <input type="text" name="realname"  placeholder="name" class="form-control"  >

                    </div> 
                 </div>
            </div>

        <!--surname-->
            <div class="form-group">
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                            </div>
                            <input type="text" name="surname"  placeholder="surname" class="form-control">
                        </div> 
                    </div>
                </div>

        <!--ID card number-->
            <div class="form-group">
                    <div class="form-group mb-3">
                    <label class="input-group text-default"> เลขบัตรประจำตัวประชาชน </label>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                            </div>
                            <input type="text" name="cardnumber" pattern=".{13}" title="กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครบ 13 หลัก" placeholder="ID card number" class="form-control"  >
                        </div> 
                    </div>
                </div>  
                
        <!--Age-->
        <div class="form-group">
                    <div class="form-group mb-3">
                    <label class="input-group text-default"> อายุ </label>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                            </div>
                            <input type="number" name="age"  min="10" max="80" placeholder="age" class="form-control"required>
                        </div> 
                    </div>
                </div>    
       

        <!-- Gender -->
        <div class="form-group">
                <div class="form-group mb-3">
                <label class="input-group text-default"> เพศ </label>
                    <select name="gender" class="form-control  col-xl-7" required>
                        <option value="">--- โปรดเลือกเพศ ---</option>
                        <option value="ผู้หญิง">หญิง</option>
                        <option value="ผู้ชาย">ชาย</option>
                    </select>
                </div>
            </div>

        <!-- Employee number -->
            <div class = "form-group">
                <div class="form-group mb-3">
                    <!-- <label class = "input-group text-default">หมายเลขพนักงาน</label> -->
                    <input type="text" name="emp_id" class="form-control col-xl-7" value="<?php echo $emp_id; ?>" disabled="disabled"hidden="true">
                    <input type="hidden" value="<?php echo $emp_id; ?>" name="emp_id">
                </div>
            </div>

        <!-- level -->
        <div class="form-group">
                <div class="form-group mb-3">
                <label class="input-group text-default"> ตำเเหน่งงาน </label>
                    <select class="form-control" name="level1">
                        <option value="">--- โปรดเลือกตำเเหน่ง ---</option>
                        <option value="พนักงาน" >พนักงาน</option>
                        <option value="ผู้จัดการ" >ผู้จัดการ</option>
                    </select>
                </div>
            </div>

            <!-- Tel -->
        <div class="form-group">
                        <div class="form-group mb-3">
                        <label class="input-group text-default">เบอร์โทรศัพท์</label>
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="emp_tel" pattern=".{10}" title="กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก" placeholder="Phone number" class="form-control" >
                            </div> 
                        </div>
                    </div>

        <!--Username-->
        <div class="form-group">
                        <div class="form-group mb-3">
                        <label class="input-group text-default">ชื่อผู้ใช้</label>
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" minlength="6" placeholder="username" class="form-control" required title="5 to 10 characters">
                            </div> 
                        </div>
                    </div>

        <!--Password-->
        <div class="form-group">
                    <div class="form-group mb-3">
                    <label class="input-group text-default">รหัสผ่าน</label>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                            </div>
                            <input type="password" name="password1"  placeholder="password" class="form-control" minlength="8" required title="8 to 10 characters">
                        </div> 
                    </div>
                </div>   

                <div class="form-group">
                    <div class="form-group mb-3">
                    <label class="input-group text-default">ยืนยันรหัสผ่าน</label>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                            </div>
                            <input type="password" name="password2"  placeholder="confirm password" class="form-control" minlength="8">
                        </div> 
                    </div>
                </div>  
          


            <div class="form-group">
                <button type="submit" name="regist" class="btn btn-danger ">สมัคร</button>
                <button type="reset" class="btn btn-light " >ล้างข้อมูล</button>
            </div>
            <div align="left">
                <a href="emp.php">
                    <button type="button" class="btn btn-outline-primary"><i class="fas fa-reply"></i> ย้อนกลับ</button>
                </a>
            </div>
        </div>    
    </form>


<script>


</script>
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
</body>
</html>
