<?php
//insert
include('connect.php');
date_default_timezone_set('Asia/Bangkok');

$query2 = "SELECT * FROM stock WHERE stock_id LIKE 'T%' ORDER BY runid DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);
$rs = mysqli_fetch_array($result2);
$time = date("Y-m-d H:i");

//runid
if ($rs['stock_id'] != "") {
    $check = substr($rs['stock_id'], 1, 2);
    $date =  date("y") + 43;

    if ($check == $date) {
        $sub = substr($rs['stock_id'], 3, 8) + 1;
        $name = sprintf('T' . $date . sprintf("%'.005d\n", $sub));
    } else {
        $name = "T" . $date . "00001";
    }
} else {
    $date =  date("y") + 43;
    $name = "T" . $date . "00001";
}

// insert data
$word = "";
$para = "";
foreach ($_POST["data"] as $item) {
    $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
    $result_sql2 = mysqli_query($conn, $sql2);
    $rs_2 = mysqli_fetch_array($result_sql2);
    if ($item['product_qty'] <= $rs_2['product_qty']) {
        $word .= "1";
    } else {
        $word .= "0";
    }
   
    if (strpos($word,"0") == ""){
        $para = "1";
    } else {
        echo "0";
        return false;
    }
}
foreach ($_POST["data"] as $item) {

    $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
    $result_sql2 = mysqli_query($conn, $sql2);
    $rs_2 = mysqli_fetch_array($result_sql2);
    $qty = $rs_2['product_qty'] - $item['product_qty'];
    if ($item['product_qty'] <= $rs_2['product_qty']) {
        

        $sql3 = "UPDATE product SET product_qty = '$qty' WHERE product_id ='$item[product_id]'";
       
    } else {
        //none
    }
    if ($para == "1") {
        $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count)
            VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]')";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql3);
    }
}
echo 1;