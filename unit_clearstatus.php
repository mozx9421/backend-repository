<?php
include('connect.php');
$unit_id = $_REQUEST["unit_id"];
$upstatus = 'กำลังใช้งาน';
$sqlpro = "UPDATE unit set unit_status='$upstatus' WHERE unit_id ='$unit_id'";
$sqlname ="SELECT unit_name FROM unit WHERE unit_id ='$unit_id'";
$resultname = mysqli_query($conn,$sqlname);
$resultpro = mysqli_query($conn, $sqlpro);
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('เปิดการใช้งาน $unit_id เเล้ว');";
	echo "window.location = 'unit.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>