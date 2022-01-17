<?php
require_once('config/lang/eng.php');
require_once('tcpdf.php');
require_once('htmltoolkit.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Siam Apps');
$pdf->SetTitle('http://siam-apps.blogspot.com');
$pdf->SetSubject('Auto Print');
$pdf->SetKeywords('Siam Apps, PDF, Auto Print');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('freeserif', 'N', 16);
?>