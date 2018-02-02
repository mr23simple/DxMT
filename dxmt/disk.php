<?php 
//Get directory for Disk Space Logs
$DiskLogsFile = "/opt/dxmtlogs/DiskSpace/logs.csv";
//Open Disk Logs
if (($handle = fopen($DiskLogsFile, "r")) === false)
{
    echo "can't open the file.";
}
//Convert CSV to JSON
$csv_headers = array("FileSystem","Total","UsedKB","AvailableKB","%Usage","MountedOn");
$csv_json = array();
while ($row = fgetcsv($handle, 4000, ","))
{
    $csv_json[] = array_combine($csv_headers, $row);
}
//Convert JSON to Array
$data_JSON = json_encode($csv_json);
$data_obj = json_decode($data_JSON);

//Extract all File systems available
foreach($data_obj as $a){
	$fileSystem[] = $a->FileSystem;
}
	
$len = sizeOf($fileSystem);
	
//Separating each log per block device
for($a=0;$a<$len;$a++){
	foreach($data_obj as $i){
		$l=$i->FileSystem;
		switch($a){
			case 0:
				if($l == $fileSystem[$a]){
					$data_fs1[] = $i;
				}
				break;
			case 1;
				if($l == $fileSystem[$a]){
					$data_fs2[] = $i;
				}
				break;
			case 2;
				if($l == $fileSystem[$a]){
					$data_fs3[] = $i;
				}
				break;
			case 3;
				if($l == $fileSystem[$a]){
					$data_fs4[] = $i;
				}
				break;
			case 4;
				if($l == $fileSystem[$a]){
					$data_fs5[] = $i;
				}
				break;
			case 5;
				if($l == $fileSystem[$a]){
					$data_fs6[] = $i;
				}
				break;
			case 6;
				if($l == $fileSystem[$a]){
					$data_fs7[] = $i;
				}
				break;
			case 7;
				if($l == $fileSystem[$a]){
					$data_fs8[] = $i;
				}
				break;
		}
	}
}
	
	
	
	
// Data for FS1
$data1=end($data_fs1);
$data1fs=$data1->FileSystem;
$used1=null;
$avail1=null;
if($data1 != null){
	$used1=(intval($data1->UsedKB)/intval($data1->Total))*100;
	$avail1=(intval($data1->AvailableKB)/intval($data1->Total))*100;
}
$datapoint1 = array(
				array("label"=>$data1->UsedKB.'KB '."Used", "y"=>$used1),
				array("label"=>$data1->AvailableKB.'KB '."Available", "y"=>$avail1)
			);
// Data for FS2
$data2=end($data_fs2);
$data2fs=$data2->FileSystem;
$used2=null;
$avail2=null;
if($data2 != null){
	$used2=(intval($data2->UsedKB)/intval($data2->Total))*100;
	$avail2=(intval($data2->AvailableKB)/intval($data2->Total))*100;
}
$datapoint2 = array(
				array("label"=>$data2->UsedKB.'KB '."Used", "y"=>$used2),
				array("label"=>$data2->AvailableKB.'KB '."Available", "y"=>$avail2)
			);
// Data for FS3		
$data3=end($data_fs3);
$data3fs=$data3->FileSystem;
$used3=null;
$avail3=null;
if($data3 != null){
	$used3=(intval($data3->UsedKB)/intval($data3->Total))*100;
	$avail3=(intval($data3->AvailableKB)/intval($data3->Total))*100;
}
$datapoint3 = array(
				array("label"=>$data3->UsedKB.'KB '."Used", "y"=>$used3),
				array("label"=>$data3->AvailableKB.'KB '."Available", "y"=>$avail3)
			);
// Data for FS4
$data4=end($data_fs4);
$data4fs=$data4->FileSystem;
$used4=null;
$avail4=null;
if($data4 != null){
	$used4=(intval($data4->UsedKB)/intval($data4->Total))*100;
	$avail4=(intval($data4->AvailableKB)/intval($data4->Total))*100;
}
$datapoint4 = array(
				array("label"=>$data4->UsedKB.'KB '."Used", "y"=>$used4),
				array("label"=>$data4->AvailableKB.'KB '."Available", "y"=>$avail4)
			);
// Data for FS5
$data5=end($data_fs5);
$data5fs=$data5->FileSystem;
$used5=null;
$avail5=null;
if($data5 != null){
	$used5=(intval($data5->UsedKB)/intval($data5->Total))*100;
	$avail5=(intval($data5->AvailableKB)/intval($data5->Total))*100;
}
$datapoint5 = array(
				array("label"=>$data5->UsedKB.'KB '."Used", "y"=>$used5),
				array("label"=>$data5->AvailableKB.'KB '."Available", "y"=>$avail5)
			);
// Data for FS6
$data6=end($data_fs6);
$data6fs=$data6->FileSystem;
$used6=null;
$avail6=null;
if($data6 != null){
	$used6=(intval($data6->UsedKB)/intval($data6->Total))*100;
	$avail6=(intval($data6->AvailableKB)/intval($data6->Total))*100;
}
$datapoint6 = array(
				array("label"=>$data6->UsedKB.'KB '."Used", "y"=>$used6),
				array("label"=>$data6->AvailableKB.'KB '."Available", "y"=>$avail6)
			);
// Data for FS7
$data7=end($data_fs7);
$data7fs=$data7->FileSystem;
$used7=null;
$avail7=null;
if($data7 != null){
	$used7=(intval($data7->UsedKB)/intval($data7->Total))*100;
	$avail7=(intval($data7->AvailableKB)/intval($data7->Total))*100;
}
$datapoint7 = array(
				array("label"=>$data7->UsedKB.'KB '."Used", "y"=>$used7),
				array("label"=>$data7->AvailableKB.'KB '."Available", "y"=>$avail7)
				);
// Data for FS8
$data8=end($data_fs8);
$data8fs=$data8->FileSystem;
$used8=null;
$avail8=null;
if($data8 != null){
	$used8=(intval($data8->UsedKB)/intval($data8->Total))*100;
	$avail8=(intval($data8->AvailableKB)/intval($data8->Total))*100;
}
$datapoint8 = array(
				array("label"=>$data8->UsedKB.'KB '."Used", "y"=>$used8),
				array("label"=>$data8->AvailableKB.'KB '."Available", "y"=>$avail8)
			);


fclose($handle);
//Logic for didspalying available block devices
if($len == 1){
	$type2 = "hide";$type3 = "hide";$type4 = "hide";$type5 = "hide";$type6 = "hide";$type7 = "hide";$type8 = "hide";
}
elseif($len == 2){
	$type3 = "hide";$type4 = "hide";$type5 = "hide";$type6 = "hide";$type7 = "hide";$type8 = "hide";
}
elseif($len == 3){
	$type4 = "hide";$type5 = "hide";$type6 = "hide";$type7 = "hide";$type8 = "hide";
}
elseif($len == 4){
	$type5 = "hide";$type6 = "hide";$type7 = "hide";$type8 = "hide";
}
elseif($len == 5){
	$type6 = "hide";$type7 = "hide";$type8 = "hide";
}
elseif($len == 6){
	$type7 = "hide";$type8 = "hide";
}
elseif($len == 7){
	$type8 = "hide";
}
elseif($len == 8){
	$type = '';
}
?>

 
<html>
	<head>
	<title>DxMT 「Monitoring App - Disk」</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../scripts/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
		
	</head>
	
	<body class="#ffffff white">
	
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
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li>  					
				</ul>
				<ul class="side-nav blue-grey darken-2" id="mobile-demo">
					<li><a class="amber-text text-darken-2" href="index.php">Home</a></li>
					<li><a style="background-color:#ffa000; font-weight: bold;" class="z-depth-4 blue-grey-text text-darken-4" href="disk.php">Disk Metric</a></li>
					<li><a class="amber-text text-darken-2" href="cpu.php">CPU Metric</a></li>
					<li><a class="amber-text text-darken-2" href="memory.php">Memory Metric</a></li>
					<li><a class="amber-text text-darken-2" href="network.php">Network Metric</a></li>
					<li><a class="amber-text text-darken-2" href="ads.php">Application Discovery</a></li> 
					<li><a class="amber-text text-darken-2" href="badip.php">Top 10 Bad IP Addresses</a></li> 
				</ul>
			</div>
			
			<!-- Tabs go here -->
			<div class="nav-content">
				<ul class="tabs tabs-transparent blue-grey darken-3">
					<li class="tab"><a id="gr1" class="<?php echo $type1; ?> active"><?php echo $data1fs; ?></a></li>
					<li class="tab"><a id="gr2" class="<?php echo $type2; ?>"><?php echo $data2fs; ?></a></li>
					<li class="tab"><a id="gr3" class="<?php echo $type3; ?>"><?php echo $data3fs; ?></a></li>
					<li class="tab"><a id="gr4" class="<?php echo $type4; ?>"><?php echo $data4fs; ?></a></li>
					<li class="tab"><a id="gr5" class="<?php echo $type5; ?>"><?php echo $data5fs; ?></a></li>
					<li class="tab"><a id="gr6" class="<?php echo $type6; ?>"><?php echo $data6fs; ?></a></li>
					<li class="tab"><a id="gr7" class="<?php echo $type7; ?>"><?php echo $data7fs; ?></a></li>
					<li class="tab"><a id="gr8" class="<?php echo $type8; ?>"><?php echo $data8fs; ?></a></li>
				</ul>
			</div> 
		</nav> 
		<div id="chartContainer" style="height: 370px; width: 100%;">
		</div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		
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
			<script>	
		window.onload = function(){
			
			
			var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data1fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint1, JSON_NUMERIC_CHECK); ?>
			}]
		});
			document.getElementById("chartContainer").innertHTML = chart.render();
			
			
			document.getElementById("gr1").onclick = function() {volume1()};
			
			function volume1(){
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data1fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint1, JSON_NUMERIC_CHECK); ?>
			}]
		});
			document.getElementById("chartContainer").innertHTML = chart.render();
			
			}
			
			document.getElementById("gr2").onclick = function() {volume2()};
			
			function volume2(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data2fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint2, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			
			document.getElementById("gr3").onclick = function() {volume3()};
			
			function volume3(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data3fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint3, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			
			document.getElementById("gr4").onclick = function() {volume4()};
			
			function volume4(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data4fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint4, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			
			document.getElementById("gr5").onclick = function() {volume5()};
			
			function volume5(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data5fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint5, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			document.getElementById("gr6").onclick = function() {volume6()};
			
			function volume6(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data6fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint6, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			
			document.getElementById("gr7").onclick = function() {volume7()};
			
			function volume7(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data7fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint7, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
			
			document.getElementById("gr8").onclick = function() {volume8()};
			
			function volume8(){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,	
			title: {text: "Disk Usage"},
			subtitles: [{text: "<?php echo $data8fs; ?>"}],
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.00\"%\"",
				indexLabel: "{label} ({y})",
				dataPoints: <?php echo json_encode($datapoint8, JSON_NUMERIC_CHECK); ?>
			}]
		});
		document.getElementById("chartContainer").innertHTML = chart.render();
		
			}
			
		}

		</script>
	</body>
</html> 