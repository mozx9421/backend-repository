<?php
    $sqlpro = "SELECT * FROM product JOIN unit JOIN category WHERE product.unit_id = unit.unit_id AND product.ctg_id = category.ctg_id  ";
    $resultpro = $conn->query($sqlpro);
?>
<div class="modal fade" id="product_update_modal<?php echo $fetch['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">แก้ไขสินค้า</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form method="POST" action="product_update_db.php">
                <div class="form-group">
                    <label>รหัสสินค้า :</label>
                    <input type="hidden" name="product_id" value="<?php echo $fetch['product_id']?>"/>
                    <input type="text" name="product_id" value="<?php echo $fetch['product_id']?>" class="form-control col-xl-8" disabled/>
                </div>
                <div class="form-group">
                    <label>ชื่อสินค้า :</label>
                    <input type="text" name="product_name" value="<?php echo $fetch['product_name']?>" class="form-control col-xl-8" required/>
                </div>
                <div class="form-group">
                    <label>หมวดหมู่ :</label> 
                    <select type="text" name="ctg_id" id="ctg_id" value="<?php echo $fetch['ctg_id']?>" class="form-control col-xl-8" required><br>
                        <option value="">เลือกหมวดหมู่</option>
                        <?php $sqlcat = "SELECT * FROM category";
                            $resultcat = mysqli_query($conn, $sqlcat);
                            if (mysqli_num_rows($resultcat) > 0) { 
                                while($rowcat = mysqli_fetch_assoc($resultcat)) {
                                    $ctg_id = $rowcat["ctg_id"];
                                    $ctg_name = $rowcat["ctg_name"];
                                    echo '<option value="'.$ctg_id.'">'.$ctg_name.'</option>';
                                }
                            } else { echo "0 results"; }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>หน่วยนับ :</label> 
                    <select type="text" name="unit_id" id="unit_id" value="<?php echo $fetch['unit_id']?>" class="form-control col-xl-8" required><br>
                        <option value="">เลือกหน่วยนับ</option>
                        <?php $sqlunit = "SELECT * FROM unit"; 
                            $resultunit = mysqli_query($conn, $sqlunit);
                            if (mysqli_num_rows($resultunit) > 0) { 
                                while($rowunit = mysqli_fetch_assoc($resultunit)) {
                                    $unit_id = $rowunit["unit_id"];
                                    $unit_name = $rowunit["unit_name"];
                                    echo '<option value="'.$unit_id.'">'.$unit_name.'</option>';
                                }
                            } else { echo "0 results"; }
                        ?>
                    </select><br> 
                </div>
                    <button name="update" class="btn btn-outline-success">แก้ไข</button>
                    <button type="reset" class="btn btn-outline-warning" name="reset">เคลีย</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ปิด</button>
        </div>  
    </div>
</div>