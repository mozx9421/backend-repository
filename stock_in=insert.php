<?php
//insert.php
include('connect.php');
// include('connect2.php');
date_default_timezone_set('Asia/Bangkok');


// if(isset($_POST["product_id"]))
// {

$query2 = "SELECT * FROM stock WHERE stock_id LIKE 'R%' ORDER BY runid DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);
$rs = mysqli_fetch_array($result2);

// $query_front = "SELECT * FROM stock WHERE stock_id LIKE 'R%' ORDER BY runid DESC LIMIT 1";
// $result_front = mysqli_query($conn_test, $query_front);
// $rs_front = mysqli_fetch_array($result_front);

$time = date("Y-m-d H:i");

//runid
if ($rs['stock_id'] != "") {
    $check = substr($rs['stock_id'], 1, 2);
    $date =  date("y") + 43;

    if ($check == $date) {
        $sub = substr($rs['stock_id'], 3, 6) + 1;
        $name = sprintf('R' . $date . sprintf("%'.003d\n", $sub));
    } else {
        $name = "R" . $date . "001";
    }
} else {
    $date =  date("y") + 43;
    $name = "R" . $date . "001";
}
///////////////////////////////////////////////////////////////////////
// if ($rs_front['stock_id'] != "") {
//     $check_front = substr($rs_front['stock_id'], 1, 2);
//     $date_front =  date("y") + 43;

//     if ($check_front == $date_front) {
//         $sub_front = substr($rs_front['stock_id'], 3, 6) + 1;
//         $name_front = sprintf('R' . $date_front . sprintf("%'.003d\n", $sub_front));
//     } else {
//         $name_front = "R" . $date_front . "001";
//     }
// } else {
//     $date_front =  date("y") + 43;
//     $name_front = "R" . $date_front . "001";
// }


foreach ($_POST["data"] as $item) {
    $sql = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count)
        VALUE ('$name','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]')";


    // $sql_front = "INSERT INTO stock (stock_id, stock_status, stock_datetime, emp_id, product_id, product_count)
    //     VALUE ('$name_front','$item[stock_status]','$time','$item[emp_id]','$item[product_id]','$item[product_qty]')";


    if (mysqli_query($conn, $sql)) {
        $sql2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
        $result_sql2 = mysqli_query($conn, $sql2);
        $rs_2 = mysqli_fetch_array($result_sql2);

        $qty = $rs_2['product_qty'] + $item['product_qty'];
        //update qty
        $sql3 = "UPDATE product SET product_qty = '$qty' WHERE product_id ='$item[product_id]'";
        mysqli_query($conn, $sql3);
    }

    // if (mysqli_query($conn_test, $sql_front)) {
    //     $sql_front_2 = "SELECT * FROM product WHERE product_id = '$item[product_id]'";
    //     $result_front_sql2 = mysqli_query($conn_test, $sql_front_2);
    //     $rs_front_2 = mysqli_fetch_array($result_front_sql2);

    //     $qty_front = $rs_front_2['product_qty'] + $item['product_qty'];
    //     //update qty
    //     $sql_front_3 = "UPDATE product SET product_qty = '$qty_front' WHERE product_id ='$item[product_id]'";
    //     mysqli_query($conn_test, $sql_front_3);
    // }
    echo $rs['stock_status'];
    // echo $rs_front['stock_status'];
}
