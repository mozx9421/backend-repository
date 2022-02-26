<?php
$idcard = "1100801348789";
$tel = "0956016501";

$newidcard =substr($idcard, -4);
$newtel =substr($tel, -4);
echo $newidcard;
echo " , ";
echo $newtel;
echo " , ";
$newpassword = $newidcard.$newtel;
echo $newpassword;
$hashmd5 = md5($newpassword);
echo " , ";
echo $hashmd5;

include('connect.php');
$otpcheck = 'harvest100';
$sqlotp = "SELECT otp FROM emp_data WHERE emp_username ='$otpcheck'";
$resultotp = mysqli_query($conn, $sqlotp);
while($row = mysqli_fetch_array($resultotp)){
echo " , ";
echo $row['otp'];
}
?>