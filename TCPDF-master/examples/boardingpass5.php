<?php
//require_once('tcpdf_include.php');
require_once('tcpdf/setPDF.php');

$Booking_SEAT_NO = @$_GET["Booking_SEAT_NO"];
$PNR = @$_GET["PNR"];
include '../../connectDB.php';
include '../../Function.php';
$sql = "UPDATE `booking` SET `Booking_SEAT_NO` = '$Booking_SEAT_NO', `Status` = 'checkin' WHERE `booking`.`PNR` = '$PNR'";
$PNR2 = CutPNR($PNR);
if ($conn->multi_query($sql) === TRUE) {	}
$sql3 = "SELECT * FROM booking WHERE `booking`.`PNR` = '$PNR' ";
	$result3 = mysqli_query($conn, $sql3);
	if (mysqli_num_rows($result3) > 0) { while($row = mysqli_fetch_assoc($result3)) {
	  $Booking_SEQ = $row["Booking_SEQ"];
	  $Booking_Class_id = cutdot($row["Booking_Class_id"]);
	  $Booking_Class = strtoupper(cutClass($row["Booking_Class"]));
	  $PNR = $row["PNR"];
	$Booking_Passenger = explode(" ",$row["Booking_Passenger"]);
	$Booking_Passenger_FN = NameP_S_M_N_SUB10410($row["Booking_Passenger"]," /");
    $Booking_FlightNo = $row["Booking_FlightNo"];
    $FlightNo = FlightNoID($Booking_FlightNo);
	}
  }
  $sql2 = "SELECT * FROM manage_plane WHERE `manage_plane`.`Plne_FlightNo` = '$Booking_FlightNo' ";
      $result2 = mysqli_query($conn, $sql2);
      if (mysqli_num_rows($result2) > 0) { while($row = mysqli_fetch_assoc($result2)) {
        $Plne_Departure_Code = strtoupper(cutAirport(SelectAirportName($row["Plne_Departure_Code"]))).'('.$row["Plne_Departure_Code"].')';
        $PDC = $row["Plne_Departure_Code"];
        $Plne_Departure_DateTime = changeDateEN2($row["Plne_Departure_DateTime"]);
		$Plne_Arrival_Code = strtoupper(cutAirport(SelectAirportName($row["Plne_Arrival_Code"]))).'('.$row["Plne_Arrival_Code"].')';
    $PAC = $row["Plne_Arrival_Code"];
    $Plne_Gate = $row["Plne_Gate"];
		$Plne_BoadingTime = CutTime($row["Plne_BoadingTime"]);
      }
	}

$resolution= array(100, 250);
$pdf->AddPage('L', $resolution);

$image_file = 'LOGOairline.png';
$middlename = $Booking_Passenger[3];
$SURN = $Booking_Passenger[2];
$NAMES = $Booking_Passenger[1];
$Pre = strtoupper($Booking_Passenger[0]);
if($middlename == "-99"){
	$middlename = "";
}
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 3, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);
$pdf->StartTransform();
$pdf->Rotate(90, 0, 0);
$pdf->write2DBarcode($PNR, 'PDF417', -80, 23, 65, 50,$style, 'N');
// ขึ้น    ขวา     ขยายขึ้น  ขวา
$pdf->StopTransform();
//$pdf->writeHTML($txt, true, false, false, false, '');
//หัวข้อ
$pdf->SetFont('thsarabun', 'l', 12);
$pdf->Text(55, 22, 'NAME');
$pdf->Text(55, 35, 'FROM');
$pdf->Text(55, 48, 'TO');
$pdf->Text(55, 63, 'PNR');

$pdf->Text(81, 63, 'SEQ. ');
$pdf->Text(100, 63, 'CLASS ');

$pdf->Text(155, 32, 'FIGHT NO ');
$pdf->Text(155, 40, 'DATE ');
$pdf->Text(155, 48, 'BOARDING TIME ');
$pdf->Text(155, 56, 'GATE ');
$pdf->Text(155, 66, 'SEAT ');

//ข้อมูล
$pdf->SetFont('thsarabun', 'B', 20);
//$pdf->Text(55, 25,$Pre.'. '.$SURN.' /'.$NAMES);
$pdf->Text(55, 25,$Booking_Passenger_FN);
$pdf->Text(55, 37,$Plne_Departure_Code);
$pdf->Text(55, 50,$Plne_Arrival_Code);
$pdf->Text(55, 66,$PNR2);

$pdf->Text(81, 66, $Booking_SEQ);
$pdf->Text(100, 66,$Booking_Class_id);
$pdf->Text(155, 10,$Booking_Class);
$pdf->Text(178, 30,$FlightNo);
$pdf->Text(178, 38,$Plne_Departure_DateTime);
$pdf->Text(178, 46,$Plne_BoadingTime);
$pdf->Text(178, 55,$Plne_Gate);
$pdf->Text(178, 64,$Booking_SEAT_NO);

$pdf->SetFont('thsarabun', 'l', 12);
$pdf->Text(209, 12,'Passanger Name:');
$pdf->Text(209, 28,'From:');
$pdf->Text(209, 35,'TO:');
$pdf->Text(209, 43,'Date:');
$pdf->Text(209, 51,'Time:');
$pdf->Text(209, 58,'Seat:');
$pdf->Text(225, 58,'Gate:');
$pdf->Text(209, 65,'Flight:');


//คำนำหน้า. นามสกุล/ชื่อ
$pdf->SetFont('thsarabun', 'B', 18);
$pdf->Text(209, 16,$Pre.'. '.$SURN);
$pdf->Text(209, 20,'/'.$middlename.' /'.$NAMES);
$pdf->Text(218, 26,$PDC);
$pdf->Text(218, 34,$PAC);
$pdf->Text(218, 42,$Plne_Departure_DateTime);
$pdf->Text(218, 50,$Plne_BoadingTime);
$pdf->Text(237, 57,$Plne_Gate);
$pdf->Text(218, 57,$Booking_SEAT_NO);
$pdf->Text(218, 64,$FlightNo);


// $pdf->IncludeJS("print();");

//$pdf->Write(0,'TO', '', 0, 'l', true, 0, false, false, 0);

//$pdf->Image('images/LOGOairline.png', 1, 1,150, 50, 'PNG', '', 'F', false, 1, '', false, false, 0, false, false, false);
//$pdf->Output('example_002.pdf', 'I');
//$pdf->setVisibility('print');
//$pdf->Output('BoardingPass.pdf', 'I');

$pdf->Output('BoardingPass.pdf', 'F');
$printer = "TSC TX200"; // ใส่ชื่อPrinter
//$printer = "TSC TDP-247"; // ใส่ชื่อPrinter
exec('SumatraPDF.exe -print-to "'.$printer.'" BoardingPass.pdf -exit-on-print'); // ส่งไฟล์ PDF ไปยัง Printer โดยใช้ Program SumatraPDF เป็นตัวกลาง

echo "Complete Print <a href=\"BoardingPass.pdf\" target=_blank>BoardingPass.pdf</a> to ".$printer;



?>