<?php
require_once('tcpdf_include.php');
$Booking_SEAT_NO = @$_GET["Booking_SEAT_NO"];
$Booking_No = @$_GET["Booking_No"];
include '../../connectDB.php';
include '../../Function.php';
$sql = "UPDATE `booking` SET `Booking_SEAT_NO` = '$Booking_SEAT_NO' WHERE `booking`.`Booking_No` = '$Booking_No'";
if ($conn->multi_query($sql) === TRUE) {	}
$FlightNo = explode("/",$Booking_No);//[0]
$sql2 = "SELECT * FROM manage_plane WHERE `manage_plane`.`Plne_FlightNo` = '$FlightNo[0]/$FlightNo[1]' ";
      $result2 = mysqli_query($conn, $sql2);
      if (mysqli_num_rows($result2) > 0) { while($row = mysqli_fetch_assoc($result2)) {
        $Plne_Departure_Code = SelectAirportName($row["Plne_Departure_Code"]);
        $Plne_Departure_DateTime = changeDateEN($row["Plne_Departure_DateTime"]);
		$Plne_Arrival_Code = SelectAirportName($row["Plne_Arrival_Code"]);
		$Plne_Gate = $row["Plne_Gate"];
		$Plne_BoadingTime = $row["Plne_BoadingTime"];
      }
	}
$sql3 = "SELECT * FROM booking WHERE `booking`.`Booking_No` = '$Booking_No' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_SEQ = $row["Booking_SEQ"];
	  $Booking_Class_id = $row["Booking_Class_id"];
	  $Booking_Class = $row["Booking_Class"];
	  $PNR = $row["PNR"];
	  $Booking_Passenger = explode("|",$row["Booking_Passenger"]);
	}
  }
// $width = 466;  
// $height = 175; 
// $width = 500;  
// $height = 250; 

$width = 500;  
$height = 340; 



$width = 500;  
$height = 340; 
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
$pdf->SetFont('thsarabun', 'BI', 20);
$pdf->AddPage();
$image_file = K_PATH_IMAGES.'LOGO airline and faculty3.png';
$FlightNoI0 = $FlightNo[0];
$SURN = $Booking_Passenger[2];
$NAMES = $Booking_Passenger[1];
$Pre = $Booking_Passenger[0];
// $txt = <<<EOD
//                                 $Booking_Class
// NAME         DATE     $Plne_Departure_DateTime       FIGHT NO  $FlightNoI0
// $SURN       $NAMES       $Pre
// FROM            CLASS     $Booking_Class_id
// $Plne_Departure_Code
// TO             SEQ.$Booking_SEQ    SEAT $Booking_SEAT_NO
// $Plne_Arrival_Code     GATE  $Plne_Gate BOOKING TIME $Plne_BoadingTime
// PNR
// $Booking_No
// EOD;
$txt = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">
<tr>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   $Booking_Class <br />
<font size="16" color="Gray">NAME</font>&nbsp;&nbsp;<font size="16" color="Gray">DATE</font> &nbsp;$Plne_Departure_DateTime &nbsp;&nbsp;  <font size="16" color="Gray">FIGHT NO</font> &nbsp; $FlightNoI0 <br />
$SURN    &nbsp; &nbsp;    $NAMES   &nbsp; &nbsp;     $Pre <br />
<font size="16" color="Gray">FROM</font>  &nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;       <font size="16" color="Gray">CLASS</font>  &nbsp;    $Booking_Class_id <br />
$Plne_Departure_Code <br />
<font size="16" color="Gray">TO</font> &nbsp;&nbsp;&nbsp;          <font size="16" color="Gray">SEQ.</font>  $Booking_SEQ  &nbsp;&nbsp;&nbsp;  <font size="16" color="Gray">SEAT</font> SEAT &nbsp; $Booking_SEAT_NO <br />
$Plne_Arrival_Code &nbsp;&nbsp;&nbsp;    <font size="16" color="Gray">GATE</font> &nbsp; $Plne_Gate <font size="16" color="Gray">BOOKING TIME</font> &nbsp; $Plne_BoadingTime <br />
<font size="16" color="Gray">PNR</font> <br />
<font size="16" >$PNR </font> <br /> <br />
</td>
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
$pdf->Image($image_file, 5, 2,200, '', 'PNG', '', 'F', false, 300, '', false, false, 0, false, false, false);
//$pdf->Write(0, $txt, '', 0, 'J', true, 0, false, false, 0);
$pdf->writeHTML($txt, true, false, false, false, '');
$pdf->StartTransform();
$pdf->Rotate(90, 50, 50);
$pdf->write2DBarcode($Booking_No, 'PDF417', -190, -20, 250, 100,$style, 'N');
$pdf->write2DBarcode($Booking_No, 'PDF417', -190, -20, 250, 100,$style, 'N');
//  ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();

//$pdf->write2DBarcode($Booking_No, 'PDF417', 250, 70, 0, 70,$style, 'N');
$pdf->Output('example_002.pdf', 'I');
