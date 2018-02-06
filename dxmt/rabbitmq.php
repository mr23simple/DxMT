<?php 
//Get directory for RabbitMQ logs
$RabbitMQLogsFile = "/opt/dxmtlogs/Application/RabbitMQ/logs.csv";

//Open log file
$y = 0;
if (($handle = fopen($RabbitMQLogsFile, "r")) === false)
{
    $y = 1;
}

//CSV to JSON
$csv_headers = array("Status");
$csv_json = array();
while ($row = fgetcsv($handle, 10000, ","))
{
    $csv_json[] = array_combine($csv_headers, $row);
}
//JSON to Array
$data_JSON = json_encode($csv_json);
$data_obj = json_decode($data_JSON);

//Extract data
foreach($data_obj as $x){
	$result[] = $x->Status;
}

$rabbitMQLog = null;
if($y != 1){
	$rabbitMQLog = end($result);
	}
else{
	$rabbitMQLog = null;
}	
fclose($handle);
echo $rabbitMQLog;
?>