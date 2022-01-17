<!-- Unit Modal Update-->
<div class="modal fade" id="unit_update_modal<?php echo $fetch['unit_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">แก้ไขหน่วยนับ</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form method="POST" action="unit_update_db.php">
                <div class="form-group">
                    <label>รหัสหน่วยนับ :</label>
                    <input type="hidden" name="unit_id" value="<?php echo $fetch['unit_id']?>"/>
                    <input type="text" name="unit_id" value="<?php echo $fetch['unit_id']?>" class="form-control col-xl-8" disabled/>
                </div>
                <div class="form-group">
                    <label>ชื่อหน่วยนับ :</label>
                    <input type="text" name="unit_name" value="<?php echo $fetch['unit_name']?>" class="form-control col-xl-8" required/>
                </div>
                <div class="form-group">
                จำนวนแพ็ค : 
                <input type="number" name="unit_pack" value="<?php echo $fetch['unit_pack']?>" class="form-control col-xl-8" required/><br>
                </div>
                <div class="form-group">
                จำนวนชิ้น : 
                <input type="number" name="unit_piece" value="<?php echo $fetch['unit_piece']?>" class="form-control col-xl-8" required/><br>
                </div>
                    <button name="update" class="btn btn-outline-success"> แก้ไข</button>
                    <button type="reset" class="btn btn-outline-warning" name="reset">เคลีย</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ปิด</button>
          </div>  
    </div>
</div>