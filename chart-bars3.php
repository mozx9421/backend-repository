<?php 
include('connect.php');

$product_name = "";
$spci = "";
$spco = "";


$sqlQuery = "SELECT product.product_id, product.product_name, SUM(stock.product_count)
AS product_count FROM stock JOIN product
WHERE product.product_id = stock.product_id
AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
AND stock_id LIKE 'C%'
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
	
	
	//เคลม
	$sqlQuery2 = "SELECT product_id, SUM(product_count) AS product_count FROM stock
	WHERE `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day) AND stock_id LIKE 'C%' AND product_id = '$product_id' ";
	$result2 = mysqli_query($conn,$sqlQuery2);
	foreach ($result2 as $row2){
		$spco .= "'".$row2['product_count']."',";
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
	var $chart = $('#chart-bars4');
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
					label: 'สินค้าเคลม',
					data: [<?php echo $spco ?>],//เข้า
					showInLegend: true,
					backgroundColor: [
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
					],
					borderColor: [
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
						'rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)','rgb(204, 0, 0)',
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