<?php
include('connect.php');
$ctg_id  = $_REQUEST["ctg_id"];
$sqlcat = "DELETE FROM category WHERE ctg_id ='$ctg_id'";
$resultcat = mysqli_query($conn, $sqlcat) or die ("Error in query: $sqlcat " . mysqli_error());
	if($resultcat){
	echo "<script type='text/javascript'>";
	echo "alert('ลบข้อมูลสำเร็จ"." $ctg_id ');";
	echo "window.location = 'category.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>