<?php
include('connect.php');
$emp_id = $_REQUEST["emp_id"];
$upstatus = 'ยกเลิกการใช้งาน';
$sqlemp = "UPDATE emp_data SET emp_status='$upstatus' WHERE emp_id='$emp_id'";
$resultemp = mysqli_query($conn, $sqlemp) or die ("Error in query: $sqlemp " . mysqli_error());
	if($resultemp){
	echo "<script type='text/javascript'>";
	echo "alert('อัปเดตข้อมูลสำเร็จ');";
	echo "window.location = 'emp.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>