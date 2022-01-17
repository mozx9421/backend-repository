<?php
    include('connect.php');
    $error = array();

    if(isset($_POST['save'])){
        $product_name = mysqli_real_escape_string($conn,$_POST['product_name']);
        $ctg_id = mysqli_real_escape_string($conn,$_POST['ctg_id']);
        $unit_id = mysqli_real_escape_string($conn,$_POST['unit_id']);
        $product_id = $_POST['product_id'];
        
        if(empty($product_name)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }

        $user_check_query = "SELECT * FROM product WHERE product_name = '$product_name' ";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result){  
            if ($result['product_name'] === $product_name){
                echo "<script> alert ('สินค้า $product_name ถูกใช้งานเเล้ว');
                window.location='product.php'; </script>";
            }
        }   
            else
        {     
            $sql = "INSERT INTO product (product_id,product_name,ctg_id,unit_id) VALUE ('$product_id','$product_name','$ctg_id','$unit_id')";

            if(mysqli_query($conn,$sql)){ 
                echo "<script> alert ('บันทึกลงฐานข้อมูลสำเร็จ');
                    window.location.replace('product.php'); </script>";  
            }
                else
            {
                echo "<script> alert ('ผิดพลาด : ')$sql1 mysqli_error($conn);
                    window.location.replace('product.php'); </script>";
            } 
        }
    }
?>