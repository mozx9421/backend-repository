<?php
include('connect.php');
$product_id = $_REQUEST["product_id"];
$upstatus = 'เปิดการขาย';
$sqlpro = "UPDATE product set product_status='$upstatus' WHERE product_id ='$product_id'";
$sqlname ="SELECT product_name FROM product WHERE product_id ='$product_id'";
$resultname = mysqli_query($conn,$sqlname);
$resultpro = mysqli_query($conn, $sqlpro);
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('เปิดการใช้งาน $product_id เเล้ว');";
	echo "window.location = 'product.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>