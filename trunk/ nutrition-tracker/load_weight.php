<?php
set_time_limit(0);

define('BASE_DIR', '/Applications/MAMP/htdocs/');

require(BASE_DIR . 'adodb5/adodb.inc.php');

$config[] = array();
$config['DB']['host']	= "localhost";
$config['DB']['user']	= "root";
$config['DB']['pass']	= "root";
$config['DB']['name']	= "nutrition_db_b1";
$config['DB']['type']	= "mysql";

$conn = &ADONewConnection($config['DB']['type']);
$conn->PConnect($config['DB']['host'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['name']);

$sql = "SELECT * FROM staging_weight";
$res = $conn->getAssoc($sql);

foreach ($res as $item)
{
	// echo count($res); die;
	//$sql = "SELECT w.long_desc, w.amount, w.msre_desc, w.seq, w.gm_wgt FROM staging_weight w 
	//		WHERE w.long_desc = ?";
	//$wgts = $conn->getAssoc($sql, array($item['NAME']));	
	$food_id = $conn->getOne("SELECT food_id FROM food WHERE long_desc = ? AND food_id > 417", 
		array($item['long_desc']));
	
	//foreach ($wgts as $wgt)
	//{
	$sql = "INSERT INTO weight (food_id, amount, measure, grams, seq) VALUES (?, ?, ?, ?, ?)";	
	$conn->execute($sql, array($food_id, $item['amount'], $item['msre_desc'], $item['gm_wgt'], $item['seq']));
	
	if ($conn->ErrorNo() > 0) {
		echo "Error: " . $conn->ErrorMsg(); 
		die;
	}
		// $wgt->MoveNext();	
	//}
}

echo "Finished.";
