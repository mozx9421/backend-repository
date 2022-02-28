<?php
include('connect.php');
$ctg_id = $_REQUEST["ctg_id"];
$upstatus = 'ปิดการใช้งาน';
$sqlpro = "UPDATE category SET ctg_status='$upstatus' WHERE ctg_id ='$ctg_id'";
$resultpro = mysqli_query($conn, $sqlpro) ;
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('ปิดการใช้งาน $ctg_id สำเร็จ');";
	echo "window.location = 'category.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>