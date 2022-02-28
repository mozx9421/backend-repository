<?php
//insert
include('connect.php');
date_default_timezone_set('Asia/Bangkok');

$query2 = "SELECT * FROM stock WHERE stock_id LIKE 'I%' ORDER BY runid DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);
$rs = mysqli_fetch_array($result2);
$time = date("Y-m-d H:i:s");

$query3 = "SELECT * FROM stock WHERE stock_id LIKE 'D%' ORDER BY runid DESC LIMIT 1";
$result3 = mysqli_query($conn, $query3);
$rs1 = mysqli_fetch_array($result3);

//cc



// insert data
foreach ($_POST["data"] as $item) {
  //1A
  if ($item["stock_status"] == "ปรับเพิ่มสินค้า") {

    if(isset($rs1['stock_id'])){
    if ($rs['stock_id'] != "") {
      $check = substr($rs['stock_id'], 1, 2);
      $date =  date("y") + 43;

      if ($check == $date) {
        $sub = substr($rs['stock_id'], 3, 8) + 1;
        $name = sprintf('I' . $date . sprintf("%'.005d\n", $sub));
      } else {
        $name = "I" . $date . "00001";
      }
    }
    } else {
      $date =  date("y") + 43;
      $name = "I" . $date . "00001";
    }

    $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count,stock_comment)
        VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]','$item[stock_comment]')";
    if (mysqli_query($conn, $sql)) {
      $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
      $result_sql2 = mysqli_query($conn, $sql2);
      $rs_2 = mysqli_fetch_array($result_sql2);

      $qty = $rs_2['product_qty'] + $item['product_qty'];
      //update qty
      $sql3 = "UPDATE product SET product_qty = '$qty' WHERE product_id ='$item[product_id]'";
      mysqli_query($conn, $sql3);
    }
  // } else if ($item["stock_status"] == "ปรับลดสินค้า") {
  //   //1B

  //   $word = "";
  //   $para = "";
  //   // foreach ($_POST["data"] as $item) {
  //     $sqlcheck = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
  //     $result_sqlcheck = mysqli_query($conn, $sqlcheck);
  //     $rs_check = mysqli_fetch_array($result_sqlcheck);
  //     if ($item['product_qty'] <= $rs_check['product_qty']) {
  //       $word .= "1";
  //     } else {
  //       $word .= "0";
  //     }

  //     if (strpos($word, "0") == "") {
  //       $para = "1";
  //     } else {
  //       echo "0";
  //       return false;
  //     }
  //   // }

  //   if ($rs1['stock_id'] != "") {
  //     $check = substr($rs1['stock_id'], 1, 2);
  //     $date =  date("y") + 43;

  //     if ($check == $date) {
  //       $sub = substr($rs1['stock_id'], 3, 6) + 1;
  //       $name = sprintf('D' . $date . sprintf("%'.003d\n", $sub));
  //     } else {
  //       $name = "D" . $date . "001";
  //     }
  //   } else {
  //     $date =  date("y") + 43;
  //     $name = "D" . $date . "001";
  //   }
  //   $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count ,stock_comment)
  //       VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]','$item[stock_comment]')";
  //   if (mysqli_query($conn, $sql)) {
  //     $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
  //     $result_sql2 = mysqli_query($conn, $sql2);
  //     $rs_2 = mysqli_fetch_array($result_sql2);
  //     $qty = $rs_2['product_qty'] - $item['product_qty'];


  //     if ($item['product_qty'] <= $rs_2['product_qty']) {
        

  //       $sql4 = "UPDATE product SET product_qty = '$qty' WHERE product_id ='$item[product_id]'";
       
  //   } else {
  //       //none
  //   }
      

  //     if ($para == "1") {
  //       $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count ,stock_comment)
  //       VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]','$item[stock_comment]')";      
      
  //       mysqli_query($conn, $sql);
  //       mysqli_query($conn, $sql4);
  //     }
      
  //   }
  //   // echo "1";
  // } else if ($item["stock_status"] == "เคลม") {
  //   // foreach ($_POST["data"] as $item) {
  //   //1C
  //   //check qty
  //   $word = "";
  //   $para = "";
  //     $sqlcheck = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
  //     $result_sqlcheck = mysqli_query($conn, $sqlcheck);
  //     $rs_check = mysqli_fetch_array($result_sqlcheck);
  //     if ($item['product_qty'] <= $rs_check['product_qty']) {
  //       $word .= "1";
  //     } else {
  //       $word .= "0";
  //     }

  //     if (strpos($word, "0") == "") {
  //       $para = "1";
  //     } else {
  //       echo "0";
  //       return false;
  //     }
  //   // }
    

  //   if ($rs1['stock_id'] != "") {
  //     $check = substr($rs1['stock_id'], 1, 2);
  //     $date =  date("y") + 43;

  //     if ($check == $date) {
  //       $sub = substr($rs1['stock_id'], 3, 6) + 1;
  //       $name = sprintf('C' . $date . sprintf("%'.003d\n", $sub));
  //     } else {
  //       $name = "C" . $date . "001";
  //     }
  //   } else {
  //     $date =  date("y") + 43;
  //     $name = "C" . $date . "001";
  //   }
  //     $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
  //     $result_sql2 = mysqli_query($conn, $sql2);
  //     $rs_2 = mysqli_fetch_array($result_sql2);
  //     $qty = $rs_2['product_qty'] - $item['product_qty'];

  //     if ($item['product_qty'] <= $rs_2['product_qty']) {
        

  //       $sql5 = "UPDATE product SET product_qty = '$qty' WHERE product_id ='$item[product_id]'";
       
  //   } else {
  //       //none
  //   }
    
  //   if ($para == "1") {
  //     $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count ,stock_comment)
  //     VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]','$item[stock_comment]')";     
  //     mysqli_query($conn, $sql);
  //     mysqli_query($conn, $sql5);
      
  //   } 
    
  }

}  echo 1;
