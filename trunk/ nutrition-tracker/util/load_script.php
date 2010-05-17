<?php
require "config.php";

if ($_REQUEST['passKey'] == 'try4ped63A')
	weightWatchersPoints();
else
	echo 'Operation failed.';

function weightWatchersPoints()
{
	global $conn;

	$sql = "SELECT ndb_no FROM food_des";
	$res = $conn->Execute($sql);
	
	while (!$res->EOF) 
	{	
		$sql2 = "select b.tagname, a.nutr_val 
			from nut_data a, nutr_def b, food_des c 
			where a.nutr_no = b.nutr_no 
				and a.ndb_no = c.ndb_no 
				and c.ndb_no = '" . $res->fields['ndb_no'] . "'";
		$res2 = $conn->getAssoc($sql2);		
		// print_r($res2);
	
		$score = ($res2['ENERC_KCAL']/50) + ($res2['FAT']/12) - (min($res2['FIBTG'], 4)/5);
		$par = intval($score);
		
		if ($score - $par >= .25 && $score - $par <= .74999) 
			$par = $par + .5;
		elseif ($score - $par > .74999)
			$par = $par + 1;
		
		$ins = "update food_des set ww_no = $par 
			where ndb_no = '" . $res->fields['ndb_no'] . "'";
		$conn->Execute($ins);
		
		// echo $res->fields['ndb_no'] . ': ' . $par . '<br />';
		
		$res->MoveNext();
	}
	
	echo 'Complete';
}
?>