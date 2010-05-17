<?php

class Search
{
	var $tpl = null;
	var $error = null;
	var $conn = null;
	var $first_text = 'First';
	var $last_text = 'Last';
	var $page_limit = 25;
	
	function Search() {
		global $conn;
		$this->conn =& $conn;
		$this->tpl =& new Smarty;	
	}
	
	function isValidForm($formvars) {
		$this->error = null;
		
		if (strlen($formvars['term']) == 0) {
			$this->error = 'term_empty';
			return false;
		}
		
		return true;
	}
	
	function displayForm($formvars = array()) {
		$this->tpl->assign('post', $formvars);
		$this->tpl->assign('error', $this->error);
		$this->tpl->clear_cache('search.tpl');
		$this->tpl->display('search.tpl');
	}
	
	function doSearch($formvars, $min = 0, $max = 500) {
		$term = explode(' ', str_replace(',','',stripslashes($formvars['term'])));
		foreach ($term as $item)
			$tmp .= '+' . $item . '* ';
		$term = $tmp;

		$stmt = $this->conn->prepare("SELECT ndb_no, fdgrp_cd, long_desc,
			MATCH (long_desc) AGAINST (?) AS score
			FROM food_des 
			WHERE MATCH(long_desc) AGAINST (? IN BOOLEAN MODE) 
			ORDER BY score LIMIT ?, ?");
		
		$data = $this->conn->getAssoc($stmt, array($term, $term, $min, $max));
		
		return $data;
	}
	
	function paginateResults($data, $term, $limit=25, $first_text='First', $last_text='Last')
	{
		$term = str_replace(',','',stripslashes($term));
		
		if (count($data) > 0) :
			SmartyPaginate::reset();
			SmartyPaginate::connect();
			SmartyPaginate::setLimit($limit);
			SmartyPaginate::setFirstText($first_text);
			SmartyPaginate::setLastText($last_text);
			SmartyPaginate::setTotal(count($data));
			SmartyPaginate::setUrl("search.php?action=submit&term=" . $term);
			$data = array_slice($data, SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
			$this->tpl->assign('data', $data);
			$_SESSION['last_search'] = "search.php?action=submit&term=" . $term;
			SmartyPaginate::assign($this->tpl);	
		else :
			$this->error = "No results found.";	
		endif;
	}
}

?>