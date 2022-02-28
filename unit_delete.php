<?php
include('connect.php');
$unit_id = $_REQUEST["unit_id"];
$upstatus = 'ปิดการใช้งาน';
$sqlpro = "UPDATE unit SET unit_status='$upstatus' WHERE unit_id ='$unit_id'";
$resultpro = mysqli_query($conn, $sqlpro) ;
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('ปิดการใช้งาน $unit_id สำเร็จ');";
	echo "window.location = 'unit.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>