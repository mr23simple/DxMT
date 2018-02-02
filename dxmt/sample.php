<?php 
$TopIPLogsFile[] = explode(" ",file_get_contents("/opt/logs/TopIPs/logs.txt"));
$topip = $TopIPLogsFile;	
?>

<!DOCTYPE html>
<html>
	<head>
	<title>DxMT 「Monitoring App - Top 10 Bad IP」</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../scripts/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	</head>
	
	<body class="white responsive-img">
	
		<!-- Navbar goes here -->
		<nav class="nav-extended">
			<div class="nav-wrapper blue-grey darken-2">
				<!-- Logo goes here -->
				<span style="display:inline-block; width: 10px;"></span>
				<a href="index.php" class="brand-logo amber-text logo">DxMT</a>
				<!-- Logo ends here -->
				<a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a class="amber-text text-darken-2" href="monitoring.php">Home</a></li>
					<li><a class="amber-text text-darken-2" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li> 
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li>  
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="badip.php">Top 10 Bad IP Addresses</a></li>
										
				</ul>
				<ul class="side-nav blue-grey darken-2" id="mobile-demo">
					<li><a class="amber-text text-darken-2" href="monitoring.php">Home</a></li>
					<li><a class="amber-text text-darken-2" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li> 
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li>  
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="badip.php">Top 10 Bad IP Addresses</a></li>
				</ul>
			</div>
		</nav>
		<!-- Navbar ends here -->
		
		<!-- First Body -->
		<div class="section notTransparent">
			<div class="row container ">
				<h1 class="header" align="center"> Top 10 Bad IP Addresses</h1>
				<p class="grey-text text-darken-3 lighten-3" align="center">Something text ... bla bla bla...  </p>
				<div class="row">
						<table class= "striped centered" id="badip">
							<tbody>
								<tr>
									<th>Bad IP Addresses</th>
								</tr>
							</tbody>	
						</table>
					
		<!-- Footer goes here -->
		<footer class="page-footer grey darken-2">
			<div class="footer-copyright grey darken-3">
				<div class="container">
					c 2017 DxMT.io
					<a class="grey-text text-lighten-4 right" href="#!">Follow us on <i class="fa fa-facebook-official"></i> </a>
				</div>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.js"></script>
		<script type="text/javascript">
			
			
			window.onload = function(){
				var bad = <?php echo $topip?>; 
				function myFunction(<?php echo $topip?>){
					$('#badip').append( "<tr> <td>"+<?php echo $topip?>+"</td>");
				}
			}
		</script>
	</body>
</html>