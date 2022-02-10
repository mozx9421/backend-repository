<?php 
include('connect.php');

$product_name = "";
$spci = "";
$spco = "";


$sqlQuery = "SELECT product.product_id, product.product_name, SUM(stock.product_count)
AS product_count FROM stock JOIN product
WHERE product.product_id = stock.product_id
AND `stock_datetime` >= DATE_SUB(CURDATE(), INTERVAL 30 day)
AND stock_id LIKE 'T%'
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
	var $chart = $('#chart-bars3');
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
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
					],
					borderColor: [
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
						'rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)','rgba(75, 192, 192, 1)',
					],
					borderWidth: 1,
					fill: false
				},{
					label: 'เบิกออก',
					data: [<?php echo $spco ?>],//ออก
					backgroundColor: [
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
					],
					borderColor: [
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
						'rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)','rgba(255, 128, 0, 1)',
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