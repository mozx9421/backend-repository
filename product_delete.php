<?php
include('connect.php');
$product_id = $_REQUEST["product_id"];
$sqlpro = "DELETE FROM product WHERE product_id ='$product_id'";
$resultpro = mysqli_query($conn, $sqlpro) or die ("Error in query: $sqlpro " . mysqli_error());
	if($resultpro){
	echo "<script type='text/javascript'>";
	echo "alert('ลบข้อมูลสำเร็จ"." $product_id ');";
	echo "window.location = 'product.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สารมารถลบข้อมูลได้');";
	echo "</script>";
}
?>