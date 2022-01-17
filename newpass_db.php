<?php
include('connect.php');

$emppass1 = $_POST['$emppass1'];
$emppass2 = $_POST['$emppass2'];

if($password_1 != $password_2){
    array_push($error,"กรุณาระบุรหัสผ่านให้ตรงกัน");
}
?>