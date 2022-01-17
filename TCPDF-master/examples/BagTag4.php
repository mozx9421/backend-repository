<?php
  include '../../connectDB.php';
  include '../../Function.php';
  ?>
<?php
require_once('tcpdf_include.php');
//$PNR = @$_GET["PNR"];
$PNR = "WHE7VI|2";
//$PNR = "SH8WHJ|1";

$sql3 = "SELECT * FROM booking WHERE `booking`.`PNR` = '$PNR' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_Bag_Count = $row["Booking_Bag_Count"];
	  $Booking_SEQ = $row["Booking_SEQ"];
	  $Booking_Passenger = explode(" ",$row["Booking_Passenger"]);
	  $PassName = $Booking_Passenger[2].'/'.$Booking_Passenger[1];
	  if($Booking_Bag_Count>0){
		$Weight1_3["0"] = $row["Booking_Bag_One_Weight"];
	  }
	  if($Booking_Bag_Count>1){
		$Weight1_3["1"] = $row["Booking_Bag_Two_Weight"];
	  }
	  if($Booking_Bag_Count>2){
		$Weight1_3["2"] = $row["Booking_Bag_Three_Weight"];
	  }
	  $Bag_Codes = explode(" ",$row["Bag_Codes"]);
	  $Booking_FlightNo = $row["Booking_FlightNo"];
	  $PNR = $row["PNR"];
	  $PNR2 = CutPNR($PNR);
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
		$Arrival_Code = $row["Plne_Arrival_Code"];
		$Plne_Gate = $row["Plne_Gate"];
		$Plne_BoadingTime = CutTime($row["Plne_BoadingTime"]);
		$ShowDate = changeDateEN($row["Plne_Arrival_DateTime"]); 
      }
	}
class MYPDF extends TCPDF {
	public function Header() {
	}
	public function Footer() {
	}
}
$width = 56;  
$height = 330;
$pageLayout = array($width, $height);
$pdf = new MYPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetTitle('ฺBagTag');
$pdf->SetMargins( 0,0,0 );

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('thsarabun', '', 18);
for($i=0;$i<$Booking_Bag_Count;$i++){
// ---------------------------------------------------------
$Arrival_Code_AND_BAG = $Arrival_Code.' '.$Bag_Codes["$i"];
$pdf->AddPage();
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);
//---------------------------------อันเล็ก 2 อัน--------------------------------------------------------------------------------------
	$pdf->SetFont('thsarabun', 'B', 11);
	$Bag_Codesi = $Bag_Codes["$i"];
	$txt1 = <<<EOD
	  $ShowDate   $Bag_Codesi
	  TO : $Arrival_Code  $FlightNo
	  VIA :
	EOD;
$pdf->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$pdf->write2DBarcode($Bag_Codesi, 'QRCODE,L', 40, 0, 15, 15, $style, 'N');
$pdf->Write(0, $txt1, '', 0, 'l', true, 0, false, false, 0);
$pdf->write2DBarcode($Bag_Codesi, 'QRCODE,L', 40, 15, 15, 15, $style, 'N');
//-----------------------------------------------------------------------------------------------------------------------
$pdf->SetFont('thsarabun', 'B', 18);
$pdf->StartTransform();
$pdf->Rotate(180, 23, 36);
$pdf->Write(0, $Arrival_Code_AND_BAG, '', 0, 'l', true, 0, false, false, 0);
$pdf->StopTransform();
$pdf->write1DBarcode($Bag_Codesi, 'C39', 3,40, 50, 25,1, $style, 'N');
$pdf->StartTransform();
$pdf->Rotate(90, 0, 0);
$pdf->write1DBarcode($Bag_Codesi, 'C39', -98,4, 35, 47,10, $style, 'N');
                                          //  ขึ้น,ขวา,ขยายขึ้น,ขวา
$pdf->StopTransform();
$pdf->SetFont('thsarabun', 'B', 23);
$pdf->StartTransform();
$pdf->Rotate(180, 26, 85);
$pdf->Write(0,'_______________', '', 0, 'l', true, 0, false, false, 0);
$pdf->Write(0,'FLT NO : ', '', 0, 'l', true, 0, false, false, 0);
$pdf->StopTransform();
$pdf->SetFont('thsarabun', 'B', 20);
$pdf->StartTransform();
$pdf->Rotate(90, 20, 89);
$pdf->Write(0,'VIA', '', 0, 'l', true, 0, false, false, 0);
$pdf->StopTransform();
$pdf->StartTransform();
$pdf->Rotate(180, 26, 112);
$pdf->Write(0,'__________________', '', 0, 'l', true, 0, false, false, 0);
$pdf->Write(0,'FLT NO : '.$FlightNo, '', 0, 'l', true, 0, false, false, 0);
$pdf->StopTransform();
$pdf->StartTransform();
$pdf->Rotate(180, 26, 118);
$pdf->SetFont('thsarabun', 'B', 75);
$pdf->Write(0,' '.$Arrival_Code, '', 0, 'l', true, 1, false, false, 0);
$pdf->StopTransform();
$pdf->StartTransform();
$pdf->Rotate(90, -6, 141);
$pdf->Write(0,'TO', '', 0, 'l', true, 0, false, false, 0);
$pdf->StopTransform();
$pdf->SetFont('thsarabun', 'l', 16);
$pdf->StartTransform();
$pdf->Rotate(270, 21, 163);
$pdf->Write(0,$PassName, '', 0, 'l', true, 0, true, false, 0);
$pdf->Write(0,'           '.$Arrival_Code_AND_BAG, '', 0, 'c', false, 0, false, false, 0);
$pdf->StopTransform();
$pdf->StartTransform();
$pdf->Rotate(90, 27, 168);
$RIMage = "$Plne_Departure_DateTime"."PNRNO"."$PNR2"."SEQ-$Booking_SEQ";
$pdf->Write(0,$RIMage, '', 0, 'c', true, 0, false, false,0);
$pdf->Write(0,'       '.$Arrival_Code_AND_BAG, '', 0, 'c', false, 0, false, false, 0);
$pdf->StopTransform();



$pdf->SetFont('thsarabun', 'B', 20);
//$pdf->Cell(0, -5, '', 0, 1, 'C', 0, '', 0);
$pdf->Write(0,'____________________', '', 0, 'l', true, 0, false, true, 0);
$pdf->Write(0,'  FLT NO : '.$FlightNo, '', 0, 'l', true, 0, false, false, 0);
$pdf->StartTransform();
$pdf->Rotate(-90, 31, 234);
$pdf->Write(0,'TO            VIA', '', 0, 'c', true, 0, true, false, 0);
$pdf->StopTransform();
$pdf->SetFont('thsarabun', 'B', 75);
$pdf->Text(10, 199, $Arrival_Code);
$pdf->SetFont('thsarabun', 'B', 20);
$pdf->Text(2, 220, '___________________');
$pdf->Text(2, 226, ' FLT NO : ');
$pdf->Write(0,' '.$Arrival_Code, '', 0, 'l', false, 1, false, false, 0);
$pdf->StartTransform();
$pdf->Rotate(90, 0, 0);
$pdf->write1DBarcode($Bag_Codesi, 'C39', -270,4, 35, 47,10, $style, 'N');
                                          //  ขึ้น,ขวา,ขยายขึ้น,ขวา
$pdf->StopTransform();
$pdf->write1DBarcode($Bag_Codesi, 'C39', 3,268, 50, 25,1, $style, 'N');
$pdf->Text(8, 289, $Arrival_Code_AND_BAG);
$pdf->Text(8, 294, 'Bag Weight : '.$Weight1_3["$i"].' KG');
$pdf->Text(8, 301, 'Limited Release□');


$pdf->Image('images/LOGOTag90.jpg', 18, 145,20, 35, 'JPG', '', 'F', false, 1, '', false, false, 0, false, false, false);
}
$pdf->Output('example_004.pdf', 'I');