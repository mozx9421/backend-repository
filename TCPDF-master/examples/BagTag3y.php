<?php
  include '../../connectDB.php';
  include '../../Function.php';
  /*
  $S_Plne_FlightNo = $_POST['S_Plne_FlightNo'];
  $statuss = $_POST['statuss'];
  $sorts = $_POST['sorts'];
  */
  ?>
<?php
require_once('tcpdf_include.php');
//$PNR = @$_GET["PNR"];
$PNR = "WHE7VI|1";
$sql3 = "SELECT * FROM booking WHERE `booking`.`PNR` = '$PNR' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_Bag_Count = $row["Booking_Bag_Count"];
	  $GLOBALS['Booking_Bag_Count'] = $row["Booking_Bag_Count"];
	  $Bag_Codes = explode(" ",$row["Bag_Codes"]);
	  $GLOBALS['Bag_Codes'] = $Bag_Codes["0"];
	  $Booking_FlightNo = $row["Booking_FlightNo"];
	  $GLOBALS['FlightID'] = FlightNoID($row["Booking_FlightNo"]);
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
		$GLOBALS['Plne_Arrival_Code'] = $row["Plne_Arrival_Code"];
		$Plne_Gate = $row["Plne_Gate"];
		$Plne_BoadingTime = CutTime($row["Plne_BoadingTime"]);
		$ShowDate = changeDateEN($row["Plne_Arrival_DateTime"]); 
		$GLOBALS['ShowDate'] = $ShowDate;
		//$GLOBALS['z'] = 
      }
	}
/*
class MYPDF extends TCPDF {
	public function Header() {
		$sss =$GLOBALS['ShowDate'];
		$Booking_Bag_Count = $GLOBALS['Bag_Codes'];
		$Plne_Arrival_Code = $GLOBALS['Plne_Arrival_Code'];
		$FlightID = $GLOBALS['FlightID'];
		$style = array(
			'border' => 0,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);

		//$this->Image('images/LOGOairline.png', 5, 3,60, 15, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
		$this->SetFont('thsarabun', 'B', 15);

	//	$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
	//	$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$txt1 = <<<EOD
		$sss   $Booking_Bag_Count
		TO : $Plne_Arrival_Code  $FlightID
		EOD;
$this->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$this->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 40, 0, 15, 15, $style, 'N');
$this->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$this->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 40, 15, 15, 15, $style, 'N');
$this->SetFont('thsarabun', 'i', 18);
	}
}
*/
class MYPDF extends TCPDF {
	public function Header() {
	}
}
$width = 56;  
//$width = 500; 
$height = 330;
$pageLayout = array($width, $height);
$pdf = new MYPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetMargins( 0,0,0 );

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('thsarabun', '', 18);
$pdf->AddPage();
// ---------------------------------------------------------
$sss =$GLOBALS['ShowDate'];
		$Booking_Bag_Count = $GLOBALS['Bag_Codes'];
		$Plne_Arrival_Code = $GLOBALS['Plne_Arrival_Code'];
		$FlightID = $GLOBALS['FlightID'];
		$style2 = array(
			'border' => 0,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);

		//$this->Image('images/LOGOairline.png', 5, 3,60, 15, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
		$pdf->SetFont('thsarabun', 'B', 15);

	//	$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
	//	$this->Cell(0, 15,"รายงานผู้โดยสารเที่ยวบินที่  ".FlightNoID($S_Plne_FlightNo)."วันที่ ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$txt1 = <<<EOD
		$sss   $Booking_Bag_Count
		TO : $Plne_Arrival_Code  $FlightID
		EOD;
$pdf->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 40, 0, 15, 15, $style2, 'N');
$pdf->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 40, 15, 15, 15, $style2, 'N');
$pdf->SetFont('thsarabun', 'i', 18);
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);
$pdf->write1DBarcode($GLOBALS['Bag_Codes'], 'C39', 0,60, 55, 30,10, $style, 'N');
$pdf->StartTransform();
$pdf->Rotate(90, 50, 50);
//$pdf->write2DBarcode($PNR, 'PDF417', -100, -1, 150, 50,$style, 'N');
$pdf->write1DBarcode($GLOBALS['Bag_Codes'], 'C39', -50,2, 60, 50,2, $style, 'N');
//$pdf->Cell(0, 0, 'CODE 39 EXTENDED', 0, 1);
//  ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();
$pdf->Image('images/LOGOTag90.jpg', 18, 160,20, 35, 'JPG', '', 'F', false, 1, '', false, false, 0, false, false, false);
//$pdf->Image('images/LOGOTag90.png', 5, 160,40, 60, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);

$pdf->Output('example_004.pdf', 'I');