<div class="modal fade" id="category_update_modal<?php echo $fetch['ctg_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">แก้ไขหมวดหมู่</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form method="POST" action="category_update_db.php">
                <div class="form-group">
                    <label>รหัสหมวดหมู่ : </label>
                    <input type="hidden" name="ctg_id" value="<?php echo $fetch['ctg_id']?>"/>
                    <input type="text" name="ctg_id" value="<?php echo $fetch['ctg_id']?>" class="form-control col-xl-8" disabled/>
                </div>
                <div class="form-group">
                    <label>ชื่อหน่วยนับ : </label>
                    <input type="text" name="ctg_name" value="<?php echo $fetch['ctg_name']?>" class="form-control col-xl-8" required/>
                </div>
                    <button name="update" class="btn btn-outline-success">แก้ไข</button>
                    <button type="reset" class="btn btn-outline-warning" name="reset">เคลีย</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> ปิด</button>
          </div>  
    </div>
</div>