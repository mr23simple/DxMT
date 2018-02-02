<html>
	<!--This calls the file to be loaded-->
	<div id="screen"></div>

	<!--ajax auto loader-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

	<script>
		
		$(document).ready(function(){
			$("#screen").load('test_phpfilecontainer.php');
			setInterval(function(){
				$("#screen").load('test_phpfilecontainer.php')//something to reload
			}, 5000);
		});
	</script>
</html>