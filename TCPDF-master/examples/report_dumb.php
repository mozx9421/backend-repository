<?php
  include '../../connect.php';
  $Departure_Date_S = @$_POST['Departure_Date_S'];
  $Departure_Date_E = @$_POST['Departure_Date_E'];
  ?>
<?php
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {
  public function Header() {
        include '../../connect.php';
        $Departure_Date_S = @$_POST['Departure_Date_S'];
        $Departure_Date_E = @$_POST['Departure_Date_E'];

    if($Departure_Date_S != "" && $Departure_Date_E != ""){
            
            $txt2 = <<<EOD
Starting from $Startdate TO $Enddate 
EOD;
        }else{
            $txt2 = <<<EOD

EOD;
        }
    $this->Image('images/logo.jpg', 5, 3,50, 20, 'JPG', '', 'F', false, 1, '', false, false, 0, false, false, false);
    $this->SetFont('thsarabun', 'B', 20);
      
        $txt1 = <<<EOD
        รายงานการเบิกออกสินค้า

        EOD;
    
$this->Write(0, " ", '', 0, 'C', true, 0, false, false, 0);
$this->Write(0, $txt1, '', 0, 'C', true, 0, false, false, 0);
$this->SetFont('thsarabun', 'l', 12);
$this->Write(0, $txt2, '', 0, 'C', true, 0, false, false, 0);
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
 $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
$to_date;
$from_date;


$to_date = $_POST['to_date'];
$from_date = $_POST['from_date'];
$tbl = <<<EOD
<table border="1" >
<tr>
<th width="40" align="center">ลำดับที่</th>
<th width="70" align="center">รหัสรายการ</th>
<th width="110" align="center">วันที่</th>
<th width="110" align="center">สินค้า</th>
<th width="110" align="center">วันที่หมดอายุ</th>
<th width="80" align="center">จำนวน(เเพ็ค)</th>
<th width="140" align="center">พนักงาน</th>

</tr>
EOD;
$txtxxx = '';

$sql = "SELECT * FROM product 
JOIN stock ON  product.product_id = stock.product_id
JOIN emp_data ON emp_data.emp_id = stock.emp_id ORDER BY stock_id DESC";
$i=1;  

$status_text="รับเข้าสินค้า";
$product_select =$_POST['product_select'];
$emp_select =$_POST['emp_select'];

//Filter condition (use post method)
//isset all
if($from_date!=""&&$to_date!=""&&$product_select!=""&&$emp_select!=""){
$query = "SELECT * FROM stock JOIN product JOIN emp_data
WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
AND stock_datetime BETWEEN '$from_date' AND '$to_date' ";
}
//isset 2 date
else if($from_date!=""&&$to_date!=""){
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%'AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id 
  AND stock_datetime BETWEEN '$from_date' AND '$to_date'";
}
//isset 1 date from_date
else if($from_date!=""){
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%'AND stock_datetime LIKE '%".$from_date."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ";
}
//isset 1 date to_date
else if($to_date!=""){
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%'AND stock_datetime LIKE '%".$to_date."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id ";
}
//isset product
else if($product_select!=""){
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id LIKE '%".$product_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id";
}
//isset employee
else if($emp_select!=""){
  $query = "SELECT * FROM stock JOIN product JOIN emp_data
  WHERE stock_status LIKE '%".$status_text."%' AND stock.emp_id LIKE '%".$emp_select."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id";
}
else{
$query = "SELECT * FROM stock JOIN product JOIN emp_data
WHERE stock_status LIKE '%".$status_text."%' AND stock.product_id=product.product_id AND stock.emp_id=emp_data.emp_id";
}

$query_run = mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $row)
    {
 
    $stock_datetime= $row["stock_datetime"]; // convert date and time
    $stock_datetime2 = $stock_datetime = date("Y-m-d",strtotime($stock_datetime));
    $product_exp = $row["product_exp"];  // convert date and time
    $product_exp2 = $product_exp = date("Y-m-d",strtotime($product_exp));
    $stock_id = $row['stock_id'];
      $product_name = $row['product_name'];
      $product_exp = $row['product_exp'];
      $product_count = $row['product_count'];
      $emp_name = $row['emp_name'];
      $emp_surname = $row['emp_surname'];

      $txtxxx =$txtxxx.'<tr>
      <td align="center">'.$i.'</td>
      <td align="center">'.$stock_id.'</td>
      <td align="center">'.$stock_datetime2.'</td>
      <td align="center">'.$product_name.'</td>
      <td align="center">'.$product_exp2.'</td>
      <td align="center">'.$product_count.'</td>
      <td align="center">'.$emp_name." ".$emp_surname.'</td>
      </tr>'; 
      $i++;
    }
  }
  else{
  
    $not_found = "ไม่พบข้อมูล";
      $txtxxx =$txtxxx.'<tr>
      <td align="center">-</td>
      <td align="center">'.$not_found.'</td>
      <td align="center">'.$not_found.'</td>
      <td align="center">'.$not_found.'</td>
      <td align="center">'.$not_found.'</td>
      <td align="center">'.$not_found.'</td>
      <td align="center">'.$not_found.'</td>
      </tr>'; 
  }

  
$tbl2 = <<<EOD
$txtxxx
EOD;
$tbl3 = <<<EOD
</table>
EOD;
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($tbl.$tbl2.$tbl3, true, false, false, false, '');
$pdf->Output('example_004.pdf', 'I');


