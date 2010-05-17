<?php
require("../config/config.php");

$vitarr = array(
	'301'=>'CA', 
	'312'=>'CU', 
	'303'=>'FE', 
	'315'=>'MN', 
	'304'=>'MG', 
	'406'=>'NIA', 
	'305'=>'P', 
	'405'=>'RIBF', 
	'317'=>'SE', 
	'404'=>'THIA', 
	'318'=>'VITA_IU', 
	'418'=>'VITB12', 
	'415'=>'VITB6A', 
	'401'=>'VITC', 
	'324'=>'VITD', 
	'323'=>'TOCPHA', 
	'309'=>'ZN');

$sql = "SELECT * FROM staging";
$res = $conn->execute($sql);
// print_r($res);
while (!$res->EOF) {
	$data['203'] = $res->fields['protein'];
	$data['204'] = $res->fields['fat'];
	$data['205'] = $res->fields['carbohydrates'];
	$data['208'] = $res->fields['calories'];
	$data['269'] = $res->fields['sugars'];
	$data['291'] = $res->fields['fiber'];
	$data['301'] = $res->fields['CA'];
	$data['303'] = $res->fields['FE'];
	$data['318'] = $res->fields['VITA_IU'];
	$data['401'] = $res->fields['VITC'];
	$data['601'] = $res->fields['cholesterol'];
	$data['606'] = $res->fields['satfat'];	
	$data['307'] = $res->fields['sodium'];
	
	//print_r($data);
	
	$ndb_no = getNdbNo();
	$company = "McDONALD'S USA, ";
	$name = stripslashes($res->fields['name']);
	
	$stmt = $conn->prepare("INSERT INTO food_des (ndb_no, 
		fdgrp_cd, long_desc, short_desc) 
		VALUES (?, ?, ?, ?)");
	$conn->execute($stmt, array($ndb_no, '9999', $company . $name, 
								strtoupper(substr($name, 0, 60))));
	
	$stmt = $conn->prepare("INSERT INTO nut_data (ndb_no, nutr_no, nutr_val) VALUES (?, ?, ?)");
	foreach ($data as $key => $val)
	{
		if (in_array($key, array_keys($vitarr))) {
			if (trim($val) != '') {
				$val = ($config['DV'][$vitarr[$key]]) * ($val/100);
			}
		}
			
		if (trim($val) != '') { 
			$conn->execute($stmt, array($ndb_no, $key, $val));
		}
	}
	
	weightWatchersPoints($ndb_no);
	
	$res->movenext();
}
echo 'Done';
function getNdbNo() {
	global $conn;
	$sql = "SELECT MAX(ndb_no) FROM food_des WHERE ndb_no LIKE 'C%'";
	$res = $conn->getOne($sql);
	$intval = intval(substr($res, 1)) + 1;
	$ndb_no = 'C' . str_pad($intval, 4, '0', STR_PAD_LEFT);
	//print_r($ndb_no);
	return $ndb_no;
}
?>