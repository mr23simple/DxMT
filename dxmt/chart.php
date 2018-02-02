<?php
	$dataPoints = array( 
		array("label"=>"Used", "y"=>64.02),
		array("label"=>"Available", "y"=>12.55)
	)
?>

<!DOCTYPE HTML>
<html>
	<head>
		
		<script>
			window.onload = function() {
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				title: {
					text: "Disk Usage"
				},
				subtitles: [{
					text: "put date and time here"
				}],
				data: [{
					type: "pie",
					yValueFormatString: "#,##0.00\"%\"",
					indexLabel: "{label} ({y})",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
			 
			}
		</script>
			
	</head>
	<body>
		<meta http-equiv="refresh" content="10" />
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</body>
	

</html>   