<?php

class Profile {
	var $tpl = null;
	var $email_addr = null;
	var $name = null;
	var $error = null;
	var $highlight = null;
	var $conn = null;
	
	function Profile() {
		global $conn;
		$this->conn =& $conn;
		$this->tpl =& new Smarty;
	}
	
	function mungeFormData(&$formvars) {
		$formvars['name'] = trim($formvars['name']);
		$formvars['email_addr'] = trim($formvars['email_addr']);
		$formvars['password'] = trim($formvars['password']);
		
		if ($formvars['email_addr'] == '') {
			$this->error = "Email address is invalid.";
			return false;
		}
		
		return true;
	}
	
	function displayPage($formvars = array()) {
		$this->tpl->assign('email_addr', $this->email_addr);
		$this->tpl->assign('name', $this->name);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('highlight', $this->highlight);
		$this->tpl->display('profile.tpl');
	}
	
	function saveProfile($formvars) {
		$sql = "UPDATE users SET email_addr = '" . $formvars['email_addr'] . "'";

		if (strlen($formvars['name']) > 0)
			$sql .= ", name = '" . mysql_real_escape_string($formvars['name']) . "'";

		if (strlen($formvars['password']) > 0)
			$sql .= ", password = SHA1('" . $formvars['password'] . "')";
		
		$sql .= " WHERE user_id = " . $_SESSION['user_info']['user_id'];
		
		$this->conn->execute($sql);

		if ($this->conn->errormsg() !== '') {
			$this->error = "Database encountered an error. " . $this->conn->errormsg();
			return false;
		}
		
		$this->name = $formvars['name'];
		$_SESSION['user_info']['name'] = $formvars['name'];
		$this->email_addr = $formvars['email_addr'];
		$this->highlight = "Profile saved successfully.";
		return true;
	}
}

?>