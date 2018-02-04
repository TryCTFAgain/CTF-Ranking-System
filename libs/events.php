<?php  

if (isset($_POST["load"])){
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$firstDayOfMonth = (new DateTime(date('01-m-Y'))) -> getTimestamp ();
	$lastDayOfMonth = (new DateTime(date('t-m-Y'))) -> getTimestamp ();

	$api_ctftime = "https://ctftime.org/api/v1/events/?limit=10&start=$firstDayOfMonth&finish=$lastDayOfMonth";

	$data = file_get_contents($api_ctftime);
	// $data = substr($data, 1, strlen($data)-2);

	die($data);
}

?>