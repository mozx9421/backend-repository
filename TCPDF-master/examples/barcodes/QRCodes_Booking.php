<?php
$PNR = @$_GET["PNR"];
//$PNR = "XXXCCCC";
require_once(dirname(__FILE__).'/tcpdf_barcodes_2d_include.php');
//echo dirname(__FILE__);
$barcodeobj = new TCPDF2DBarcode($PNR, 'QRCODE,H');
echo '<br><br><br><br><br><center>'.$barcodeobj->getBarcodeHTML(15, 15, 'black').'</center>';
echo '<br><br><center> PNR : '.$PNR.'</center>';
echo '<form method="post" action="..\..\..\Booking.php"><br><center><input type="submit" name="bk" id="bk" value="Return to booking page" ></center></form> ';
