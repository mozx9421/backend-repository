<?php
require_once('tcpdf_include.php');
/*class MYPDF extends TCPDF {
	public function Header() {
		$image_file = K_PATH_IMAGES.'BUS.png';
		$this->Image($image_file, 1, 1, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetFont('helvetica', 'B', 20);
		$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}*/
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$width = 466;  
$height = 175; 
$pageLayout = array($width, $height);
$pdf = new TCPDF('L', 'pt', $pageLayout, true, 'UTF-8', false);
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('บนสุด');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
/*
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
*/
//$pdf->SetFont('freeserif', 'BI', 12);
$pdf->SetFont('thsarabun', 'BI', 12);
$pdf->AddPage();
$txt = <<<EOD
ยากชิบหายยยยยยยยยยยยยยยยยยย
กราบสวัสดี อิอิ อุอุ page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
EOD;
$image_file = K_PATH_IMAGES.'BUS.png';
$pdf->Image($image_file, 1, 1, 50, '', 'PNG', '', 'F', false, 300, '', false, false, 0, false, false, false);
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->Output('Booking.pdf', 'I');