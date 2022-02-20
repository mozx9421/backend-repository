<?php
include('connect.php');
$product_id = $_REQUEST["product_id"];
$upstatus = 'ปิดการขาย';
$sqlpro = "UPDATE product SET product_status='$upstatus' WHERE product_id ='$product_id'";
$resultpro = mysqli_query($conn, $sqlpro) ;
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('ปิดการใช้งาน $product_id สำเร็จ');";
	echo "window.location = 'product.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>