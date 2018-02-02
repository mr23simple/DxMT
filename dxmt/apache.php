<?php 
//Get log file directory
$ApacheLogsFile = "/opt/dxmtlogs/Application/Apache/logs.csv";

//Open Log Files
$csv_json = array();
if (($handle = fopen($ApacheLogsFile, "r")) === false){
    $x = 1;
}

//Convert log files from CSV to JSON Format
$csv_headers = array("Status");

while ($row = fgetcsv($handle, 10000, ","))
{
    $csv_json[] = array_combine($csv_headers, $row);
}
//Change from JSON to Array 
$data_JSON = json_encode($csv_json);
$data_obj = json_decode($data_JSON);
//Get Results
//foreach($data_obj as $x){
//	$result[] = $x->Status;
//}
	if($x != 1){
	$apacheLog = end($data_obj->Status);
	}
	else{
	$apacheLog = null;
	}
	fclose($handle);
?>