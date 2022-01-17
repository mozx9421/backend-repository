<?php

require_once('tcpdf/setPDF.php'); // เรียกไฟล์ตั้งค่าเบื้องต้นในการสร้างไฟล์ PDF

$resolution= array(139.7, 254); // 10x5.5 inch
$pdf->AddPage('L', $resolution);
$html = <<<EOD
<h1><font style="color: rgb(0, 128, 64);">ทดสอบเขียน PDF</font></h1>
<h2><font style="color: rgb(0, 0, 0);">ทดสอบเขียน PDF</font></h2>
<h3><font style="color: rgb(255, 128, 64);">ทดสอบเขียน PDF</font></h3>
<h4><font style="color: #FFEE99;">ทดสอบเขียน PDF</font></h4>
<h5><font style="color: #FF9900;">ทดสอบเขียน PDF</font></h5>
<h6><font style="color: #CC6699;">ทดสอบเขียน PDF</font></h6>

EOD;

$html=AdjustHTML(stripslashes($html));
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

$pdf->Output('test.pdf', 'F');

$printer = "TSC TDP-247"; // ใส่ชื่อPrinter
exec('SumatraPDF.exe -print-to "'.$printer.'" test.pdf -exit-on-print'); // ส่งไฟล์ PDF ไปยัง Printer โดยใช้ Program SumatraPDF เป็นตัวกลาง

echo "Complete Print <a href=\"test.pdf\" target=_blank>test.pdf</a> to ".$printer;

?>

