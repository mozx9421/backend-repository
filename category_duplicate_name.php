<?php
    include('connect.php');
    $error = array();

    if(isset($_POST['save'])){
        $ctg_name = mysqli_real_escape_string($conn,$_POST['ctg_name']);
        $ctg_id = $_POST['ctg_id'];
        
        if(empty($ctg_name)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }

        $user_check_query = "SELECT * FROM category WHERE ctg_name = '$ctg_name' ";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result){  
            if ($result['ctg_name'] === $ctg_name){
                echo "<script> alert ('หมวดหมู่ $ctg_name ถูกใช้งานเเล้ว');
                window.location='category.php'; </script>";
            }
        }   
            else
        {     
            $sql = "INSERT INTO category (ctg_id,ctg_name) VALUE ('$ctg_id','$ctg_name')";

            if(mysqli_query($conn,$sql)){ 
                echo "<script> alert ('บันทึกลงฐานข้อมูลสำเร็จ');
                    window.location.replace('category.php'); </script>";  
            }
                else
            {
                echo "<script> alert ('ผิดพลาด : ')$sql1 mysqli_error($conn);
                    window.location.replace('category.php'); </script>";
            } 
        }
    }
?>