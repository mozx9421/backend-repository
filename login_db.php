<?php
    session_start();
    include('connect.php');
    $errors = array();
    if(empty($_POST['login_username']) || empty($_POST['login_password'])){
        echo "<script>
        alert('กรุณาใส่ Username เเละ Password เพื่อเข้าสู่ระบบ ');
        window.location.replace('login_page.php');
        </script>";
    } else {
        $username =$_POST['login_username'];
        $password =$_POST['login_password'];
        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM emp_data WHERE emp_username ='$username' AND emp_password = '$password'";
            $result = mysqli_query($conn,$query);
                echo mysqli_num_rows($result);
            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result);
                
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";
                $_SESSION['emp_level'] = $row['emp_level']; 
                $_SESSION['emp_name'] = $row['emp_name'];
                $_SESSION['emp_surname'] = $row['emp_surname'];
                $_SESSION['emp_id'] = $row['emp_id'];

                if($_SESSION['emp_level'] == "ผู้จัดการ"){
                    echo "<script>
                    alert('กำลังเข้าสู่ระบบ.. ');
                    window.location.replace('index_manager.php');
                    </script>";
                
                }
                else{
                    echo "<script>
                    alert('กำลังเข้าสู่ระบบ.. ');
                    window.location.replace('index_employee.php');
                    </script>";
                }
            } else {
                echo "<script>
                alert('Username หรือ Password ไม่ถูกต้อง ');
                window.location.replace('login_page.php');
                </script>";
            }
        }
    }        
?>