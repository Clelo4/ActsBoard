<?php
	$d1=date('Y-m-d',strtotime('2017-13-3'));
	$d2=date('Y-m-d',strtotime('2017-9-2'));
	if($d1=='1970-01-1') { echo "ok"; }
	$d1=date("Y-m-d");
	echo $d1;
	echo "明天:",date('Y-m-d',strtotime('+1 day'));

?>

	