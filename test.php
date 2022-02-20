<?php
  $i=1;
  while (your_condition) {
?>
    <input type='text' name='qqty[]' value='<?php echo $avail; ?>' id="avail<?= $i ?>" class='form-control1' readonly = 'readonly'>

    <select class="form-control1" name="qty[]" id="sType"  onChange="check('<?= $i ?>');">
            <option value="<?php echo $avail;?>"><?php echo $Uconv;?></option>
            <option value="<?php echo $qty;?>"><?php echo $uom;?></option>
    </select>

    //my javascript code
    <script>
    function check(i) {
       document.getElementById("avail"+i).value = document.getElementById("sType").value;
    }
    </script>
<?php
$i++;
} // end while
?>