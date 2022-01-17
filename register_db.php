<?php
    session_start();
    include('connect.php');
    $error = array();

    if(isset($_POST['regist'])){
        $realname = mysqli_real_escape_string($conn,$_POST['realname']);
        $surname = mysqli_real_escape_string($conn,$_POST['surname']);
        $idcard = mysqli_real_escape_string($conn,$_POST['cardnumber']);
        $level = mysqli_real_escape_string($conn,$_POST['level1']);
        $age = mysqli_real_escape_string($conn,$_POST['age']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password_1 = mysqli_real_escape_string($conn,$_POST['password1']);
        $password_2 = mysqli_real_escape_string($conn,$_POST['password2']);
        $emp_id = $_POST['emp_id'];

        
        if(empty($realname)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($surname)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($idcard)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($age)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($gender)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }

        if(empty($username)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($password_1)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if(empty($password_2)){
            array_push($error,"กรุณาระบุข้อมูลให้ครบ");
        }
        if($password_1 != $password_2){
            array_push($error,"กรุณาระบุรหัสผ่านให้ตรงกัน");
        }

        $user_check_query = "SELECT * FROM emp_data WHERE emp_username = '$username' OR emp_name = '$realname'";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

        // Check ข้อมูล 
        if ($result){  
            if ($result['emp_username'] === $username){
                echo "<script>
                alert('Username นี้ถูกใช้งานเเล้ว');
                window.location='register_page.php';
                </script>";
            }
            if ($result['emp_name'] === $realname){
                echo "<script>
                alert('ชื่อบุคคลนี้ถูกใช้งานเเล้ว');
                window.location='register_page.php';
                </script>";
            }
        }   
        else{
            $password = md5($password_1);
            $sql = "INSERT INTO emp_data (emp_id,emp_name,emp_surname,emp_level,emp_username,emp_password,emp_idcardnum,emp_age,emp_gender) 
                    VALUE ('$emp_id','$realname','$surname','$level','$username','$password','$idcard','$age','$gender')";
            if(mysqli_query($conn,$sql)){ 
                $complete = true;
                if($complete === true ){
                    $_SESSION['username'] = $username;
                    $_SESSION['emp_surname'] = $surname;
                    $_SESSION['emp_name'] = $realname;
                    $_SESSION['emp_level'] = $realname;
                    $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
                      if($level == "ผู้จัดการ"){
                    echo "<script> alert('บันทึกข้อมูลสำเร็จ ดำเนินการเข้าสู่ระบบ');
                        window.location.replace('index_manager.php'); </script>";
                   } 
                   else{
                    echo "<script> alert('บันทึกข้อมูลสำเร็จ ดำเนินการเข้าสู่ระบบ');
                    window.location.replace('index_employee.php'); </script>";
                   }
                }        
            }
            else{
                echo "<script> alert('ผิดพลาด : ')$sql1 mysqli_error($conn);
                window.location.replace('register_page.php'); </script>";
            } 
        }
    }
?>