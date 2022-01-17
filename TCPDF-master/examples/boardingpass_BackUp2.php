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
$width = 400;  
$height = 200; 
$pageLayout = array($width, $height);
$pdf = new TCPDF('L', 'pt', $pageLayout, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('ฺBoarding Pass');
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
$pdf->SetFont('thsarabun', 'BI', 12);
$pdf->AddPage();
$image_file = 'LOGOairline.png';
$SURN = $Booking_Passenger[2];
$NAMES = $Booking_Passenger[1];
$Pre = strtoupper($Booking_Passenger[0]);
$txt = <<<EOD
<table border="0">
<thead>
 <tr>
  <td width="25" height="35" align="center"><b></b></td>
  <td width="10" align="center"><b></b></td>
  <td width="50" align="center"><b></b></td>
  <td width="100" align="center"><b></b></td>
  <td width="90" align="center"> <b>$Booking_Class</b></td>
  <td width="80" align="center"><b></b></td>
  <td width="45" align="center"><b></b></td>
 </tr>
</thead>
 <tr>
  <td width="65" height="10" align="center"></td>
  <td width="170"><font size="8">NAME</font><br />$SURN $NAMES $Pre<br />FROM<br />$Plne_Departure_Code<br />TO<br />$Plne_Arrival_Code<br />PNR<br />$PNR2</td>
  <td width="49">FIGHT NO<br />DATE<br />BOADING TIME<br/>CLASS<br />SEQ.<br />SEAT<br />GATE<br /></td>
  <td width="55">$FlightNo<br />$Plne_Departure_DateTime<br />$Plne_BoadingTime<br/><br/>$Booking_Class_id<br />$Booking_SEQ<br />$Booking_SEAT_NO<br />$Plne_Gate<br /></td>
  <td width="105">$SURN $NAMES $Pre<br/>FIGHTNO. $FlightNo<br/>DATE $Plne_Departure_DateTime<br/>Boarding $Plne_BoadingTime <br/>Time <br/>SEAT $Booking_SEAT_NO</td>
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
$pdf->writeHTML($txt, true, false, false, false, '');
//$pdf->Image('images/LOGOairline.png', 1, 1,150, 50, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
$pdf->StartTransform();
$pdf->Rotate(90, 50, 50);
$pdf->write2DBarcode($PNR, 'PDF417', -100, -1, 150, 50,$style, 'N');
//  ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();
$pdf->Output('example_002.pdf', 'I');
$pdf->IncludeJS("print(true);");