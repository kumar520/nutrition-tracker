<?php

class WeightWatchers {
	var $conn = null;
	
	function WeightWatchers() 
	{
		global $conn;
		$this->conn =& $conn;
	}
	
	function setPoints($ndb_no, $calories, $fat, $fiber)
	{	
		// Calculate base WW score
		$score = ($calories/50) + ($fat/12) - (min($fiber, 4)/5);
		$points = intval($score);
		
		// Round based on WW patent
		if ($score - $points >= .25 && $score - $points <= .74999) 
			$points = $points + .5;
		elseif ($score - $points > .74999)
			$points = $points + 1;
		
		$ins = "UPDATE food_des 
			SET ww_no = " . $points . "
			WHERE ndb_no = '" . $ndb_no . "'";
		$this->conn->execute($ins);
		
		return $points;
	}
	
	function getPoints($points)
	{
		$intpart = intval($points);
		$diff = $points - $intpart;
		
		if ($diff >= .25 && $diff <= .74999)
			$points = $intpart + .5;
		elseif ($diff < .25)
			$points = $intpart;
		else
			$points = $intpart + 1;
		
		return $points;
	}
}

?>