<html>
	<!--This calls the file to be loaded-->
	<div id="screen"></div>

	<!--ajax auto loader-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<script>
		
		$(document).ready(function(){
			$("#screen").load('chart.php');
			setInterval(function(){
				$("#screen").load('chart.php')//something to reload
			}, 5000);
		});
	</script>
</html>
		