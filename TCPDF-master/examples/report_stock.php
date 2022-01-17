<?php
  include '../../connect.php';
  $Departure_Date_S = @$_POST['Departure_Date_S'];
  $Departure_Date_E = @$_POST['Departure_Date_E'];
  ?>
<?php
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {
	public function Header() {
                date_default_timezone_set('Asia/Bangkok');
                $current_time = date('j-n-Y');
                require_once('DT2.php');
                $current_time_convert =  DateThai($current_time);
        include '../../connect.php';
        $Departure_Date_S = @$_POST['Departure_Date_S'];
        $Departure_Date_E = @$_POST['Departure_Date_E'];

		if($Departure_Date_S != "" && $Departure_Date_E != ""){
            
            $txt2 = <<<EOD
Starting from $Startdate TO $Enddate 
EOD;
        }else{
            $txt2 = <<<EOD
            ณ วันที่ $current_time_convert
EOD;
        }
		$this->Image('images/logo.jpg', 5, 3,50, 20, 'JPG', '', 'F', false, 1, '', false, false, 0, false, false, false);
		$this->SetFont('thsarabun', 'B', 20);

//TITLE
        $txt1 = <<<EOD
        
        รายงานสินค้าคงคลัง 
        EOD;
		
$this->Write(0, $txt1, '', 0, 'C', true, 0, false, false, 0);
$this->SetFont('thsarabun', 'l', 14);
$this->Write(0, $txt2, '', 0, 'R', true, 0, false, false, 0);
	}
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
 $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Report Stock');
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

$tbl = <<<EOD
<table border="1" >
<tr>
<th width="112" align="center">ลำดับที่</th>
<th width="122" align="center">รหัสสินค้า</th>
<th width="172" align="center">ชื่อสินค้า</th>
<th width="112" align="center">จำนวน</th>
<th width="112" align="center">หน่วย</th>




</tr>
EOD;
$txtxxx = '';
$sql = "SELECT * FROM product 
JOIN unit ON  product.unit_id = unit.unit_id
ORDER BY product_qty  DESC";
$i=1;  
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) { 
	while($row = mysqli_fetch_assoc($result)) {
    
    $runid = $i;
    $product_id = $row["product_id"];
    $product_name = $row["product_name"];
    $product_qty = $row["product_qty"];
    $unit_name = $row["unit_name"];


    
    $txtxxx =$txtxxx.'<tr>
    <td align="center">'.$i.'</td>
    <td align="center">'.$product_id.'</td>
    <td align="center">'.$product_name.'</td>
    <td align="center">'.$product_qty.'</td>
    <td align="center">'.$unit_name.'</td>
    
   
    </tr>';
    $i++;
  }
}
///////////////////////////////////////////////////////////////////
$tbl2 = <<<EOD
$txtxxx
EOD;
$tbl3 = <<<EOD
</table>
EOD;
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($tbl.$tbl2.$tbl3, true, false, false, false, '');
$pdf->Output('example_004.pdf', 'I');