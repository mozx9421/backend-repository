<?php
require_once('tcpdf_include.php');
$PNR = @$_GET["PNR"];
$PNR = "SN3EKM|4";
include '../../connectDB.php';
include '../../Function.php';
$sql3 = "SELECT * FROM booking WHERE `booking`.`PNR` = '$PNR' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_Bag_Count = $row["Booking_Bag_Count"];
	  $Booking_FlightNo = $row["Booking_FlightNo"];
	  $PNR = $row["PNR"];
      $Booking_Passenger = explode(" ",$row["Booking_Passenger"]); //$Booking_Passenger[0];
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
		$ShowDate = changeDateEN($row["Plne_Arrival_DateTime"]); 
      }
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------
class MYPDF extends TCPDF {
	public function Header() {
		$this->Image('images/LOGOairline.png', 5, 3,60, 15, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
		$this->SetFont('thsarabun', 'B', 20);
/*
		$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');*/
		$txt1 = <<<EOD
		รายงานผู้โดยสารเที่ยวบินที่
		EOD;
		$txt2 = <<<EOD
จากสนามบิน
EOD;
$this->Write(0, $txt1, '', 0, 'C', true, 0, false, false, 0);
$this->SetFont('thsarabun', 'i', 18);
$this->Write(0, $txt2, '', 0, 'C', true, 0, false, false, 0);
	}
}

	






//-----------------------------------------------------------------------------------------------------------------------------------------------------
$width = 56;  
$height = 500; 
$pageLayout = array($width, $height);
//$pdf = new TCPDF('P', 'pt', $pageLayout, true, 'UTF-8', false);
$pdf = new TCPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
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
$pdf->SetFont('thsarabun', '', 9);
$pdf->AddPage();
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 3 // height of a single module in points
);



$pdf->writeHTML("XXXX", true, false, false, false, '');


$pdf->Cell(-10, -10, 'CODE 39 EXTENDED + CHECKSUM', 0, 0);





// --- Rotation --------------------------------------------
/*
$pdf->StartTransform();
$pdf->Rotate(90, 50, 80);
ข้อความที่จะหมุน
$pdf->StopTransform();
*/


/*
$pdf->Image('images/LOGOairline.png', 1, 1,150, 50, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
$pdf->Image('images/LOGOairline.png', 1, 400,150, 50, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
*/

/*
$pdf->StartTransform();
$pdf->Rotate(90, 50, 80);
$pdf->write1DBarcode('UTK20200202CNX/R8/R8/01', 'C39', 0,45, 90, 50,2, $style, 'N');
$pdf->StopTransform();
$pdf->write1DBarcode('UTK20200202CNX/R8/R8/01', 'C39', 0,140, 90, 60,1, $style, 'N');

$pdf->write1DBarcode('1234567', 'I25', '', '', '', 18, 0.4, $style, 'N');


$pdf->StartTransform();
$pdf->Rotate(90, 50, 50);
$pdf->write2DBarcode('XXX', 'PDF417', -300, 10, 150, 50,$style, 'N');
//  ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();
*/













$pdf->Output('example_002.pdf', 'I');