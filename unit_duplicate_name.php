<?php
    include('connect.php');
    $error = array();
    $status = "กำลังใช้งาน";
    if(isset($_POST['save'])){
        $unit_id = $_POST['unit_id'];
        $unit_name = mysqli_real_escape_string($conn,$_POST['unit_name']);
        $unit_pack = $_POST['unit_pack'];
        $unit_piece = $_POST['unit_piece'];
        if(empty($unit_name)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        $user_check_query = "SELECT * FROM unit WHERE unit_name = '$unit_name' ";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);
        if ($result){  
            if ($result['unit_name'] === $unit_name){
                echo "<script> alert ('หน่วยนับ $unit_name ถูกใช้งานเเล้ว');
                window.location='unit.php'; </script>";
            }
        }   
        else
        {     
            $sql = "INSERT INTO unit (unit_id,unit_name,unit_pack,unit_piece,unit_status) VALUE ('$unit_id','$unit_name','$unit_pack','$unit_piece','$status')";
            if(mysqli_query($conn,$sql)){ 
                echo "<script> alert ('บันทึกลงฐานข้อมูลสำเร็จ');
                    window.location.replace('unit.php'); </script>";  
            }
            else
            {
                echo "<script> alert ('ผิดพลาด : ')$sql1 mysqli_error($conn);
                    window.location.replace('unit.php'); </script>";
            } 
        }
    }
?>