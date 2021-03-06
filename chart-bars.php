<?php 
include('connect.php');

$product_name = "";
$spci = "";
$spco = "";
$spcc = "";
$pack = "เเพ็ค";

$sqlQuery = "SELECT product.product_id, product.product_name, SUM(stock.product_count)
AS product_count FROM stock JOIN product
WHERE product.product_id = stock.product_id
AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
AND stock_id LIKE 'R%'
GROUP BY product_name
ORDER BY product_count DESC";
$result = mysqli_query($conn,$sqlQuery);

foreach ($result as $row){
	$product_id = $row['product_id'];
	$sqlQuery9 = "SELECT * FROM product WHERE product_id = '$product_id'";
	$result9 = mysqli_query($conn,$sqlQuery9);
	foreach ($result9 as $row){
	$product_name .= "'".$row['product_name']."',";
	}
	
	//เข้า
	$sqlQuery1 = "SELECT product_id, SUM(product_count) AS product_count FROM stock
	WHERE `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day) AND stock_id LIKE 'R%' AND product_id = '$product_id' ";
	$result1 = mysqli_query($conn,$sqlQuery1);
	foreach ($result1 as $row1){
		$spci .= "'".$row1['product_count']."',";
	}
	
	//ออก
	$sqlQuery2 = "SELECT product_id, SUM(product_count) AS product_count FROM stock
	WHERE `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day) AND stock_id LIKE 'T%' AND product_id = '$product_id' ";
	$result2 = mysqli_query($conn,$sqlQuery2);
	foreach ($result2 as $row2){
		$spco .= "'".$row2['product_count']."',";
	}
	
	//claim
	$sqlQuery3 = "SELECT product_id, SUM(product_count) AS product_count FROM stock
	WHERE `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day) AND stock_id LIKE 'C%' AND product_id = '$product_id' ";
	$result3 = mysqli_query($conn,$sqlQuery3);
	foreach ($result3 as $row3){
		$spcc .= "'".$row3['product_count']."',";
	}
}
// print_r($result);
// exit;
?>
<script>
//
// Bars chart
//
var BarsChart = (function(){
	//
	// Variables
	//
	var $chart = $('#chart-bars2');
	//
	// Methods
	//
	// Init chart
	function initChart($chart){
		// Create chart
		var ordersChart = new Chart($chart, {
			legend: {
				horizontalAlign: "left", // left, center ,right 
				verticalAlign: "center",  // top, center, bottom
			},
			type: 'bar',
			data: {
				labels: [<?php echo $product_name ?>],//ชื่อ
				datasets: [{
					label: 'รับเข้า',
					data: [<?php echo $spci ?>],//เข้า
					showInLegend: true,
					backgroundColor: [
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
					],
					borderColor: [
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
						'rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )','rgba(76, 129, 241   )',
					],
					borderWidth: 1,
					fill: false
				},{
					label: 'เบิกออก',
					data: [<?php echo $spco ?>],//ออก
					backgroundColor: [
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
					],
					borderColor: [
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
						'rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )','rgba(84, 187, 101   )',
					],
					borderWidth: 1,
					fill: false
				},{
					label: 'สินค้าเคลม',
					data: [<?php echo $spcc ?>],//เข้า
					showInLegend: true,
					backgroundColor: [
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
					],
					borderColor: [
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
						'rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )','rgb(241, 76, 76  )',
					],
					borderWidth: 1,
					fill: false
				}]
			}
		});
		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}
	// Init chart
	if ($chart.length) {
		initChart($chart);
	}
})();
</script>