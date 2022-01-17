<?php
     require('connect.php');
        $sql2 = "SELECT MAX(emp_id) AS emp_id FROM emp_data";
        $query = mysqli_query($conn,$sql2);
        $rs = mysqli_fetch_array($query);

            if($rs['emp_id'] !="")
            {
                $sub = substr($rs['emp_id'],1)+1;
                $emp_id = sprintf('E%03.0f', $sub);
            }
            else
            {
                $emp_id = "E001";
            }

        $sql2 = "SELECT MAX(product_id) AS product_id FROM product";
        $query = mysqli_query($conn,$sql2);
        $rs = mysqli_fetch_array($query);

            if($rs['product_id'] !="")
            {
                $sub = substr($rs['product_id'],1)+1;
                $product_id = sprintf('P%03.0f', $sub);
            }
            else
            {
                $product_id = "P001";
            }

        $sql2 = "SELECT MAX(ctg_id) AS ctg_id FROM category";
        $query = mysqli_query($conn,$sql2);
        $rs = mysqli_fetch_array($query);

            if($rs['ctg_id'] !="")
            {
                $sub = substr($rs['ctg_id'],1)+1;
                $ctg_id = sprintf('C%03.0f', $sub);
            }
            else
            {
                $ctg_id = "C001";
            }

        $sql2 = "SELECT MAX(unit_id) AS unit_id FROM unit";
        $query = mysqli_query($conn,$sql2);
        $rs = mysqli_fetch_array($query);

            if($rs['unit_id'] !="")
            {
                $sub = substr($rs['unit_id'],1)+1;
                $unit_id = sprintf('U%03.0f', $sub);
            }
            else
            {
                $unit_id = "U001";
            }
?>