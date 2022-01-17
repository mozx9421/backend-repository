<?php
include('connect.php');

$emp_idcardnum = $_POST["emp_idcardnum"];
$emp_tel = $_POST["emp_tel"];

$user_check_query = "SELECT * FROM emp_data WHERE emp_idcardnum = '$emp_idcardnum' AND emp_tel = '$emp_tel' ";
    $query = mysqli_query($conn,$user_check_query);
    $check = mysqli_fetch_assoc($query);
    if($check == true){ 
		$emp_idcardnum = $_POST["emp_idcardnum"];
		$emp_tel = $_POST["emp_tel"];

	echo "<script type='text/javascript'>";
	echo "alert('Update Succesfuly');";
	echo "window.location = 'newpass.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to Update again');";
        echo "window.location = 'lostpass.php'; ";
	echo "</script>";
}
?>