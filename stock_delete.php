<!--ยังไม่ได้ใช้ มีเผื่อไว้-->
<?php
include('connect.php');
$stock_id = $_REQUEST["stock_id"];
$sqlsto = "DELETE FROM stock WHERE stock_id ='$stock_id'";
$resultsto = mysqli_query($conn, $sqlsto) or die ("Error in query: $sqlsto " . mysqli_error());
	if($resultsto){
	echo "<script type='text/javascript'>";
	echo "alert('ลบข้อมูลสำเร็จ"." $stock_id ');";
	echo "window.location = 'stock_in.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>