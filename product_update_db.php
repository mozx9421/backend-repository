<?php
include('connect.php');
if($_POST["product_id"]==''){
echo "<script type='text/javascript'>"; 
echo "alert('Error Contact Admin !!');"; 
echo "window.location = 'product.php'; "; 
echo "</script>";
}
	$product_id = $_POST["product_id"];
	$product_name = $_POST["product_name"];
	$ctg_id = $_POST["ctg_id"];
	$unit_id = $_POST["unit_id"];
	
	$sql = "UPDATE product SET product_name='$product_name',ctg_id='$ctg_id',unit_id='$unit_id'
			WHERE product_id='$product_id' ";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
mysqli_close($conn);

	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Update Succesfuly');";
	echo "window.location = 'product.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to Update again');";
        echo "window.location = 'product.php'; ";
	echo "</script>";
}
?>