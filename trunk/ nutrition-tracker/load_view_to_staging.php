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

$sql = "SELECT pre_staging_id, long_desc, manufacname FROM pre_staging GROUP BY long_desc, manufacname";
$res = $conn->getAssoc($sql);

foreach ($res as $item)
{
	$sql = "INSERT INTO staging (name) VALUES (?)";
	$conn->execute($sql, array($item['long_desc']));
	
	$sql = "SELECT tagname, nutr_val FROM pre_staging WHERE long_desc = ?";
	$tags = $conn->getAssoc($sql, array($item['long_desc']));
	$keys = array_keys($tags);
	
	while ($key = current($keys))
	{
		$sql = "UPDATE staging SET $key = ? WHERE name = ?";	
		$conn->execute($sql, array($tags[$key], $item['long_desc']));
		next($keys);	
	}
}

echo "Finished.";
