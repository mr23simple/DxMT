<?php 
//Get directory of Memory logs
$MemoryLogsFile = "/opt/dxmtlogs/Memory/logs.csv";

//Open logs for Memory
if (($handle = fopen($MemoryLogsFile, "r")) === false)
{
    die("can't open the file.");
}

//Convert CSV to JSON
$csv_headers = array("Tme","Mem","Total","Used","Free","Shared","Buffers","Cached","Swap","STotal","SUsed","SFree");
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
$Mem = array();
$MemUsed = array();
$MemTot = array();
$Swap = array();
$STot = array();
$SUsed = array();
for($i=0;$i<$len;$i++){
	$time[$i] = (string)$data_obj[$i]->Tme;
	$Mem[$i] = doubleval($data_obj[$i]->Mem);
	$MemUsed[$i] = doubleval($data_obj[$i]->Used);
	$MemTot[$i] = doubleval($data_obj[$i]->Total);
	$Swap[$i] = doubleval($data_obj[$i]->Swap);
	$STot[$i] = doubleval($data_obj[$i]->STotal);
	$SUsed[$i] = doubleval($data_obj[$i]->SUsed);
}
fclose($handle);
	
?>


<!DOCTYPE html>
<html>
	<head>
	<title>DxMT DxMT 「Monitoring App - Memory」</title>
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
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li>  					
				</ul>
				<ul class="side-nav blue-grey darken-2" id="mobile-demo">
					<li><a class="amber-text text-darken-2" href="index.php">Home</a></li>
					<li><a class="amber-text text-darken-2" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li> 
				</ul>
			</div>
		</nav>
		<!-- Navbar ends here -->


	<div class="container">
	  <h2>Memory Usage</h2>
	  <div>
	  
	  
	  
		<canvas id="myChart"></canvas>
		
		<br>
		<br>
		<br>
		<h2>Swap Space</h2>
		<canvas id="SwapChart"></canvas>
		
		<script type='text/javascript'>
		<?php 
		// Memory
		$memjs = json_encode($Mem);
		echo "var datamem = ". $memjs .";\n";
		// Memory Used
		$memUsedjs = json_encode($MemUsed);
		echo "var datamemUsed = ". $memUsedjs .";\n";
		// Memory Total
		$memTotaljs = json_encode($MemTot);
		echo "var datamemTotal = ". $memTotaljs .";\n";
		// Swap
		$swapjs = json_encode($Swap);
		echo "var dataswap = ". $swapjs .";\n";
		// Swap Used
		$swapUsedjs = json_encode($SUsed);
		echo "var dataSUsed = ". $swapUsedjs .";\n";
		// Swap Tot
		$swapTotjs = json_encode($STot);
		echo "var dataSTot = ". $swapTotjs .";\n";
		// Time
		$timejs = json_encode($time);
		echo "var datatime = ". $timejs .";\n";
		?>
		
		// Graph of Memory
		var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
				  data: {
					labels: datatime,
					datasets: [{
					  label: 'Memory Used',
					  data: datamemUsed,
					  backgroundColor: "rgba(153,255,51,0.4)"
					},
					{
					  label: 'Total',
					  data: datamemTotal,
					  backgroundColor: "rgba(153,150,51,0.4)"
					}]
				  }
				});
				
				
				var ctx = document.getElementById('SwapChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
				  data: {
					labels: datatime,
					datasets: [{
					  label: 'SWAP Space',
					  data: dataSUsed,
					  backgroundColor: "rgba(255,255,51,0.4)"
					},
					{
					  label: 'Total',
					  data: dataSTot,
					  backgroundColor: "rgba(153,0,51,0.4)"
					}]
				  }
				});
				
				
				</script>
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
