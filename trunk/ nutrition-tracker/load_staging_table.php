<?php
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

// Configuration to brands
$brand = "FDA";

$sql = "SELECT * FROM staging";
$res = $conn->getAssoc($sql);

foreach ($res as $item)
{
	// Insert into food table
	$sql = "INSERT INTO food (long_desc, brand_name) VALUES (?, ?)";
	$conn->execute($sql, array($item['NAME'], $brand));
	echo 'Added: ' . $item['NAME'] . '<br />';
	
	// Get food_id
	$sql = "SELECT food_id FROM food WHERE long_desc = ?";
	$food_id = $conn->getOne($sql, $item['NAME']);
	if ($food_id > 0)
		echo ' - Food ID: ' . $food_id . '<br />';
	else
		die('No food ID returned.');
	
	// Insert into food_nutrition table
	$sql = "INSERT INTO food_nutrition (food_id, nutr_id, nutr_val) VALUES (?, ?, ?)";
	$conn->execute($sql, array($food_id, getNutritionIdByName('ENERC_KCAL'),$item['ENERC_KCAL']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('FAT'),$item['FAT']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('FASAT'),$item['FASAT']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('FATRN'),$item['FATRN']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('CHOLE'),$item['CHOLE']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('NA'),$item['NA']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('CHOCDF'),$item['CHOCDF']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('FIBTG'),$item['FIBTG']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('SUGAR'),$item['SUGAR']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('PROCNT'),$item['PROCNT']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('VITA_IU'),$item['VITA_IU']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('VITC'),$item['VITC']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('CA'),$item['CA']));
	$conn->execute($sql, array($food_id, getNutritionIdByName('FE'),$item['FE']));
	
	// Insert into weight table
	$sql = "INSERT INTO weight (food_id, amount, measure, grams) VALUES (?,?,?,?)";
	// $conn->execute($sql, array($food_id, $item["AMOUNT"], $item['MEASURE'], $item['GRAMS']));
	echo ' - Inserted into weight table.<br />';
	
	echo ' - Finished.<hr />';
}

function getNutritionIdByName($nutr_cd)
{
	global $conn;
	$res = $conn->getOne("SELECT nutr_id FROM nutrition WHERE nutr_cd = ?", array($nutr_cd));
	return $res;
}