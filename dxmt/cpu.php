<?php 
$CPULogsFile = "/opt/dxmtlogs/CPU/logs.csv";

// Get directory of log files
if (($handle = fopen($CPULogsFile, "r")) === false)
{
    die("can't open the file.");
}
// CSV to JSON
$csv_headers = array("Tme","Hour","CPU","Usr","Nice","Sys","IOWait","IRQ","Soft","Steal","Guest","Guest Idle","Idle");
$csv_json = array();
while ($row = fgetcsv($handle, 10000, ","))
{
    $csv_json[] = array_combine($csv_headers, $row);
}
	
//JSON to Array
$data_JSON = json_encode($csv_json);
$data_obj = json_decode($data_JSON);

$len=sizeOf($data_obj);
	
//Extract data from array
$time = array();
$Usr = array();
$sys = array();
$stl = array();
for($i=0;$i<$len;$i++){
	$time[$i] = (string)$data_obj[$i]->Tme;
	$Usr[$i] = doubleval($data_obj[$i]->Usr);
	$sys[$i] = doubleval($data_obj[$i]->Sys);
	$stl[$i] = doubleval($data_obj[$i]->Steal);
}
	
fclose($handle);
?>


<!DOCTYPE html>
<html>
	<head>
	<title>DxMT 「Monitoring App - CPU」</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../scripts/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

	<!--transfer this to a new css file for monitoring app!-->
	<style>
	.container {
	  width: 80%;
	  margin: 15px auto;
	}
	</style>
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
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li>  					
				</ul>
				<ul class="side-nav blue-grey darken-2" id="mobile-demo">
					<li><a class="amber-text text-darken-2" href="index.php">Home</a></li>
					<li><a class="amber-text text-darken-2" href="disk.php">Disk Metric</a></li>
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li>  
				</ul>
			</div>
		</nav>
		<!-- Navbar ends here -->
	

		<div class="container">
		  <h2>CPU Usage</h2>
		  <div>
			<canvas id="myChart"></canvas>
			<script type='text/javascript'>
			<?php 
			$cpujs = json_encode($Usr);
			echo "var datacpu = ". $cpujs .";\n";
			$sysjs = json_encode($sys);
			echo "var datasys = ". $sysjs .";\n";
			$stljs = json_encode($stl);
			echo "var datastl = ". $stljs .";\n";
			$timejs = json_encode($time);
			echo "var datatime = ". $timejs .";\n";
			?>
			
			
			var ctx = document.getElementById('myChart').getContext('2d');
					var myChart = new Chart(ctx, {
						type: 'line',
					  data: {
						labels: datatime,
						datasets: [{
						  label: 'User Usage',
						  data: datacpu,
						  backgroundColor: "rgba(153,255,51,0.4)"
						},
						{
						  label: 'Steal Usage',
						  data: datastl,
						  backgroundColor: "rgba(255,255,51,0.4)"
						},
						{
						  label: 'System Usage',
						  data: datasys,
						  backgroundColor: "rgba(153,150,51,0.4)"
						}]
					  }
					});</script>
		  </div>
		</div>

		<!-- Footer goes here -->
		<footer class="page-footer grey darken-2">
			<div class="footer-copyright grey darken-3">
				<div class="container">
					© 2018 DxMT.tru.io
					<a class="grey-text text-lighten-4 right" href="#!">Follow us on <i class="fa fa-facebook-official"></i> !</a>
				</div>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.js"></script>
		<script src="../scripts/javascript.js"></script>
	</body>
</html>
