<?php
include('connect.php');
$errors = array();
session_start();
if (empty($_POST['forgot_username']) || empty($_POST['idcardnum'])) {
    echo "<script>
        alert(' ชื่อผู้ใช้ หรือ บัตรประจำตัวประชาชนไม่ถูกต้อง ');
        window.location.replace('forgot_password.php');
        </script>";
} else {

    $username = $_POST['forgot_username'];
    $idcard = $_POST['idcardnum'];

    // echo $username;
    // echo ",,";
    // echo $idcard;
    // ",,";


    $query = "SELECT * FROM emp_data WHERE emp_username ='$username' AND  emp_idcardnum = '$idcard'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        // echo $username;
        // echo  $row['emp_level'];
        // echo ",,";
        // echo $row['emp_name'];
        // echo ",,";
        // echo  $row['emp_surname'];
        // echo ",,";
        // echo  $row['emp_id'];
        // echo ",,";
        // echo  $row['emp_password'];


        $_SESSION['username'] = $username;
        $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";
        $_SESSION['emp_level'] = $row['emp_level'];
        $_SESSION['emp_name'] = $row['emp_name'];
        $_SESSION['emp_surname'] = $row['emp_surname'];
        $_SESSION['emp_id'] = $row['emp_id'];

        echo "<script>
                    window.location.replace('forgot_passedit.php');
                    </script>";

    } else {
        echo "<script>
                        alert('ชื่อผู้ใช้ หรือ บัตรประจำตัวประชาชน ไม่ถูกต้อง ');
                        window.location.replace('forgot_password.php');
                        </script>";
    }
}
