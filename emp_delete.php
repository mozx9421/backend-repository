<?php
include('connect.php');
$emp_id = $_REQUEST["emp_id"];
$sqlemp = "DELETE FROM emp_data WHERE emp_id ='$emp_id'";
$resultemp = mysqli_query($conn, $sqlemp) or die ("Error in query: $sqlemp " . mysqli_error());
	if($resultemp){
	echo "<script type='text/javascript'>";
	echo "alert('ลบข้อมูลสำเร็จ"." $emp_id ');";
	echo "window.location = 'emp.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>