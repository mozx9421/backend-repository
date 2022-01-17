<?php
include('connect.php');
if($_POST["ctg_id"]==''){
echo "<script type='text/javascript'>"; 
echo "alert('Error Contact Admin !!');"; 
echo "window.location = 'category.php'; "; 
echo "</script>";
}
	$ctg_id = $_POST["ctg_id"];
	$ctg_name = $_POST["ctg_name"];
	
	$sql = "UPDATE category SET ctg_name='$ctg_name'
			WHERE ctg_id='$ctg_id' ";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
mysqli_close($conn);

	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Update Succesfuly');";
	echo "window.location = 'category.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to Update again');";
        echo "window.location = 'category.php'; ";
	echo "</script>";
}
?>