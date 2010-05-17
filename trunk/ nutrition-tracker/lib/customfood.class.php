<?php

class CustomFood 
{	
	private $tpl;
	private $error;
	private $highlight;
	private $conn;
	private $ww;
	private $config;
	private $data;
	private $vitarr;
	
	function CustomFood() {
		global $conn, $config;
		$this->conn =& $conn;
		$this->config =& $config;
		$this->tpl =& new Smarty;
		$this->ww =& new WeightWatchers;
	}
	
	function displayForm($formvars = array()) {
		$this->tpl->assign('post', $formvars);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('highlight', $this->highlight);		
		$this->tpl->display('customfood.tpl');
	}
	
	function mungeFormData(&$formvars) {
		$formvars['name'] = trim($formvars['name']);	
		$formvars['calories'] = trim($formvars['calories']);	
		$formvars['fat'] = trim($formvars['fat']);	
		$formvars['fiber'] = trim($formvars['fiber']);	
	}
	
	function isValidForm($formvars) {
		$this->error = null;
		
		if (strlen($formvars['name']) == 0) {
			$this->error = 'name_empty';
			return false;
		}

		if (strlen($formvars['calories']) == 0) {
			$this->error = 'calories_empty';
			return false;
		}
		
		if (strlen($formvars['fat']) == 0) {
			$this->error = 'fat_empty';
			return false;
		}
		
		if (strlen($formvars['fiber']) == 0) {
			$this->error = 'fiber_empty';
			return false;
		}
		
		return true;
	}
	
	function addUpdateEntry($formvars) 
	{
		$this->data = array(
			'203' => $formvars['protein'],
			'204' => $formvars['fat'],
			'205' => $formvars['carbohydrate'],
			'208' => $formvars['calories'],
			'269' => $formvars['sugars'],
			'291' => $formvars['fiber'],
			'301' => $formvars['calcium'],
			'303' => $formvars['iron'],
			'605' => $formvars['transfat'],
			'606' => $formvars['satfat'],			
			'307' => $formvars['sodium'],
			'601' => $formvars['cholesterol'],
			'318' => $formvars['vita'],
			'323' => $formvars['vite'],
			'324' => $formvars['vitd'],
			'401' => $formvars['vitc'],			
			'304' => $formvars['magnesium'],
			'305' => $formvars['phosphorus'],
			'306' => $formvars['potassium'],
			'309' => $formvars['zinc'],
			'312' => $formvars['copper'],
			'315' => $formvars['manganese'],
			'317' => $formvars['selenium'],
			'404' => $formvars['thiamin'],
			'405' => $formvars['riboflavin'],
			'406' => $formvars['niacin'],
			'415' => $formvars['vitb6'],
			'418' => $formvars['vitb12'],
			'645' => $formvars['monofat'],
			'646' => $formvars['polyfat']
		);
		$this->vitarr = array(
			'301' => 'CA', 
			'312' => 'CU', 
			'303' => 'FE', 
			'315' => 'MN', 
			'304' => 'MG', 
			'406' => 'NIA', 
			'305' => 'P', 
			'405' => 'RIBF', 
			'317' => 'SE', 
			'404' => 'THIA', 
			'318' => 'VITA_IU', 
			'418' => 'VITB12', 
			'415' => 'VITB6A', 
			'401' => 'VITC', 
			'324' => 'VITD', 
			'323' => 'TOCPHA', 
			'309' => 'ZN'
		);
		$name = stripslashes($formvars['name']);

		// Check for existing entry
		if (strlen($formvars['ndb_no'])>0)
		{
			// Update food_des
			$sql = "UPDATE food_des SET long_desc = ?, short_desc = ? WHERE ndb_no = ?";
			if (!$this->conn->execute($sql, array($formvars['name'], strtoupper(substr($name,0,60)), $formvars['ndb_no'])))
			{ 
				$this->error = 'Error updating item.'; 
				return false; 
			}
			// Update nut_data
			$sql = "UPDATE nut_data SET nutr_val = ? WHERE nutr_no = ? AND ndb_no = ?";
			// echo $sql;
			foreach ($this->data as $key => $val) 
			{
				if (in_array($key, array_keys($this->vitarr))) 
				{
					if (trim($val) !== '') $val = ($this->config['DV'][$this->vitarr[$key]]) * ($val/100);
				}
				if (trim($val) !== '') 
				{ 
					// echo $val . ':' . $key . ":" . $ndb_no;
					if (!$this->conn->execute($sql, array($val, $key, $formvars['ndb_no'])))
					{
						$this->error = 'Error updating item.';
						return false;
					}
					// print_r($this->conn); die;
				}
			}
			$this->ww->setPoints($ndb_no, $formvars['calories'], $formvars['fat'], $formvars['fiber']);
			$this->highlight = $name . ' updated successfully.';
		}
		else // Insert new item.
		{
			// Get new ID
			$sql = "SELECT MAX(ndb_no) FROM food_des WHERE ndb_no LIKE 'C%'";
			$res = $this->conn->getOne($sql);
			$intval = intval(substr($res, 1)) + 1;
			$ndb_no = 'C' . str_pad($intval, 4, '0', STR_PAD_LEFT);
			
			// Insert custom food.
			$stmt = $this->conn->prepare("INSERT INTO food_des (ndb_no, fdgrp_cd, long_desc, short_desc) VALUES (?, ?, ?, ?)");
			$this->conn->execute($stmt, array($ndb_no, '9999', $name, strtoupper(substr($name, 0, 60))));
			
			if ($this->conn->errormsg() !== '') {
				$this->error = 'Error adding item.';
				return false;
			}
			
			$stmt = $this->conn->prepare("INSERT INTO nut_data (ndb_no, nutr_no, nutr_val) VALUES (?, ?, ?)");
			
			foreach ($this->data as $key => $val) {
				if (in_array($key, array_keys($this->vitarr))) {
					if (trim($val) !== '') {
						$val = ($this->config['DV'][$this->vitarr[$key]]) * ($val/100);
					}
				}
					
				if (trim($val) !== '') { 
					$this->conn->execute($stmt, array($ndb_no, $key, $val));
					
					if ($this->conn->errormsg() !== '') {
						$this->error = 'Error adding item.';
						return false;
					}
				}
			}
			$this->ww->setPoints($ndb_no, $formvars['calories'], $formvars['fat'], $formvars['fiber']);
			$this->highlight = $name . ' added successfully.';
		} // end if
			
		return true;
	}
	
	function displayAdminView() {
		$custom_foods = $this->getCustomFoods();
		$this->tpl->assign('results', $custom_foods);
		$this->paginateResults($custom_foods);
		$this->tpl->display('viewcustomfood.tpl');
	}
	
	function getCustomFoods() {
		$sql = "SELECT ndb_no, long_desc FROM food_des 
				WHERE ndb_no LIKE 'C%' ORDER BY ndb_no";
		$res = $this->conn->getAssoc($sql);
		return $res;
	}
	
	function removeItem($ndb_no) {
		$sql = "DELETE FROM food_des WHERE ndb_no = ?";
		$this->conn->execute($sql, $ndb_no);
		$sql = "DELETE FROM nut_data WHERE ndb_no = ?";
		$this->conn->execute($sql, $ndb_no);
	}
	
	function getItem($ndb_no) {
		if ($ndb_no == "")
			return false;

		$sql = "SELECT f.ndb_no, f.long_desc, n.nutr_no, n.nutr_val 
				FROM nut_data n 
				INNER JOIN food_des f on f.ndb_no = n.ndb_no 
				WHERE n.ndb_no = ?";
		$res = $this->conn->getAll($sql, array($ndb_no));
		
		$_POST = array();
		foreach ($res as $nutr_val) {
			switch ($nutr_val['nutr_no'])
			{
				case '203':
					$_POST['protein'] = $nutr_val['nutr_val'];
					break;
				case '208':
					$_POST['calories'] = $nutr_val['nutr_val'];
					break;
				case '204':
					$_POST['fat'] = $nutr_val['nutr_val'];
					break;
				case '205':
					$_POST['carbohydrate'] = $nutr_val['nutr_val'];
					break;
				case '269':
					$_POST['sugars'] = $nutr_val['nutr_val'];
					break;
				case '291':
					$_POST['fiber'] = $nutr_val['nutr_val'];
					break;
				case '301':
					// Stored in DB at %DV; Must convert to % from import.
					$_POST['calcium'] = ($nutr_val['nutr_val']/$this->config['DV']['CA'])*100;
					break;
				case '303':
					$_POST['iron'] = ($nutr_val['nutr_val']/$this->config['DV']['FE'])*100;
					break;
				case '605':
					$_POST['transfat'] = $nutr_val['nutr_val'];
					break;
				case '606':
					$_POST['satfat'] = $nutr_val['nutr_val'];
					break;
				case '307':
					$_POST['sodium'] = $nutr_val['nutr_val'];
					break;
				case '601':
					$_POST['cholesterol'] = $nutr_val['nutr_val'];
					break;
				case '318':
					// $val = ($this->config['DV'][$this->vitarr[$key]]) * ($val/100);
					$_POST['vita'] = ($nutr_val['nutr_val']/$this->config['DV']['VITA_IU']);
					break;
				case '401':
					$_POST['vitc'] = ($nutr_val['nutr_val']/$this->config['DV']['VITC'])*100;
					break;
			}		
		}
		$_POST['name'] = $res[0]['long_desc'];
		$_POST['ndb_no'] = $ndb_no;
	}
	
	function paginateResults($source_data, $limit=25, $first_text='First', $last_text='Last')
	{
		if (count($source_data) > 0) :
			SmartyPaginate::reset();
			SmartyPaginate::connect();
			SmartyPaginate::setLimit($limit);
			SmartyPaginate::setFirstText($first_text);
			SmartyPaginate::setLastText($last_text);
			SmartyPaginate::setTotal(count($source_data));
			SmartyPaginate::setUrl("customfood.php?action=adminview");
			$data = array_slice($source_data, SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
			$this->tpl->assign('data', $data);
			SmartyPaginate::assign($this->tpl);	
		else :
			$this->error = "No results found.";	
		endif;
	}
}

?>