<?php
include('connect.php');
session_start();
$empname = $_SESSION['emp_name'];
$emp_id = $_REQUEST["emp_id"];
$upstatus = 'ยกเลิกการใช้งาน';

$sqlcheck = "SELECT emp_name FROM  emp_data WHERE emp_id ='$emp_id'";
$queryemp = mysqli_query($conn,$sqlcheck);
$row = mysqli_fetch_array($queryemp);


if($empname == $row['emp_name']){
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สามารถปิดชื่อผู้ใช้ที่กำลังถูกใช้งานอยู่ได้');";
	echo "window.location = 'emp.php'; ";
	echo "</script>";
}else{
$sqlemp = "UPDATE emp_data SET emp_status='$upstatus' WHERE emp_id='$emp_id'";
$resultemp = mysqli_query($conn, $sqlemp) or die ("Error in query: $sqlemp " . mysqli_error());
	if($resultemp){
	echo "<script type='text/javascript'>";
	echo "alert('อัปเดตข้อมูลสำเร็จ');";
	echo "window.location = 'emp.php'; ";
	echo "</script>";
	// echo $row['emp_name'],  $empname ;

	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สามารถปิดชื่อผู้ใช้ที่กำลังถูกใช้งานอยู่ได้');";
	echo "</script>";
}
}
?>