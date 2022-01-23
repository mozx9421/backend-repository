
<?php 
session_start();
include('connect.php');

if(!isset($_SESSION['emp_id'])){
    echo "<script type='text/javascript'>"; 
    echo "alert('Error: empty session emp_id.');"; 
    echo "window.location = 'forgot_password.php'; ";
    echo "</script>";
    }

    if($_POST['confirm_new_password'] == $_POST['emp_password'] ){
        $emp_password = $_POST['emp_password'];
        $newpassword = $_POST['confirm_new_password'];
        $emp_id = $_SESSION['emp_id'];
        $newpassword = md5($emp_password);
        
        $sql = "UPDATE emp_data SET emp_password='$newpassword'
                WHERE emp_id='$emp_id' ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        mysqli_close($conn);
    
        if($result){
        echo "<script type='text/javascript'>";
        echo "alert('เปลี่ยนรหัสผ่านสำเร็จ');";
        echo "window.location = 'login_page.php'; ";
        echo "</script>";
        session_destroy();
        }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('Error 1');";
            echo "window.location = 'forgot_passedit.php'; ";
        echo "</script>";
    }   
    }else{ 
        echo "<script type='text/javascript'>";
        echo "alert('รหัสผ่านไม่ตรงกัน');";
            echo "window.location = 'forgot_passedit.php'; ";
        echo "</script>";
    }
    
?>