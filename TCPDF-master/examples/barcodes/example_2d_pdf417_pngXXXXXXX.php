<?php
require_once(dirname(__FILE__).'/tcpdf_barcodes_2d_include.php');
$barcodeobj = new TCPDF2DBarcode('OMGS', 'PDF417');
$barcodeobj->getBarcodePNG(4, 4, array(0,0,0));
?>