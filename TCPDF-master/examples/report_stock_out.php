<?php
  include '../../connect.php';
  
  ?>
<?php
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {
  public function Header() {
        include '../../connect.php';

        //function for convert date to thai
        
        //
        //variable 
        //
        if($_POST['from_date']!="" && $_POST['to_date']!=""){
          $from_date = @$_POST['from_date']; 
          $to_date = @$_POST['to_date'];
        }
        else {
          $from_date ="";
          $to_date ="";
        }
        
        // $to_date = @$_POST['to_date'];
        $product_select =@$_POST['product_select'];
        $emp_select =@$_POST['emp_select'];
        $status_select = @$_POST['status_select'];
        $sql_emp = "SELECT emp_name,emp_surname FROM emp_data WHERE emp_id LIKE '%".$emp_select."%'"; 
        $sql_status = "SELECT stock_status FROM stock WHERE stock_status LIKE '%".$status_select."%'"; 
        $sql_product = "SELECT product_name FROM product WHERE product_id LIKE '%".$product_select."%'"; 
        $result_product = mysqli_query($conn, $sql_product);
        $result_emp = mysqli_query($conn, $sql_emp);
        $result_status = mysqli_query($conn, $sql_status);

        // Condition
        //
        //1.isset all
    if($from_date != "" && $to_date != "" && $product_select!="" && $emp_select!="" && $status_select!=""){
      require_once 'DT2.php';
      while ($row = $result_emp->fetch_assoc()) {
        $emp_nameheader =  $row['emp_name'];
        $emp_surnameheader =  $row['emp_surname'];
      }
      while ($row = $result_product->fetch_assoc()) {
        $product_nameheader =  $row['product_name'];
      }
      while ($row = $result_status->fetch_assoc()) {
        $status_nameheader =  $row['stock_status'];
      }
       $from_date_con = DateThai($from_date);
       $to_date_con = DateThai($to_date);
       if($status_select=="ปรับเพิ่มสินค้า"){
        $txt2 = <<<EOD
        ระหว่างวันที่ $from_date_con ถึง $to_date_con 
        สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
      EOD;
      }else if($status_select=="ปรับลดสินค้า"){
        $txt2 = <<<EOD
        ระหว่างวันที่ $from_date_con ถึง $to_date_con 
        สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
      EOD;
      }else if($status_select=="ปรับเคลม"){
        $txt2 = <<<EOD
        ระหว่างวันที่ $from_date_con ถึง $to_date_con 
        สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
      EOD;
      }else{
        $txt2 = <<<EOD
        ระหว่างวันที่ $from_date_con ถึง $to_date_con 
        สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
      EOD;
      }
        }
         //2.empty
         else if($from_date == "" && $to_date == "" && $product_select=="" && $emp_select=="" && $status_select==""){
          // $from_date_con = DateThai($from_date);
          // $to_date_con = DateThai($to_date);
           $txt2 = <<<EOD
         EOD;
       }
        //3.วันอย่างเดียว
        else if($from_date != "" && $to_date != "" && $product_select=="" && $emp_select=="" && $status_select==""){
          require_once 'DT2.php';
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
            $txt2 = <<<EOD
            ข้อมูลระหว่างวันที่ $from_date_con ถึง $to_date_con 
          EOD;
        }
        //4.วันกับสินค้า
        else if($from_date != "" && $to_date != "" && $product_select!="" && $emp_select=="" && $status_select==""){
          require_once 'DT2.php';
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
            $txt2 = <<<EOD
            ข้อมูลระหว่างวันที่ $from_date_con ถึง $to_date_con
            สินค้า: $product_nameheader 
          EOD;
        }
        //5.วันกับพนง
        else if($from_date != "" && $to_date != "" && $emp_select!="" && $product_select=="" && $status_select==""){
          require_once 'DT2.php';
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
            $txt2 = <<<EOD
            ข้อมูลระหว่างวันที่ $from_date_con ถึง $to_date_con
            พนักงาน:$emp_nameheader $emp_surnameheader
          EOD;
        }
        //6.วันกับสถานะ
        else if($from_date != "" && $to_date != "" && $status_select!="" && $product_select=="" && $emp_select==""){
          require_once 'DT2.php';
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
           if($status_select=="ปรับเพิ่มสินค้า"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
          EOD;
          }else if($status_select=="ปรับลดสินค้า"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
          EOD;
          }else if($status_select=="ปรับเคลม"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
          EOD;
          }else{
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
          EOD;
          }
        }
        //7.วันกับสินค้ากับพนง
        else if($from_date != "" && $to_date != "" && $emp_select!="" && $product_select!="" && $status_select==""){
          require_once 'DT2.php';
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
            $txt2 = <<<EOD
            ข้อมูลระหว่างวันที่ $from_date_con ถึง $to_date_con
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
        }
        //8.วันกับสินค้ากับสถานะ
        else if($from_date != "" && $to_date != "" && $product_select!="" && $status_select!="" && $emp_select==""){
          require_once 'DT2.php';
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);

            if($status_select=="ปรับเพิ่มสินค้า"){
              $txt2 = <<<EOD
              ระหว่างวันที่ $from_date_con ถึง $to_date_con 
              สินค้า: $product_nameheader 
            EOD;
            }else if($status_select=="ปรับลดสินค้า"){
              $txt2 = <<<EOD
              ระหว่างวันที่ $from_date_con ถึง $to_date_con 
              สินค้า: $product_nameheader 
            EOD;
            }else if($status_select=="ปรับเคลม"){
              $txt2 = <<<EOD
              ระหว่างวันที่ $from_date_con ถึง $to_date_con 
              สินค้า: $product_nameheader 
            EOD;
            }else{
              $txt2 = <<<EOD
              ระหว่างวันที่ $from_date_con ถึง $to_date_con 
              สินค้า: $product_nameheader  
            EOD;
            }
        }
        //9.วันกับพนงกับสถานะ
        else if($from_date != "" && $to_date != "" && $emp_select!="" && $status_select!="" && $product_select==""){
          require_once 'DT2.php';
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
           $from_date_con = DateThai($from_date);
           $to_date_con = DateThai($to_date);
           if($status_select=="ปรับเพิ่มสินค้า"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else if($status_select=="ปรับลดสินค้า"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else if($status_select=="เคลม"){
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else{
            $txt2 = <<<EOD
            ระหว่างวันที่ $from_date_con ถึง $to_date_con 
            พนักงาน: $emp_nameheader $emp_surnameheader 
          EOD;
          }
        }
        //10.สินค้าอย่างเดียว
        else if($product_select != "" && $to_date == "" && $from_date=="" && $status_select=="" && $emp_select==""){
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
            $txt2 = <<<EOD
            สินค้า: $product_nameheader 
          EOD;
        }
        //11.สินค้ากับพนง
        else if($product_select != "" && $emp_select != "" && $from_date=="" && $to_date=="" && $status_select==""){
          require_once 'DT2.php';
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
            $txt2 = <<<EOD
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
        }
        //12.สินค้ากับสถานะ
        else if($product_select != "" && $status_select != "" && $from_date=="" && $to_date=="" && $emp_select==""){
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
          if($status_select=="ปรับเพิ่มสินค้า"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader 
          EOD;
          }else if($status_select=="ปรับลดสินค้า"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader 
          EOD;
          }else if($status_select=="ปรับเคลม"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader 
          EOD;
          }else{
            $txt2 = <<<EOD
            สินค้า: $product_nameheader 
          EOD;
          }
        }
        //13.พนงอย่างเดียว
        else if($emp_select != "" && $status_select == "" && $from_date=="" && $to_date=="" && $product_select==""){  
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
            $txt2 = <<<EOD
            พนักงาน: $emp_nameheader $emp_surnameheader 
          EOD;
        }
        //14.พนงกับสถานะ
        else if($emp_select != "" && $status_select != "" && $from_date=="" && $to_date=="" && $product_select==""){  
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
          if($status_select=="ปรับเพิ่มสินค้า"){
            $txt2 = <<<EOD
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else if($status_select=="ปรับลดสินค้า"){
            $txt2 = <<<EOD
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else if($status_select=="ปรับเคลม"){
            $txt2 = <<<EOD
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else{
            $txt2 = <<<EOD
            พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }
        }
        //15.สินค้ากับสถานะกับพนง
        else if($product_select != "" && $status_select != "" && $emp_select!="" && $from_date=="" && $to_date=="" ){
          while ($row = $result_product->fetch_assoc()) {
            $product_nameheader =  $row['product_name'];
          }
          while ($row = $result_emp->fetch_assoc()) {
            $emp_nameheader =  $row['emp_name'];
            $emp_surnameheader =  $row['emp_surname'];
          }
          if($status_select=="ปรับเพิ่มสินค้า"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader 
          EOD;
          }else if($status_select=="ปรับลดสินค้า"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else if($status_select=="ปรับเคลม"){
            $txt2 = <<<EOD
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }else{
            $txt2 = <<<EOD
            สินค้า: $product_nameheader พนักงาน: $emp_nameheader $emp_surnameheader
          EOD;
          }
        }
        else{
            $txt2 = <<<EOD
        EOD;
        }
    $this->Image('images/logo.jpg', 5, 3,50, 20, 'JPG', '', 'F', false, 1, '', false, false, 0, false, false, false);
    $this->SetFont('thsarabun', 'B', 20);
    $to_date;
    $from_date;
    $to_date = $_POST['to_date'];
    $from_date = $_POST['from_date'];
   
      if($status_select=="รับเข้าสินค้า" or $status_select=="เบิกออกสินค้า"){
        $txt1 = <<<EOD
        รายงาน$status_select
        EOD;
      }else if($status_select=="ปรับเพิ่มสินค้า"){
        $txt1 = <<<EOD
        รายงานสินค้าเกิน
        EOD;
      }else if($status_select=="ปรับลดสินค้า"){
        $txt1 = <<<EOD
        รายงานสินค้าเสียหาย
        EOD;
      }else if($status_select=="ปรับเคลม"){
        $txt1 = <<<EOD
        รายงานการเคลมสินค้า
        EOD;
      }else{
        $txt1 = <<<EOD
        รายงานข้อมูลทั้งหมด
        EOD;
      }
    
$this->Write(0, " ", '', 0, 'C', true, 0, false, false, 0);
$this->Write(0, $txt1, '', 0, 'C', true, 0, false, false, 0);
$this->SetFont('thsarabun', 'l', 15);
$this->Write(0, $txt2, '', 0, 'R', true, 0, false, true, 0);

  }
  public function _destroy($destroyall = false, $preserve_objcopy = false)
        {
            if ($destroyall) {
                unset($this->imagekeys);
            }
            parent::_destroy($destroyall, $preserve_objcopy);
        }
  public function Footer()
    {
        $this->SetFont('thsarabun', '', 14);
        parent::Footer();
        $this->Cell(0, 5, "", 0, 1, 'L', 0, '', 0, false, 'M', 'M');
        date_default_timezone_set('Asia/Bangkok');
        $current_time = date('j-n-Y');
        require_once('DT2.php');
        $current_time_convert =  DateThai($current_time);
        $this->Cell(0, 8, "พิมพ์วันที่ " . $current_time_convert . "", 0, 1, 'L', 0, '', 0, false, 'M', 'M');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
 $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Report Activity');
 $pdf->SetSubject('TCPDF Tutorial');
 $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+8, PDF_MARGIN_RIGHT);
 $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
 $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
 }
$pdf->SetFont('thsarabun', 'l', 16);
$pdf->AddPage();
// ---------------------------------------------------------
$status_text=@$_POST['status_select'];
$to_date;
$from_date;
$to_date = $_POST['to_date'];
$from_date = $_POST['from_date']; 
$product_select =$_POST['product_select'];
$emp_select =$_POST['emp_select'];

$sql = "SELECT * FROM product 
JOIN stock ON  product.product_id = stock.product_id
JOIN emp_data ON emp_data.emp_id = stock.emp_id ORDER BY stock_id DESC";

$i=1;  
//empty all
$tbl = <<<EOD
<table border="1" align="center">
<thead>
<tr>
<th width="50">ลำดับที่</th>
<th width="80">รหัสรายการ</th>
<th width="100">สถานะ</th>
<th width="100">วันที่</th>
<th width="120">สินค้า</th>
<th width="80">จำนวน(เเพ็ค)</th>
<th width="130">พนักงาน</th>
</tr>
</thead>
EOD;


$txtxxx = '';

//1.isset emp 
if($emp_select!="" && $to_date=="" && $from_date=="" &&$product_select==""&&$status_text==""){
$query = "SELECT * FROM stock JOIN product JOIN emp_data
WHERE stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";

$tbl = <<<EOD
<table border="1" align="center">
<thead>
<tr>
<th width="60">ลำดับที่</th>
<th width="80">รหัสรายการ</th>
<th width="110">สถานะ</th>
<th width="120">วันที่</th>
<th width="180">สินค้า</th>
<th width="80">จำนวน(เเพ็ค)</th>
</tr>
</thead>
EOD;

// $tbl .= <<<EOD
// <tr>
//     <td rowspan="2"> 1 </td>
//     <td> 2 </td>
//     <td> 3 </td>
//     <td> 4 </td>
//     <td> 5 </td>
//     <td> 6 </td>
//     <td> 7 </td>
// </tr>
// <tr>
//     <td> 2 </td>
//     <td> 3 </td>
//     <td> 4 </td>
//     <td> 5 </td>
//     <td> 6 </td>
// </tr>
// EOD;

$txtxxx = '';
$query_run = mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $row)
    {
      
    require_once 'DT2.php';
    $stock_datetime= $row["stock_datetime"]; // convert date and time
    $runid = $row['runid'];
    $stock_id = $row['stock_id'];
      $product_name = $row['product_name'];
      $product_count = $row['product_count'];
      $emp_name = $row['emp_name'];
      $emp_surname = $row['emp_surname'];
      $stock_status = $row['stock_status'];



      $txtxxx =$txtxxx.'<tr>
      <td align="center" width="60">'.$S_id.'</td>
      <td align="center" width="80">'.$stock_id.'</td>
      <td align="center" width="110">'.$stock_status.'</td>
      <td align="center" width="120">'.DateThai($stock_datetime).'</td>
      <td align="center" width="180">'.$product_name.'</td>
      <td align="center" width="80">'.$product_count.'</td>
      </tr>'; 
      $i++;
    }
  }
  else{
  
    $not_found = "ไม่พบข้อมูล";
      $txtxxx =$txtxxx.'<tr>
      <td align="center" width="60">-</td>
      <td align="center" width="80">'.$not_found.'</td>
      <td align="center" width="110">'.$not_found.'</td>
      <td align="center" width="120">'.$not_found.'</td>
      <td align="center" width="180">'.$not_found.'</td>
      <td align="center" width="80">'.$not_found.'</td>
      </tr>'; 
  }

  
$tbl2 = <<<EOD
$txtxxx
EOD;
$tbl3 = <<<EOD
</table>
EOD;
}

//2.isset emp,product
  if($emp_select!="" && $product_select!="" &&$from_date=="" && $to_date=="" &&  $status_text==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="100">รหัสรายการ</th>
  <th width="180">สถานะ</th>
  <th width="180">วันที่</th>
  <th width="120">จำนวน(เเพ็ค)</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="100">'.$stock_id.'</td>
        <td align="center" width="180">'.$stock_status.'</td>
        <td align="center" width="180">'.DateThai($stock_datetime).'</td>
        <td align="center" width="120">'.$product_count.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
  
  
}

//3.isset emp,status
if($emp_select!=""  && $status_text!="" && $from_date=="" && $to_date=="" && $product_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%'  
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="100">รหัสรายการ</th>
  <th width="180">วันที่</th>
  <th width="180">สินค้า</th>
  <th width="120">จำนวน(เเพ็ค)</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="100">'.$stock_id.'</td>
        <td align="center" width="180">'.DateThai($stock_datetime).'</td>
        <td align="center" width="180">'.$product_name.'</td>
        <td align="center" width="120">'.$product_count.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
  
  
}

//4.isset emp,status,product
if($emp_select!=""  && $status_text!="" && $product_select!="" && $from_date=="" && $to_date==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="150">ลำดับที่</th>
  <th width="150">รหัสรายการ</th>
  <th width="200">วันที่</th>
  <th width="150">จำนวน(เเพ็ค)</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="150">'.$i.'</td>
        <td align="center" width="150">'.$stock_id.'</td>
        <td align="center" width="200">'.DateThai($stock_datetime).'</td>
        <td align="center" width="150">'.$product_count.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="150">'.$$not_found.'</td>
        <td align="center" width="150">'.$$not_found.'</td>
        <td align="center" width="250">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
  
  
}
//5.isset product
if($product_select!="" && $emp_select==""  && $status_text=="" &&  $from_date=="" && $to_date==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="60">ลำดับที่</th>
  <th width="80">รหัสรายการ</th>
  <th width="100">สถานะ</th>
  <th width="130">วันที่</th>
  <th width="100">จำนวน(เเพ็ค)</th>
  <th width="180">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="60">'.$i.'</td>
        <td align="center" width="80">'.$stock_id.'</td>
        <td align="center" width="100">'.$stock_status.'</td>
        <td align="center" width="130">'.DateThai($stock_datetime).'</td>
        <td align="center" width="100">'.$product_count.'</td>
        <td align="center" width="180">'.$emp_name.' '.$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="60">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="130">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
  
}

//6.isset product,status
if($product_select!="" && $status_text!="" && $emp_select=="" && $from_date=="" && $to_date==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="100">รหัสรายการ</th>
  <th width="150">วันที่</th>
  <th width="120">จำนวน(เเพ็ค)</th>
  <th width="200">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="100">'.$stock_id.'</td>
        <td align="center" width="150">'.DateThai($stock_datetime).'</td>
        <td align="center" width="120">'.$product_count.'</td>
        <td align="center" width="200">'.$emp_name.' '.$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        <td align="center" width="200">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
  
}

//7.isset status
if($status_text!="" && $product_select=="" &&  $emp_select=="" && $from_date=="" && $to_date==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="63">ลำดับที่</th>
  <th width="88">รหัสรายการ</th>
  <th width="100">วันที่</th>
  <th width="150">สินค้า</th>
  <th width="92">จำนวน(เเพ็ค)</th>
  <th width="150">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="63">'.$i.'</td>
        <td align="center" width="88">'.$stock_id.'</td>
        <td align="center" width="100">'.DateThai($stock_datetime).'</td>
        <td align="center" width="150">'.$product_name.'</td>
        <td align="center" width="92">'.$product_count.'</td>
        <td align="center" width="150">'.$emp_name." ".$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="63">-</td>
        <td align="center" width="88">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="117">'.$not_found.'</td>
        <td align="center" width="92">'.$not_found.'</td>
        <td align="center" width="180">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//8.isset date
if($from_date!="" && $to_date!="" && $status_text=="" && $product_select=="" &&  $emp_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="50">ลำดับที่</th>
  <th width="75">รหัสรายการ</th>
  <th width="90">สถานะ</th>
  <th width="120">วันที่</th>
  <th width="120">สินค้า</th>
  <th width="75">จำนวน(เเพ็ค)</th>
  <th width="120">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="50">'.$i.'</td>
        <td align="center" width="75">'.$stock_id.'</td>
        <td align="center" width="90">'.$stock_status.'</td>
        <td align="center" width="120">'.DateThai($stock_datetime).'</td>
        <td align="center" width="120">'.$product_name.'</td>
        <td align="center" width="75">'.$product_count.'</td>
        <td align="center" width="120">'.$emp_name." ".$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        td align="center" width="60">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//9.isset date,emp
if($from_date!="" && $to_date!="" &&  $emp_select!="" && $status_text=="" && $product_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="80">รหัสรายการ</th>
  <th width="130">วันที่</th>
  <th width="100">สถานะ</th>
  <th width="150">สินค้า</th>
  <th width="100">จำนวน(เเพ็ค)</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="80">'.$stock_id.'</td>
        <td align="center" width="130">'.DateThai($stock_datetime).'</td>
        <td align="center" width="100">'.$stock_status.'</td>
        <td align="center" width="150">'.$product_name.'</td>
        <td align="center" width="100">'.$product_count.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//10.isset date,product,emp
if($from_date!="" && $to_date!="" &&  $product_select!=""  && $emp_select!="" && $status_text==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="100">ลำดับที่</th>
  <th width="100">รหัสรายการ</th>
  <th width="150">สถานะ</th>
  <th width="150">วันที่</th>
  <th width="140">จำนวน(เเพ็ค)</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$i.'</td>
        <td align="center" width="100">'.$stock_id.'</td>
        <td align="center" width="150">'.$stock_status.'</td>
        <td align="center" width="150">'.DateThai($stock_datetime).'</td>
        <td align="center" width="140">'.$product_count.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//11.isset date,status
if($from_date!="" &&  $to_date!="" &&  $status_text!="" && $product_select==""  && $emp_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="80">รหัสรายการ</th>
  <th width="120">วันที่</th>
  <th width="140">สินค้า</th>
  <th width="80">จำนวน(เเพ็ค)</th>
  <th width="150">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="80">'.$stock_id.'</td>
        <td align="center" width="120">'.DateThai($stock_datetime).'</td>
        <td align="center" width="140">'.$product_name.'</td>
        <td align="center" width="80">'.$product_count.'</td>
        <td align="center" width="150">'.$emp_name.' '.$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//12.isset date,status,product
if($from_date!="" &&  $to_date!="" &&  $status_text!="" && $product_select!=""  && $emp_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="100">ลำดับที่</th>
  <th width="110">รหัสรายการ</th>
  <th width="140">วันที่</th>
  <th width="100">จำนวน(เเพ็ค)</th>
  <th width="160">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$i.'</td>
        <td align="center" width="110">'.$stock_id.'</td>
        <td align="center" width="140">'.DateThai($stock_datetime).'</td>
        <td align="center" width="100">'.$product_count.'</td>
        <td align="center" width="160">'.$emp_name.' '.$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="110">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="160">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//13.isset date,status,emp
if($from_date!="" &&  $to_date!="" &&  $status_text!="" && $emp_select!=""  && $product_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="100">ลำดับที่</th>
  <th width="110">รหัสรายการ</th>
  <th width="140">วันที่</th>
  <th width="160">สินค้า</th>
  <th width="100">จำนวน(เเพ็ค)</th>
 
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$i.'</td>
        <td align="center" width="110">'.$stock_id.'</td>
        <td align="center" width="140">'.DateThai($stock_datetime).'</td>
        <td align="center" width="160">'.$product_name.'</td>
        <td align="center" width="100">'.$product_count.'</td>

        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="110">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="160">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//14.isset date,status,emp
if($from_date!="" &&  $to_date!="" &&  $status_text!="" && $emp_select!=""  && $product_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="100">ลำดับที่</th>
  <th width="110">รหัสรายการ</th>
  <th width="140">วันที่</th>
  <th width="160">สินค้า</th>
  <th width="100">จำนวน(เเพ็ค)</th>
 
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
   $n =1;
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$n.'</td>
        <td align="center" width="110">'.$stock_id.'</td>
        <td align="center" width="140">'.DateThai($stock_datetime).'</td>
        <td align="center" width="160">'.$product_name.'</td>
        <td align="center" width="100">'.$product_count.'</td>

        </tr>'; 
        $n++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="110">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="160">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//15.isset status,emp
if($status_text!="" && $emp_select!=""  && $from_date=="" &&  $to_date=="" &&  $product_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id  ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="100">ลำดับที่</th>
  <th width="110">รหัสรายการ</th>
  <th width="140">วันที่</th>
  <th width="160">สินค้า</th>
  <th width="100">จำนวน(เเพ็ค)</th>
 
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
    $n =1;
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$n.'</td>
        <td align="center" width="110">'.$stock_id.'</td>
        <td align="center" width="140">'.DateThai($stock_datetime).'</td>
        <td align="center" width="160">'.$product_name.'</td>
        <td align="center" width="100">'.$product_count.'</td>

        </tr>'; 
        $n++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="100">'.$not_found.'</td>
        <td align="center" width="110">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="160">'.$not_found.'</td>
        <td align="center" width="100">'.$not_found.'</td>
        
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}
//16.isset all
else if($from_date!="" && $to_date!="" && $emp_select!=""&&$product_select!=""&&$status_text!=""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_id DESC";

  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="140">ลำดับที่</th>
  <th width="140">รหัสรายการ</th>
  <th width="200">วันที่</th>
  <th width="140">จำนวน(เเพ็ค)</th>
 
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
    $n =1;
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="140">'.$n.'</td>
        <td align="center" width="140">'.$stock_id.'</td>
        <td align="center" width="200">'.DateThai($stock_datetime).'</td>
        <td align="center" width="140">'.$product_count.'</td>

        </tr>'; 
        $n++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="200">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>

        
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}
//17.isset date,product
if($from_date!="" &&  $to_date!="" &&  $product_select!="" && $status_text==""  && $emp_select=="" ){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' 
  AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY stock_datetime DESC";
  $tbl = <<<EOD
  <table border="1" align="center">
  <thead>
  <tr>
  <th width="80">ลำดับที่</th>
  <th width="80">รหัสรายการ</th>
  <th width="120">สถานะ</th>
  <th width="140">วันที่</th>
  <th width="80">จำนวน(เเพ็ค)</th>
  <th width="150">พนักงาน</th>
  </tr>
  </thead>
  EOD;
  $txtxxx = '';
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0)
  {
      foreach($query_run as $row)
      {
      require_once 'DT2.php';
      $stock_datetime= $row["stock_datetime"]; // convert date and time
      $runid = $row['runid'];
      $stock_id = $row['stock_id'];
        $product_name = $row['product_name'];
        $product_count = $row['product_count'];
        $emp_name = $row['emp_name'];
        $emp_surname = $row['emp_surname'];
        $stock_status = $row['stock_status'];
  
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$i.'</td>
        <td align="center" width="80">'.$stock_id.'</td>
        <td align="center" width="120">'.$stock_status.'</td>
        <td align="center" width="140">'.DateThai($stock_datetime).'</td>
        <td align="center" width="80">'.$product_count.'</td>
        <td align="center" width="150">'.$emp_name.' '.$emp_surname.'</td>
        </tr>'; 
        $i++;
      }
    }
    else{
    
      $not_found = "ไม่พบข้อมูล";
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="120">'.$not_found.'</td>
        <td align="center" width="140">'.$not_found.'</td>
        <td align="center" width="80">'.$not_found.'</td>
        <td align="center" width="150">'.$not_found.'</td>
        </tr>'; 
    }
  
    
  $tbl2 = <<<EOD
  $txtxxx
  EOD;
  $tbl3 = <<<EOD
  </table>
  EOD;
}

//empty 1 date
else if($from_date==""&&$to_date!=""&&$product_select!=""&&$emp_select!=""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date!=""&&$to_date==""&&$product_select!=""&&$emp_select!=""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date!=""&&$to_date==""&&$product_select==""&&$emp_select!=""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date!=""&&$to_date==""&&$product_select!=""&&$emp_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date==""&&$to_date!=""&&$product_select!=""&&$emp_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date==""&&$to_date!=""&&$product_select==""&&$emp_select!=""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date!=""&&$to_date==""&&$product_select==""&&$emp_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//empty 1 date
else if($from_date==""&&$to_date!=""&&$product_select==""&&$emp_select==""){
  // print_r($emp_select);
  // print_r($product_select);
  // exit;
  echo "<script>
  alert('ผิดพลาด:กรุณาระบุวันที่ทั้งสองวัน');
  window.location.replace('../../report.php');
  </script>";
}
//status
else{
$query = "SELECT * FROM stock JOIN product JOIN emp_data
WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ORDER BY stock_id DESC";
$query_run = mysqli_query($conn, $query);
$cap = '';
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $row)
    {
    require_once 'DT2.php';
    $stock_datetime= $row["stock_datetime"]; // convert date and time
    $runid = $row['runid'];
    $stock_id = $row['stock_id'];
      $product_name = $row['product_name'];
      $product_count = $row['product_count'];
      $emp_name = $row['emp_name'];
      $emp_surname = $row['emp_surname'];
      $stock_status = $row['stock_status'];

      $S_id = "SELECT stock_id FROM stock WHERE stock_id = '$stock_id'";
      $query_S_id = mysqli_query($conn, $S_id);
      $query_S_id_1 = mysqli_num_rows($query_S_id);

      if($cap == ""){
        $txtxxx =$txtxxx.'<tr>
      <td align="center" width="50" rowspan="'.$query_S_id_1.'">'.$i.'</td>
      <td align="center" width="80" rowspan="'.$query_S_id_1.'">'.$stock_id.'</td>
      <td align="center" width="100" rowspan="'.$query_S_id_1.'">'.$stock_status.'</td>
      <td align="center" width="100" rowspan="'.$query_S_id_1.'">'.DateThai($stock_datetime).'</td>
      <td align="center" width="120">'.$product_name.'</td>
      <td align="center" width="80">'.$product_count.'</td>
      <td align="center" width="130" rowspan="'.$query_S_id_1.'">'.$emp_name." ".$emp_surname.'</td>
      </tr>';
      }else if($stock_id == $cap){
        $txtxxx =$txtxxx.'<tr>
        <td align="center" width="120">'.$product_name.'</td>
        <td align="center" width="80">'.$product_count.'</td>
        </tr>'; 
      }else{
        $txtxxx =$txtxxx.'<tr>
      <td align="center" width="50" rowspan="'.$query_S_id_1.'">'.$i.'</td>
      <td align="center" width="80" rowspan="'.$query_S_id_1.'">'.$stock_id.'</td>
      <td align="center" width="100" rowspan="'.$query_S_id_1.'">'.$stock_status.'</td>
      <td align="center" width="100" rowspan="'.$query_S_id_1.'">'.DateThai($stock_datetime).'</td>
      <td align="center" width="120">'.$product_name.'</td>
      <td align="center" width="80">'.$product_count.'</td>
      <td align="center" width="130" rowspan="'.$query_S_id_1.'">'.$emp_name." ".$emp_surname.'</td>
      </tr>';
      } 
      $i++;
      $cap = $stock_id;
    }
  }
  else{
  
    $not_found = "ไม่พบข้อมูล";
      $txtxxx =$txtxxx.'<tr>
      <td align="center" width="50">-</td>
      <td align="center" width="80">'.$not_found.'</td>
      <td align="center" width="100">'.$not_found.'</td>
      <td align="center" width="100">'.$stock_status.'</td>
      <td align="center" width="120">'.$not_found.'</td>
      <td align="center" width="80">'.$not_found.'</td>
      <td align="center" width="130">'.$not_found.'</td>
      </tr>'; 
  }

  
$tbl2 = <<<EOD
$txtxxx
EOD;
$tbl3 = <<<EOD
</table>
EOD;
}


$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($tbl.$tbl2.$tbl3, true, false, false, false, '');
$pdf->Output('example_004.pdf', 'I');