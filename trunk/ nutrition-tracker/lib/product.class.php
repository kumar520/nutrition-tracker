<?php
class Product
{
	var $conn = null;
	var $ndb_no = null;
	var $modifier = 1;
	var $weight = 100;
	var $quantity = 1;
	var $fat = null;
	var $ww = null;
	// var $config = null;
	
	function Product() {
		global $conn; // , $config;
		$this->conn =& $conn;
		$this->tpl =& new Smarty;
		$this->ww =& new WeightWatchers;
		// $this->config = $config;
	}
	
	function displayForm($formvars = array()) {
		global $config;
		
		$this->ndb_no = $formvars['ndb_no'];
		
		if (strlen($formvars['weight']) > 0) 
			$this->weight = $formvars['weight'];

		if (strlen($formvars['quantity']) > 0) 
			$this->quantity = $formvars['quantity'];
		
		$this->modifier = (($this->weight * $this->quantity) / 100);
		
		$data = $this->getProduct($this->ndb_no, $this->modifier);
		$food = $this->getFood($this->ndb_no);
		
		$this->tpl->assign('ndb_no', $this->ndb_no);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('fat_cals', ($data['FAT']['nutr_val'] * 9));
		$this->tpl->assign('selected', number_format($this->weight, 1));
		$this->tpl->assign('weight', ($this->weight * $this->quantity));
		$this->tpl->assign('options', $this->getServingSizes($this->ndb_no));
		// $this->tpl->assign('food', $food);
		$this->tpl->assign('description', $food[$this->ndb_no]['long_desc']);
		$this->tpl->assign('is_custom_food', $this->isCustomFood());
		$this->tpl->assign('points', $this->ww->getPoints($food[$this->ndb_no]['ww_no'] * (($this->weight * $this->quantity) / 100)));
		
		// echo 'pts:' . ($data['FAT']['nutr_val'] * 9);
		// echo $food[$this->ndb_no]['ww_no'] * (($this->weight * $this->quantity) / 100) . '<br/>';
		
		$dvpct = array();
		$dvpct['FAT'] = round(($data['FAT']['nutr_val'] / $config['DV']['FAT']) * 100) . '%';
		// $dvpct['FATRN'] = round(($data['FATRN']['nutr_val'] / $config['DV']['FATRN']) * 100) . '%';
		$dvpct['FASAT'] = round(($data['FASAT']['nutr_val'] / $config['DV']['FASAT']) * 100) . '%';
		$dvpct['CHOLE'] = round(($data['CHOLE']['nutr_val'] / $config['DV']['CHOLE']) * 100) . '%';
		$dvpct['NA'] = round(($data['NA']['nutr_val'] / $config['DV']['NA']) * 100) . '%';
		$dvpct['CHOCDF'] = round(($data['CHOCDF']['nutr_val'] / $config['DV']['CHOCDF']) * 100) . '%';
		$dvpct['FIBTG'] = round(($data['FIBTG']['nutr_val'] / $config['DV']['FIBTG']) * 100) . '%';
		$dvpct['VITA_IU'] = round(($data['VITA_IU']['nutr_val'] / $config['DV']['VITA_IU']) * 100) . '%'; 	// (.04 * 5000)
		$dvpct['VITC'] = round(($data['VITC']['nutr_val'] / $config['DV']['VITC']) * 100) . '%';
		$dvpct['FE'] = round(($data['FE']['nutr_val'] / $config['DV']['FE']) * 100) . '%';					// (.10 * 18)
		$dvpct['CA'] = round(($data['CA']['nutr_val'] / $config['DV']['CA']) * 100) . '%';
		$dvpct['PROCNT'] = round(($data['PROCNT']['nutr_val'] / $config['DV']['PROCNT']) * 100) . '%';
		$dvpct['K'] = round(($data['K']['nutr_val'] / $config['DV']['K']) * 100) . '%';
		$this->tpl->assign('dvpct', $dvpct);
		
		$this->tpl->clear_cache('product.tpl');
		$this->tpl->display('product.tpl');
	}
	
	// Replaced with getFoodNutritionData
	function getProduct($ndb_no, $modifier) {
		$stmt = $this->conn->prepare("SELECT nutr_def.tagname, nutr_def.nutrdesc, nutr_def.units, (nut_data.nutr_val * ?) as nutr_val
				FROM nut_data, nutr_def 
				WHERE nut_data.nutr_no = nutr_def.nutr_no 
				AND nut_data.ndb_no = ?
				ORDER BY nutr_def.nutrdesc");
		$data = $this->conn->getAssoc($stmt, array($modifier, $ndb_no));
		
		return $data;
	}
	
	// Part of Nutrition Tracker Beta database; A replacement for getProduct
	function getFoodNutritionData($food_id, $modifier) 
	{
		$sql = "SELECT food_id, long_desc, nutr_no, nutr_cd, nutr_desc, (nutr_val * ?) as nutr_val, nutr_units
				FROM vw_food_nutrition
				WHERE food_id = ?";
		$res = $this->conn->getAssoc($sql, array($modifier, $ndb_no));
		return $res;
	}
	
	// Replaced by getFoodWeightData
	function getServingSizes($ndb_no) {
		$stmt = $this->conn->prepare("SELECT gm_wgt, CONCAT(ROUND(amount, 0), ' ', msre_desc, ' (', gm_wgt, 'g)') 
				FROM weight
				WHERE ndb_no = ? 
				ORDER BY seq");
		$data = $this->conn->getAssoc($stmt, array($ndb_no));
		
		return $data;
	}
	
	// Replacement for getServingSizes
	function getFoodWeightData($food_id)
	{
		$sql = "SELECT food_id, amount, measure, grams, CONCAT(ROUND(amount, 0), ' ', measure, ' (', grams, 'g)') as display
				FROM vw_food_weight
				WHERE food_id = ?";
		$res = $this->conn->getAssoc($sql, array($food_id));
		return $res;
	}
	
	function getFood($ndb_no) {
		$stmt = $this->conn->prepare("SELECT ndb_no, long_desc, ww_no 
				FROM food_des 
				WHERE ndb_no = ?");
		$data = $this->conn->getAssoc($stmt, array($ndb_no));
		
		return $data;
	}
	
	function isCustomFood() {
		if (substr($this->ndb_no, 0, 1) == 'C')
			return true;
		else
			return false;
	}
	
	// Round a measurement to FDA standards:
	// Less than 5, round to the nearest half;
	// Greater than 5, round to the nearest int.
	function roundToFdaStandards($points)
	{
		if ($points < 5) {
			$int = intval($points);
			$diff = $points - $int;
			
			if ($diff >= .25 && $diff <= .74999)
				$points = $int + .5;
			elseif ($diff < .25)
				$points = $int;
			else
				$points = $int + 1;
		} else {
			$points = round($points);
		}
		return $points;
	}
}
