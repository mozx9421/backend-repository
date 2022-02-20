<?php 
include 'connect.php';
                  $sqlcheck ='SELECT MIN(product_qty) FROM product';
                  $resultcheck = mysqli_query($conn,$sqlcheck);
                  while($rowcheck = $resultcheck->fetch_assoc()){
                    $rowcheckqty = $rowcheck ['product_qty'];
                    echo "$rowcheckqty   . ' ' .";

                  }
                  
                  ?>