<?php
session_start();
include('connect.php');
$error = array();

if (isset($_POST['regist'])) {
    $realname = mysqli_real_escape_string($conn, $_POST['realname']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $idcard = mysqli_real_escape_string($conn, $_POST['cardnumber']);
    $level = mysqli_real_escape_string($conn, $_POST['level1']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $emp_tel = mysqli_real_escape_string($conn, $_POST['emp_tel']);
    // $password_1 = mysqli_real_escape_string($conn, $_POST['password1']);
    // $password_2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $emp_id = $_POST['emp_id'];
    $OTP ='no';



    if ($level != "" || $level != null) {
        if (!is_numeric($realname) && !is_numeric($surname) && is_numeric($idcard) && is_numeric($age) &&  is_numeric($emp_tel)) {
            //check password
            $newidcard =substr($idcard, -4);
            $newtel =substr($emp_tel, -4);
            $newpassword = $newidcard.$newtel;
            $user_check_query = "SELECT * FROM emp_data WHERE emp_username = '$username' OR emp_name = '$realname'";
            $query = mysqli_query($conn, $user_check_query);
            $result = mysqli_fetch_assoc($query);

            // Check username,name data
            if ($result) {
                if ($result['emp_username'] === $username) {
                    echo "<script>
            alert('Username นี้ถูกใช้งานเเล้ว');
            window.location='register_page.php';
            </script>";
                }
                if ($result['emp_name'] === $realname) {
                    echo "<script>
            alert('ชื่อบุคคลนี้ถูกใช้งานเเล้ว');
            window.location='register_page.php';
            </script>";
                }
            } else {

                $emp_status = 'อยู่ในระบบ';
                $password = md5($newpassword);
                
                $sql = "INSERT INTO emp_data (emp_id,emp_name,emp_surname,emp_level,emp_username,emp_password,emp_idcardnum,emp_age,emp_gender,emp_tel,emp_status,otp) 
                VALUE ('$emp_id','$realname','$surname','$level','$username','$password','$idcard','$age','$gender','$emp_tel','$emp_status','$OTP')";
                if (mysqli_query($conn, $sql)) {
                    $complete = true;
                    if ($complete === true) {
                        $_SESSION['username'] = $username;
                        $_SESSION['emp_surname'] = $surname;
                        $_SESSION['emp_name'] = $realname;
                        $_SESSION['emp_level'] = $realname;
                        $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
                        if ($level == "ผู้จัดการ") {
                            session_destroy();
                            echo "<script> alert('บันทึกข้อมูลสำเร็จ กรุณาเข้าสู่ระบบอีกครั้ง');
                    window.location.replace('login_page.php'); </script>";
                        } else {
                            session_destroy();
                            echo "<script> alert('บันทึกข้อมูลสำเร็จ กรุณาเข้าสู่ระบบอีกครั้ง');
                window.location.replace('login_page.php'); </script>";
                        }
                    }
                } else {
                    echo "<script> alert('ผิดพลาด : ')$sql1 mysqli_error($conn);
            window.location.replace('register_page.php'); </script>";
                }
            }
        } else {
            echo "<script> alert('รหัสผ่านไม่ถูกต้อง..');
    window.location.replace('register_page.php'); 
    </script>";
        }
    } else {
        echo "<script> alert('ข้อมูลไม่ถูกต้อง..');
    window.location.replace('register_page.php'); 
    </script>";
    }
} else {
    echo "<script> alert('ข้อมูลไม่ถูกต้องหรือไม่ครบถ้วน..');
    window.location.replace('register_page.php'); 
    </script>";
}
