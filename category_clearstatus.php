<?php
include('connect.php');
$ctg_id = $_REQUEST["ctg_id"];
$upstatus = 'กำลังใช้งาน';
$sqlpro = "UPDATE category set ctg_status='$upstatus' WHERE ctg_id ='$ctg_id'";
$sqlname ="SELECT ctg_name FROM category WHERE ctg_id ='$ctg_id'";
$resultname = mysqli_query($conn,$sqlname);
$resultpro = mysqli_query($conn, $sqlpro);
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('เปิดการใช้งาน $ctg_id เเล้ว');";
	echo "window.location = 'category.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>