

<html>
	<head>
	
	</head>
	
	<body>
	<!--This calls the file to be loaded-->
	<div id="screen"></div>
	</body>
	
	<!--ajax auto loader-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script>
		
		$(document).ready(function(){
			$("#screen").load('chart.php');
			setInterval(function(){
				$("#screen").load('chart.php')//something to reload
			}, 10000);
		});
	</script>
</html>