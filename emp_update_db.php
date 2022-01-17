<?php
include('connect.php');
if($_POST["emp_id"]==''){
echo "<script type='text/javascript'>"; 
echo "alert('Error Contact Admin !!');"; 
echo "window.location = 'emp.php'; "; 
echo "</script>";
}
	$emp_id = $_POST["emp_id"];
	$emp_name = $_POST["emp_name"];
    $emp_surname = $_POST["emp_surname"];
    $emp_level = $_POST["emp_level"];
    $emp_username = $_POST["emp_username"];
    //$emp_password = $_POST["emp_password"]; emp_password='$emp_password',
    $emp_idcardnum = $_POST["emp_idcardnum"];
    $emp_age = $_POST["emp_age"];
    $emp_gender = $_POST["emp_gender"];
    $emp_tel = $_POST["emp_tel"];
	
	$sql = "UPDATE emp_data SET emp_name='$emp_name',emp_surname='$emp_surname',emp_level='$emp_level',emp_username='$emp_username',
                                emp_idcardnum='$emp_idcardnum',emp_age='$emp_age',emp_gender='$emp_gender',emp_tel='$emp_tel'
			WHERE emp_id='$emp_id' ";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($conn);

	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Update Succesfuly');";
	echo "window.location = 'emp.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to Update again');";
        echo "window.location = 'emp.php'; ";
	echo "</script>";
}
?>