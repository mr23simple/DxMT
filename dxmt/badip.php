<?php 
//Get log file directory
$TopIPLogsFile ="/opt/dxmtlogs/TopIPs/logs.csv";
//Open Log Files
if (($handle = fopen($TopIPLogsFile, "r")) === false){
    echo "can't open the file.";
}
//Convert to JSON
while ($row = fgetcsv($handle, 4000, " "))
{
    $csv_json[] = $row;
}
$len = sizeOf($csv_json[0]);
//JSON to Array
$topip = array();
for($i=0;$i<$len;$i++){
	$topip[$i] = $csv_json[0][$i];
}
?>

<!DOCTYPE html>
<html>
	<head>
	<title>DxMT 「Monitoring App - Blacklist」</title>
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
					<li><a class="amber-text text-darken-2" href="index.php">Home</a></li>
					<li><a class="amber-text text-darken-2" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li> 
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li>
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="badip.php">Top 10 Bad IP Addresses</a></li>  					
				</ul>
				<ul class="side-nav blue-grey darken-2" id="mobile-demo">
					<li><a class="amber-text text-darken-2" href="index.php">Home</a></li>
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
				<h1 class="header" align="center"> Blacklist IP Addresses</h1>
				<div class="row">
						
					<div class="row">
		<script language="javascript" type="text/javascript">
		var badIP = <?php echo json_encode($topip); ?>;
		var length = <?php echo $len; ?>;
		for (var i=0; i<length; i++) {
			color = Math.floor((Math.random() * 2) + 1) > 1 ? "white black-text":"black white-text";
			document.write("<div class='col s3 " + color + "'>" + badIP[i] + "</div>");
		}
		</script>
					</div>
								
								
								
							
					
		<!-- Footer goes here -->
		<footer class="page-footer grey darken-2">
			<div class="footer-copyright grey darken-3">
				<div class="container">
					© 2018 DxMT.tru.io
					<a class="grey-text text-lighten-4 right" href="#!">Follow us on <i class="fa fa-facebook-official"></i> </a>
				</div>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.js"></script>
		<script src="../scripts/javascript.js"></script>
	</body>
</html>