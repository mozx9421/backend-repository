<div class="modal fade" id="emp_update_modal<?php echo $fetch['emp_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">แก้ไขรายชื่อพนักงาน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="emp_update_db.php">
                    <div class="form-group">
                        <label>รหัสพนักงาน</label>
                        <input type="hidden" name="emp_id" value="<?php echo $fetch['emp_id']?>"/>
                        <input type="text" value="<?php echo $fetch['emp_id']?>" class="form-control col-xl-8" disabled/>
                    </div>
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" name="emp_name" value="<?php echo $fetch['emp_name']?>" class="form-control col-xl-8" required/>
                    </div>
                    <div class="form-group">
                        <label>นามสกุล</label>
                        <input type="text" name="emp_surname" value="<?php echo $fetch['emp_surname']?>" class="form-control col-xl-8" required/>
                    </div>
                    <div class="form-group">
                        <label>ตำแหน่ง</label>
                        <select name="emp_level" class="form-control col-xl-8" required>
                            <option value="">เลือกตำแหน่ง</option>
                            <option value="พนักงาน">พนักงาน</option>
                            <option value="ผู้จัดการ">ผู้จัดการ</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label>username</label>
                        <input type="text" name="emp_username" value="<?php echo $fetch['emp_username']?>" class="form-control col-xl-8" required/>
                    </div>
                    <!--
                    <div class="form-group">
                        <label>password</label>
                        <input type="text" name="emp_password" value="<?php //echo $fetch['emp_password']?>" class="form-control col-xl-8" required/>
                    </div>
                    <div class="form-group">
                        <label>เลขบัตรประชาชน</label>
                        <input type="number" name="emp_idcardnum" value="<?php echo $fetch['emp_idcardnum']?>" class="form-control col-xl-8" required/>
                    </div>
                    -->
                    <div class="form-group">
                        <label>อายุ</label>
                        <input type="number" name="emp_age" value="<?php echo $fetch['emp_age']?>" class="form-control col-xl-8" required/>
                    </div>
                    <div class="form-group">
                        <label>เพศ</label>
                        <select name="emp_gender" class="form-control col-xl-8" required>
                            <option value="">เลือกเพศ</option>
                            <option value="ผู้ชาย">ผู้ชาย</option>
                            <option value="ผู้หญิง">ผู้หญิง</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทรศัพท์มือถือ</label>
                        <input type="number" name="emp_tel" value="<?php echo $fetch['emp_tel']?>" min="10000000" max="999999999"class="form-control col-xl-8" required/>
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
</div>