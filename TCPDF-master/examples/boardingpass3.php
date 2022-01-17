<?php
require_once('tcpdf_include.php');
$Booking_SEAT_NO = @$_GET["Booking_SEAT_NO"];
$PNR = @$_GET["PNR"];
include '../../connectDB.php';
include '../../Function.php';
$sql = "UPDATE `booking` SET `Booking_SEAT_NO` = '$Booking_SEAT_NO' WHERE `booking`.`PNR` = '$PNR'";
$PNR2 = CutPNR($PNR);
if ($conn->multi_query($sql) === TRUE) {	}

$sql3 = "SELECT * FROM booking WHERE `booking`.`PNR` = '$PNR' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_SEQ = $row["Booking_SEQ"];
	  $Booking_Class_id = $row["Booking_Class_id"];
	  $Booking_Class = strtoupper(cutClass($row["Booking_Class"]));
	  $PNR = $row["PNR"];
    $Booking_Passenger = explode(" ",$row["Booking_Passenger"]);
    $Booking_FlightNo = $row["Booking_FlightNo"];
    $FlightNo = FlightNoID($Booking_FlightNo);
	}
  }

  $sql2 = "SELECT * FROM manage_plane WHERE `manage_plane`.`Plne_FlightNo` = '$Booking_FlightNo' ";
      $result2 = mysqli_query($conn, $sql2);
      if (mysqli_num_rows($result2) > 0) { while($row = mysqli_fetch_assoc($result2)) {
        $Plne_Departure_Code = strtoupper(cutAirport(SelectAirportName($row["Plne_Departure_Code"]))).'('.$row["Plne_Departure_Code"].')';
        $Plne_Departure_DateTime = changeDateEN($row["Plne_Departure_DateTime"]);
		$Plne_Arrival_Code = strtoupper(cutAirport(SelectAirportName($row["Plne_Arrival_Code"]))).'('.$row["Plne_Arrival_Code"].')';
		$Plne_Gate = $row["Plne_Gate"];
		$Plne_BoadingTime = CutTime($row["Plne_BoadingTime"]);
      }
	}
// $width = 466;  
// $height = 175; 
// $width = 500;  
// $height = 250; 
/*
$width = 500;  
$height = 340; 
*/

/*
$width = 700;  
$height = 340; 
*/
$width = 400;  
$height = 200; 
$pageLayout = array($width, $height);
$pdf = new TCPDF('L', 'pt', $pageLayout, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('thsarabun', 'BI', 14);
$pdf->AddPage();
$image_file = 'LOGOairline.png';
$SURN = $Booking_Passenger[2];
$NAMES = $Booking_Passenger[1];
$Pre = strtoupper($Booking_Passenger[0]);
$txt = <<<EOD
<table border="0">
<thead>
 <tr>
  <td width="25" height="5" align="center"><b></b></td>
  <td width="140" align="center"><b></b></td>
  <td width="140" align="center"><b></b></td>
  <td width="140" align="center"><b></b></td>
  <td width="90" align="center"> <b>$Booking_Class</b></td>
  <td width="80" align="center"><b></b></td>
  <td width="45" align="center"><b></b></td>
 </tr>
</thead>
 <tr>
  <td width="65" align="center"></td>
  <td width="220"><font size="10">NAME</font><br />$SURN $NAMES $Pre<br />FROM<br />$Plne_Departure_Code<br />TO<br />$Plne_Arrival_Code<br />PNR<br />$PNR2</td>
  <td width="59">DATE<br /><br />CLASS<br /><br />SEQ.<br /><br />GATE<br /><br /></td>
  <td width="105">$Plne_Departure_DateTime<br /><br />$Booking_Class_id<br /><br />$Booking_SEQ<br /><br />$Plne_Gate<br /><br /></td>
  <td >FIGHT NO<br /><br />SEAT<br /><br />BOADING TIME</td>
  <td >$FlightNo<br /><br />$Booking_SEAT_NO<br /><br />$Plne_BoadingTime</td>
  <td width="300">NAME<br />XXXXXXXXXXXXXXXXXXX456<br />FROM<br />XXXX<br />TO<br />XXXX<br />PNR<br />XXXX</td>
 </tr>
</table>
EOD;
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 3, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);
//$pdf->Image('images/image_with_alpha.png', 10, 10, 100, '', '', 'http://www.tcpdf.org', '', false, 300);

$pdf->Image($image_file, 5, 2,220, '', 'PNG', '', 'F', false, 300, '', false, false, 0, false, false, false);
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
//$pdf->Write(0, $txt, '', 0, 'J', true, 0, false, false, 0);
$pdf->writeHTML($txt, true, false, false, false, '');
$pdf->Image('images/LOGOairline.png', 1, 1,220, 100, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
$pdf->StartTransform();
$pdf->Rotate(90, 50, 50);
$pdf->write2DBarcode($PNR, 'PDF417', -250, -15, 300, 100,$style, 'N');
//$pdf->write2DBarcode($Booking_No, 'PDF417', -190, -20, 250, 100,$style, 'N');
//  ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();



// write some JavaScript code
/*
$js = <<<EOD
app.alert('JavaScript Popup Example', 3, 0, 'Welcome');
var cResponse = app.response({
    cQuestion: 'How are you today?',
    cTitle: 'Your Health Status',
    cDefault: 'Fine',
    cLabel: 'Response:'
});
if (cResponse == null) {
    app.alert('Thanks for trying anyway.', 3, 0, 'Result');
} else {
    app.alert('You responded, "'+cResponse+'", to the health question.', 3, 0, 'Result');
}
EOD;
*/
// force print dialog
$js = <<<EOD
var body = "dddddd"    
var script = "<script>window.print();</scr'+'ipt>";

var newWin = $("#printf")[0].contentWindow.document; 
newWin.open();
newWin.close();

$("body",newWin).append(body+script);


EOD;
$js .= 'print(true);';



// set javascript
$pdf->IncludeJS($js);







//$pdf->write2DBarcode($Booking_No, 'PDF417', 250, 70, 0, 70,$style, 'N');
$pdf->Output('example_002.pdf', 'I');
$pdf->IncludeJS("print(true);");
//$pdf->Output('example_058.pdf', 'D'); pdf
//$pdf->Output('example_002.pdf', 'I'); ให้ดู