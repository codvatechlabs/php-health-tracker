<?php
 
$dataPoints = array(
	array("label"=> "COVID19 - Asymptomatic", "y"=> 20),
	array("label"=> "COVID19 - Home Isolation", "y"=> 30),
	array("label"=> "COVID19 - Hospitalized ", "y"=> 10),
	array("label"=> "COVID19 - Recovered", "y"=> 50),
	array("label"=> "COVID19 - Death", "y"=> 1),
	array("label"=> "COVID19 - Other", "y"=> 0)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Overall Employee Health Status"
	},
	subtitles: [{
		text: "Currency Used: Thai Baht (฿)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 