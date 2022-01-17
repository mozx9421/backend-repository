<div class="modal fade" id="see_all_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">TOP เบิกออกสินค้า</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Projects table -->
        <table class="table-striped col-xl-10 center" border="1">
          <tr class="thead-light">
            <th><h6 class="mb-0" align="center">ลำดับ</h6></th>
            <th><h6 class="mb-0" align="center">รหัสสินค้า</h6></th>
            <th><h6 class="mb-0" align="center">&nbspชื่อสินค้า</h6></th>
            <th><h6 class="mb-0" align="center">จำนวนที่เบิกออก</h6></th>
          </tr>
          <?php
            include('connect.php');
            $sql ="SELECT product.product_id, product.product_name, SUM(stock.product_count) AS product_count FROM stock JOIN product
            WHERE product.product_id = stock.product_id
            AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 31 day)
            AND stock_id LIKE 'T%'
            GROUP BY product_name
            ORDER BY product_count DESC";
            $result = mysqli_query($conn,$sql);
            $n = 1;
            while($row = mysqli_fetch_array($result)){
          ?>
          <tr>
            <td align="center"><?php echo $n; $n++;?></td>
            <td align="center"><?php echo $row['product_id'];?></td>
            <td align="left"><?php echo "&nbsp",$row['product_name']?></td>
            <td align="center"><?php echo $row['product_count'];?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> ปิด</button>
      </div>
    </div>
  </div>
</div>