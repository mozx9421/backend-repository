<?php
//-----เชื่อมต่อฐานข้อมูล-----
$host = "localhost"; // ชื่อ host
$username = "root"; // ชื่อ user ที่ใช้ในการ login
$password = ""; // ชื่อ password ที่ใช้ในการ login
//$dbname = "u138001729_BNlSd"; // ชื่อ database
$dbname = "backend_dbtest"; // ชื่อ database

//-----คำสั่ง connect-----
$conn_test = mysqli_connect($host,$username,$password,$dbname) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); //คำสั่งเชื่อมต่อฐานข้อมูล
mysqli_query($conn_test, 'set names utf8'); //กำหนด charset ให้ฐานช้อมูล เพื่ออ่านภาษาไทยได้
?>