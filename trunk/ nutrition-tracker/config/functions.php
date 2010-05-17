<?php
/*function _getAssoc($sql)
{
	global $conn;
	$res = &$conn->getAssoc($sql);
	if (!$res) echo $conn->ErrorMsg();
	//print_r($res);
	return $res;
}

// Search food_des for specific foods by long_desc.
function goSearch($terms, $min=0, $max=1000) 
{
	$sql = "SELECT ndb_no, fdgrp_cd, long_desc FROM food_des 
		WHERE MATCH(long_desc) AGAINST ('$terms' IN NATURAL LANGUAGE MODE) 
		ORDER BY long_desc LIMIT $min, $max";
	return _getAssoc($sql);
}


function getFood($ndb_no)
{
	$sql = "SELECT ndb_no, long_desc, ww_no FROM food_des WHERE ndb_no = '" . $ndb_no . "'";
	return _getAssoc($sql);
}

// Based on 100g servings
function getProduct($ndb_no, $mod=1)
{
	$sql = "SELECT nutr_def.tagname, nutr_def.nutrdesc, 
		nutr_def.units, (nut_data.nutr_val*" . $mod . ") as nutr_val
		FROM nut_data, nutr_def 
		WHERE nut_data.nutr_no = nutr_def.nutr_no 
		AND nut_data.ndb_no = '" . $ndb_no . "' 
		ORDER BY nutr_def.nutrdesc";
	return _getAssoc($sql);
}


function getServingSizes($ndb_no)
{
	$sql = "SELECT gm_wgt, CONCAT(ROUND(amount, 0), ' ', msre_desc, ' (', gm_wgt, 'g)') FROM weight
		WHERE ndb_no = '" . $ndb_no . "' ORDER BY seq";
	return _getAssoc($sql);
}

function getFootnote($ndb_no)
{
	$sql = "SELECT footnt_txt FROM footnote
		WHERE ndb_no = '" . $ndb_no . "'";
	return _getAssoc($sql);
}

function getWeightWatchersNum($num)
{
	$intpart = intval($num);
	$diff = $num - $intpart;
	if ($diff >= .25 && $diff <= .74999)
		$num = $intpart + .5;
	elseif ($diff < .25)
		$num = $intpart;
	else
		$num = $intpart + 1;
	return $num;
}
function insertTracker($date, $ndb_no, $qty, $grams, $cals, $fat, $fiber, $ww, $meal)
{
	global $conn;
	$meal = strtoupper($meal);
	$stmt = $conn->prepare("SELECT ndb_no FROM tracker 
		WHERE ndb_no = ? AND meal = ?");
	$res = $conn->execute($stmt, array($ndb_no, $meal));
	// echo "&gt;" . $res->RecordCount();

	if ($res->RecordCount() == 0)
	{
		$stmt = $conn->prepare("insert into tracker (tracker_date, ndb_no, 
			serving_qty, serving_weight, cals, fat, fiber, ww_pts, meal) 
			values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$conn->execute($stmt, array($date, $ndb_no, $qty, $grams, $cals, $fat, $fiber, $ww, $meal));
	}
	else
	{
		// echo 'update<br />';
		$stmt = $conn->prepare("update tracker 
			set tracker_date = ?, ndb_no = ?, serving_qty = ?, serving_weight = ?, 
			cals = ?, fat = ?, fiber = ?, ww_pts = ? 
			where ndb_no = ? and meal = ?");
		$conn->execute($stmt, array($date, $ndb_no, $qty, $grams, $cals, $fat, $fiber, $ww, $ndb_no, $meal));
		// echo $conn->ErrorMsg();
	}
}

function getTrackerTotals($date)
{
	$sql = "SELECT SUM(t.cals) calories, SUM(t.fat) fat, SUM(t.fiber) fiber, SUM(t.ww_pts) points, SUM(t.serving_weight) weight, SUM(t.serving_qty) quantity 
		FROM tracker t 
		WHERE t.tracker_date = '$date'";
	// echo $sql;
	global $conn;
	return $conn->getRow($sql);
}

function getTracker($date, $meal)
{	
	$sql = "SELECT t.tracker_id, t.ndb_no, t.tracker_date, t.serving_qty, t.serving_weight, t.cals, t.fat, t.fiber, t.ww_pts, f.long_desc 
		FROM tracker t, food_des f 
		WHERE t.ndb_no = f.ndb_no AND t.tracker_date = '$date' AND t.meal = '$meal'";
	return _getAssoc($sql);
}

function getNotes($user_id, $date)
{
	global $conn;
	$stmt = $conn->prepare("SELECT tracker_note FROM tracker_notes WHERE user_id = ? AND tracker_date = ?");
	$res = $conn->getOne($stmt, array($user_id, $date));
	return $res;
}

function deleteItem($ndb_no, $meal)
{
	global $conn;
	$sql = "DELETE FROM tracker WHERE ndb_no = '$ndb_no' AND meal = '$meal'";
	$conn->execute($sql);
}

function moveItem($ndb_no, $meal, $dest)
{
	global $conn;
	$sql = "UPDATE tracker SET meal = ? WHERE ndb_no = ? AND meal = ?";
	$conn->execute($sql, array($dest, $ndb_no, $meal));
	// echo "moveItem: $meal, $ndb_no, $dest<br />";
}
*/