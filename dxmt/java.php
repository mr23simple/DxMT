<?php 
//Get directory of logs
$JavaLogsFile = "/opt/dxmtlogs/Application/Java/logs.csv";
//Open logs
$x = null;
if (($handle = fopen($JavaLogsFile, "r")) === false)
{
   $x = 1;
}
//Convert from CSV to JSON
$csv_headers = array("S0","S1","E","O","M","CCS","YGC","YGCT","FGC","FGCT","GCT");
$csv_json = array();
while ($row = fgetcsv($handle, 10000, ","))
{
    $csv_json[] = array_combine($csv_headers, $row);
}
//Convert JSON to Array
$data_JSON = json_encode($csv_json);
$data_obj = json_decode($data_JSON);
$javaLog = null;
if($x != 1){
	$javaLog = doubleval($data_obj[0]->M);
}
else{
	$javaLog = null;
}
fclose($handle);
?>