<?php 
//Get directory for Wildfly logs
$WildFlyLogsFile = "/opt/dxmtlogs/Application/WildFly/logs.csv";

//Open wildfly log file
if (($handle = fopen($WildFlyLogsFile, "r")) === false)
{
    $x = 1;
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

//Extract Data	
foreach($data_obj as $x){
	$result[] = $x->Status;
}

if($x != 1){
	$wildflyLog = end($result);
}
else{
	$wildflyLog = null;
}	

fclose($handle);
?>