<?php

class Tracker
{
	var $conn = null;
	var $tpl = null;
	var $error = null;
	var $tracker_date = null;
	var $tracker_meal = 'b';
	var $user_id = null;
	
	function Tracker($date) {
		global $conn;
		$this->conn =& $conn;
		$this->tpl =& new Smarty;
		$this->user_id = $_SESSION['user_info']['user_id'];
		$this->tracker_date = $date;
	}
	
	function displayPage() {
		$note = $this->getNotes();
		$totals = $this->getTotals();
		
		$breakfast_rs = $this->getTracker('b');
		$lunch_rs = $this->getTracker('l');
		$dinner_rs = $this->getTracker('d');
		$snack_rs = $this->getTracker('s');
		
		$this->tpl->assign("totals", $totals);
		$this->tpl->assign("date", $this->tracker_date);
		$this->tpl->assign("breakfast_rs", $breakfast_rs);
		$this->tpl->assign("lunch_rs", $lunch_rs);
		$this->tpl->assign("dinner_rs", $dinner_rs);
		$this->tpl->assign("snack_rs", $snack_rs);
		$this->tpl->assign("note", $note);
		//$smarty->assign("item", $item);
		
		$this->tpl->clear_cache('tracker.tpl');
		$this->tpl->display("tracker.tpl");	
	}
	
	function insertTracker($formvars) {
		$sql = "SELECT ndb_no FROM tracker 
				WHERE ndb_no = ? AND meal = ? AND user_id = ? AND tracker_date = ?";
		$res = $this->conn->execute($sql, array($formvars['ndb_no'], $this->meal, $this->user_id, $this->tracker_date));
		
		if ($res->RecordCount() == 0) {
			$sql = "INSERT INTO tracker (tracker_date, ndb_no, quantity, weight, calories, fat, fiber, points, meal, user_id) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->conn->execute($sql, array($this->tracker_date, $formvars['ndb_no'], $formvars['quantity'], 
											$formvars['weight'], $formvars['calories'], $formvars['fat'], 
											$formvars['fiber'], $formvars['points'], $this->meal, $this->user_id));
		} else {
			$sql = "UPDATE tracker 
					SET tracker_date = ?, ndb_no = ?, quantity = ?, weight = ?, calories = ?, fat = ?, fiber = ?, points = ? 
					WHERE ndb_no = ? AND meal = ? AND user_id = ?";
			$this->conn->execute($sql, array($this->tracker_date, $formvars['ndb_no'], $formvars['quantity'], 
											$formvars['weight'], $formvars['calories'], $formvars['fat'], 
											$formvars['fiber'], $formvars['points'], $formvars['ndb_no'], $this->meal, $this->user_id));
			// echo $conn->ErrorMsg();
		}
	}
	
	function moveItems($formvars) {
		$items = strtolower('item_' . $formvars['meal']);
		$dest = strtoupper($formvars['dest']);
		$meal = $formvars['meal'];

		if (isset($formvars[$items])) {
			foreach ($formvars[$items] as $item) {
				$sql = "UPDATE tracker SET meal = ? 
						WHERE ndb_no = ? AND meal = ? AND user_id = ?";
				$this->conn->execute($sql, array($dest, $item, $meal, $this->user_id));
				/*
				$sql = "SELECT ndb_no, meal, user_id, cals, fat, fiber, ww_pts, serving_weight, serving_qty FROM tracker 
				WHERE ndb_no = ? AND meal = ? AND user_id = ?";
				$res = $this->conn->getAssoc($sql, array($item, $dest, $this->user_id));
				echo $res[$item]['cals']; die;
				if (count($res[$item]) == 0) {
				} else {
				$sql = "UPDATE tracker SET cals = cals + ?, fat = fat + ?, fiber = fiber + ?, 
				ww_pts = ww_pts + ?, serving_weight = serving_weight + ?, serving_qty = serving_qty + ? 
				WHERE ndb_no = ? AND meal = ? AND user_id = ?";
				$this->conn->execute($sql, array($res[$item]['cals'], $res[$item]['fat'], $res[$item]['fiber'], 
				$res[$item]['ww_pts'], $res[$item]['serving_weight'], $res[$item]['serving_qty'], $item, $dest, $this->user_id));
				$this->conn->execute("DELETE FROM tracker WHERE ndb_no = ? AND meal = ? AND user_id = ?", array($item, $meal, $this->user_id));
				}*/
			}
		}
	}
	
	function deleteItems($formvars) {
		$items = strtolower('item_' . $formvars['meal']);
		$meal = $formvars['meal'];
	
		if (isset($formvars[$items])) {
			foreach ($formvars[$items] as $item) {
				$sql = "DELETE FROM tracker 
						WHERE ndb_no = ? 
						AND meal = ?";
				$this->conn->execute($sql, array($item, $meal));
			}
		}			
	}
	
	function getNotes() {
		$sql = "SELECT tracker_note FROM tracker_notes 
				WHERE user_id = ? AND tracker_date = ?";
		$res = $this->conn->getOne($sql, array($this->user_id, $this->tracker_date));
		return $res;
	}
	
	function getTotals() {
		$sql = "SELECT SUM(t.calories) calories, SUM(t.fat) fat, SUM(t.fiber) fiber, SUM(t.points) points, SUM(t.weight) weight, SUM(t.quantity) quantity 
				FROM tracker t 
				WHERE t.tracker_date = ? AND t.user_id = ?";
		$res = $this->conn->getRow($sql, array($this->tracker_date, $this->user_id));
		return $res;
	}
	
	function getTracker($meal) {
		$sql = "SELECT t.tracker_id, t.ndb_no, t.tracker_date, t.quantity, t.weight, t.calories, t.fat, t.fiber, t.points, f.long_desc 
				FROM tracker t, food_des f 
				WHERE t.ndb_no = f.ndb_no AND t.tracker_date = ? AND t.meal = ? AND t.user_id = ?";
		$res = $this->conn->getAssoc($sql, array($this->tracker_date, $meal, $this->user_id));
		return $res;
	}
	
	function insertTrackerMobile($tracker_date, $ndb_no, $tracker_meal, $user_id, $quantity, $weight, $calories, $fat, $fiber, $points) 
	{
		$sql = "SELECT ndb_no FROM tracker 
				WHERE ndb_no = ? AND meal = ? AND user_id = ? AND tracker_date = ?";
		$res = $this->conn->execute($sql, array($ndb_no, $tracker_meal, $user_id, $tracker_date));
		
		if ($res->RecordCount() == 0) {
			$sql = "INSERT INTO tracker (tracker_date, ndb_no, quantity, weight, calories, fat, fiber, points, meal, user_id) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->conn->execute($sql, array($tracker_date, $ndb_no, $quantity, $weight, $calories, $fat, $fiber, $points, $tracker_meal, $user_id));
		} else {
			$sql = "UPDATE tracker 
					SET tracker_date = ?, ndb_no = ?, quantity = ?, weight = ?, calories = ?, fat = ?, fiber = ?, points = ? 
					WHERE ndb_no = ? AND meal = ? AND user_id = ?";
			$this->conn->execute($sql, array($tracker_date, $ndb_no, $quantity, $weight, $calories, $fat, $fiber, $points, $ndb_no, $tracker_meal, $user_id));
			// echo $conn->ErrorMsg();
		}
	}
	
	function getTrackerMobile($tracker_date, $meal, $user_id) 
	{
		$sql = "SELECT t.tracker_id, t.ndb_no, t.tracker_date, t.quantity, t.weight, t.calories, t.fat, t.fiber, t.points, f.long_desc 
				FROM tracker t, food_des f 
				WHERE t.ndb_no = f.ndb_no AND t.tracker_date = ? AND t.meal = ? AND t.user_id = ?";
		$res = $this->conn->execute($sql, array($tracker_date, $meal, $user_id));
		return $res;
	}
}

?>