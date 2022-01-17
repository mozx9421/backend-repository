<?php
include('connect.php');
$unit_id = $_REQUEST["unit_id"];
$sqlunit = "DELETE FROM unit WHERE unit_id ='$unit_id'";
$resultunit = mysqli_query($conn, $sqlunit) or die ("Error in query: $sqlunit " . mysqli_error());
	if($resultunit){
	echo "<script type='text/javascript'>";
	echo "alert('ลบข้อมูลสำเร็จ"." $unit_id ');";
	echo "window.location = 'unit.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>