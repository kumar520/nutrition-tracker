<?php

class Stats
{
	var $conn = null;
	
	function Stats() 
	{
		global $conn;
		$this->conn =& $conn;
	}
	
	function worstFoodsByCalories() 
	{
		$sql = "SELECT f.ndb_no, f.long_desc, n.nutr_val 'calories'
				FROM food_des f
				INNER JOIN nut_data n ON n.ndb_no = f.ndb_no
				WHERE n.nutr_no =  '208'
				ORDER BY n.nutr_val DESC
				LIMIT 0, 5";
		return $this->conn->getAssoc($sql);
	}
	
	function worstFoodsBySaturatedFat() 
	{
		$sql = 	"SELECT f.ndb_no, f.long_desc, n.nutr_val 'saturated fat'
				FROM food_des f
				INNER JOIN nut_data n ON n.ndb_no = f.ndb_no
				WHERE n.nutr_no =  '606'
				ORDER BY n.nutr_val DESC
				LIMIT 0, 5";
		return $this->conn->getAssoc($sql);	
	}
}