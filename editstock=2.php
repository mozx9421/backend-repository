<?php include('connect.php') ?>
<?php
session_start();

if (!isset($_SESSION['username'], $_SESSION['emp_level'])) {
    echo "<script>
      alert('กรุณาเข้าสู่ระบบก่อน..');
      window.location.replace('login_page.php');
      </script>";
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
    <!-- Argon CSS -->
    <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
    <!--Modal-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    <div class="row align-items-center py-4">
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-1"></div><!-- แทน col-xl-10 center เพราะทับกับ Modal -->
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="table-responsive">

                                    <!-- Tabs List -->
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
                                        <?php
                                        if ($_SESSION['emp_level'] == "ผู้จัดการ") {
                                            echo
                                            "<li class='nav-item'>
                          <a class='nav-link active' href='editstock.php'><i class='fas fa-cubes'></i> ปรับสต็อก</a>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link' href='product.php'><i class='fas fa-list'></i> รายการสินค้า</a>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link' href='category.php'><i class='fas fa-adjust'></i> หมวดหมู่</a>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link' href='unit.php'><i class='fas fa-ruler-vertical'></i> หน่วยนับ</a>
                        </li>";
                                        }
                                        ?>
                                    </ul>
                                    <!-- MAIN CONTENT -->
                                    <div class="container">
                                        <br />

                                        <!-- <input type="hidden" name="stock_status" value="เบิกออกสินค้า"><br> -->
                                        <div class="row col-12">
                                            <div class="col-xl-4 ">
                                                วันที่ :
                                                <?php
                                                include('DT.php');
                                                date_default_timezone_set('Asia/Bangkok');
                                                $ddd = date('Y-m-d H:i');
                                                ?>
                                                <input type="text" value="<?php echo thai_date_short(strtotime($ddd)); ?>" class="form-control " disabled="disabled">
                                                <input type="hidden" name="stock_datetime" value="<?php echo thai_date_short(strtotime($ddd)); ?>">
                                            </div>
                                            <div class="col-xl-4 ml-8 ">
                                                ผู้ทำรายการ :
                                                <input type="text" value="<?php echo $_SESSION['emp_name'], " ", $_SESSION['emp_surname'] ?>" class="form-control" disabled>
                                                <input type="hidden" name="emp_id" value="<?php echo $_SESSION['emp_id'] ?>" class="form-control col-xl-6">
                                                <br>
                                            </div>
                                            <div class="col-xl-4">
                                        ตัวเลือก :
                                        <select class="form-control stock_status" id="stock_status "  placeholder=""  onchange="window.location=this.value" required>
                                                                <option value="editstock=2.php">ลดสินค้า</option>
                                                                <option value="editstock=1.php">เพิ่มสินค้า</option>
                                                                <option value="editstock=3.php">เคลมสินค้า</option>
                                                            </select>
                                        <br>
                                        </div>
                                        </div>
                                        <!-- Table data -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="crud_table">
                                                <thead>
                                                    <!-- <th width="5%" class="text-center">ลำดับ</th> -->
                                                    <th width="40%">
                                                        <h6 class="mb-0">สินค้า</h6>
                                                    </th>
                                                    <th width="15%">
                                                        <h6 class="mb-0">จำนวน(เเพ็ค)</h6>
                                                    </th>
                                                    <th width="40%">
                                                        <h6 class="mb-0">หมายเหตุ</h6>
                                                    </th>
                                                    <th width="5%"></th>

                                                </thead>
                                                <tbody class="data_product">
                                                    <input type="hidden" value="<?php echo $_SESSION['emp_id'] ?>" id="emp_id">
                                                    <tr>
                                                        <!-- <td contenteditable="false" align="center" class="runNum">1</td> -->
                                                        <td contenteditable="true">
                                                            <input id="num_product" type="hidden" value="0">
                                                            <select class="form-control product_id" id="product_id_0" name="product_id" placeholder="" required>
                                                                <?php
                                                                $sqlpro = "SELECT * FROM product WHERE product_qty != 0";
                                                                $resultpro = $conn->query($sqlpro);
                                                                echo "<option value='' disabled selected>กรุณาเลือกสินค้า</option>";
                                                                while ($row = $resultpro->fetch_assoc()) :
                                                                    echo "<option value=$row[product_id]> $row[product_id] $row[product_name] </option>";
                                                                endwhile
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td contenteditable="false"><input type="number" value="1" min="1" max="50" class="form-control product_qty" id="product_qty" name="product_qty" required></td>

                                                        <td contenteditable='true'><input type='text' class='form-control stock_comment' id='stock_comment' name='stock_comment'></td>
                                                        <td>
                                                            <div align="center">
                                                                <button type="button" name="add" id="add" class="btn btn-outline-success btn-xs"><i class="fas fa-plus"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <div align="center">
                                                <button type="button" name="save" id="save" class="btn btn-outline-success">บันทึก</button>
                                            </div>
                                            <a href="editstock.php">
                                                <button type="button" class="btn btn-outline-primary"><i class="fas fa-reply"></i> ย้อนกลับ</button>
                                            </a>
                                            <div id="inserted_item_data"></div>


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
                                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            var count = 1;
                                            $('#add').click(function() {
                                                count = count + 1;
                                                var t = parseInt($('#num_product').val())
                                                a = t + 1
                                                var html_code = "<tr id='row" + count + "'>";
                                                html_code += "<td contenteditable='true' ><select class='form-control product_id' id='product_id_" + a + "' name='productID'><option disabled selected value>กรุณาเลือกสินค้า</option><?php
                                                                                                                                                                    $sqlpro = "SELECT * FROM product";
                                                                                                                                                                    $resultpro = $conn->query($sqlpro);
                                                                                                                                                                    while ($row = $resultpro->fetch_assoc()) :
                                                                                                                                                                        echo "<option value=$row[product_id]> $row[product_id] $row[product_name] </option>";
                                                                                                                                                                    endwhile
                                                                                                                                                                    ?></select></td>";
                                                html_code += "<td contenteditable='true'><input type='number' value='1' min='1' max='50' class='form-control product_qty' id='product_qty' name='product_qty' required></td>"
                                                html_code += "<td contenteditable='true'><input type='text'  class='form-control stock_comment' id='stock_comment' name='stock_comment'></td>";
                                                html_code += "<td align=center><button type='button' name='remove' data-row='row" + count + "' class='btn btn-outline-danger btn-xs remove'><i class='fas fa-minus'></i></button></td>";
                                                html_code += "</tr>";
                                                $('#crud_table tbody:last-child').append(html_code);
                                                $('#num_product').val(a)
                                            });

                                            $(document).on('click', '.remove', function() {
                                                var delete_row = $(this).data("row");
                                                $('#' + delete_row).remove();
                                                count = count - 1;
                                            });

                                            $('#save').click(function() {

                                                var data = []
                                                var emp_id = $('#emp_id').val()
                                                var stock_status = 'ปรับลดสินค้า'
                                                var u = 0
                                                var rowCount = $('#crud_table tr').length - 1
                                                var check = 0
                                                $('.data_product tr').each(function(a, b) {

                                                    if ($('.product_qty', b).val() == "" || $('.product_qty', b).val() == 0) {
                                                        alert('กรุณาใส่จำนวน')
                                                        return false
                                                    }else if($('.product_qty', b).val() < 0) {
                                                        alert('จำนวนสินค้าไม่สามารถติดลบได้')
                                                        return false
                                                    } else if ($('.stock_comment', b).val() == "") {
                                                        alert('กรุณาใส่หมายเหตุ')
                                                        return false
                                                    }else if ($('.product_id', b).val() == "" || $('.product_id', b).val() == null) {
                                                        alert('กรุณาเลือกสินค้า')
                                                        check = 1
                                                        return false
                                                    }

                                                    data.push({
                                                        product_id: $('.product_id', b).val(),
                                                        product_qty: $('.product_qty', b).val(),
                                                        stock_comment: $('.stock_comment', b).val(),
                                                        emp_id: emp_id,
                                                        stock_status: stock_status,

                                                    })
                                                    u++
                                                })

                                                if(check != 1){
                                                    if (u == rowCount) {
                                                        $.ajax({
                                                            url: "editstock=2insert.php",
                                                            method: "POST",
                                                            data: {
                                                                data: data
                                                            },
                                                            success: function(data) {
                                                                if(data == 1){
                                                            alert ('บันทึกการลดสินค้าสำเร็จ')
                                                            window.location.replace('editstock.php')
                                                             }
                                                            else{
                                                                alert ('สินค้าในคลังมีจำนวนน้อยกว่ารายการที่เลือก โปรดลองอีกครั้ง')
                                                            }
                                                            }
                                                        })
                                                    }
                                                }

                                            })
                                        });
                                        $(document).on('change', '.product_id', function(e) {
                                            var data = e.currentTarget.value
                                            const test = [];
                                            $('.data_product tr').each(function(a, b) {
                                                if($('.product_id', b).val()){
                                                    test.push($('.product_id', b).val());
                                                }
                                            })

                                            $(test).each(function (a, b) { //2
                                                for (let i = 0; i < test.length; i++) { //2
                                                    if(a != i){ 
                                                        if(b == test[i]){
                                                            alert('ไม่สามารถเลือกสินค้านี้ได้')
                                                            $('#'+e.currentTarget.id).val('')
                                                            return false
                                                        }

                                                    }
                                                }
                                            }) 
                                        });
                                    </script>
</body>

</html>