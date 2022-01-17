<?php
include('connect.php');
if($_POST["unit_id"]==''){
echo "<script type='text/javascript'>"; 
echo "alert('Error Contact Admin !!');"; 
echo "window.location = 'unit.php'; "; 
echo "</script>";
}
	$unit_id = $_POST["unit_id"];
	$unit_name = $_POST["unit_name"];
	$unit_pack = $_POST["unit_pack"];
	$unit_piece = $_POST["unit_piece"];
	
	$sql = "UPDATE unit SET unit_name='$unit_name',unit_pack='$unit_pack',unit_piece='$unit_piece'
			WHERE unit_id='$unit_id' ";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($conn);

	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Update Succesfuly');";
	echo "window.location = 'unit.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to Update again');";
        echo "window.location = 'unit.php'; ";
	echo "</script>";
}
?>