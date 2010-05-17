<?php

class Register {
	var $tpl = null;
	var $error = null;
	var $highlight = null;
	var $conn = null;
	
	function Register() {
		global $conn;
		$this->conn = $conn;
		$this->tpl = new Smarty;
	}
	
	function displayPage($formvars = array()) {
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('highlight', $this->highlight);
		$this->tpl->clear_cache('register.tpl');
		$this->tpl->display('register.tpl');
	}
	
	function mungeFormData(&$formvars) {
		$formvars['email_addr'] = trim($formvars['email_addr']);
		$formvars['password1'] = trim($formvars['password1']);
	}
	
	function isValidForm($formvars) {
		if (strlen($formvars['email_addr']) == 0) {
			$this->error = "Email address is not valid.";
			return false;
		}
		
		if (strlen($formvars['password1']) < 8) {
			$this->error = "Password is not valid.";
			return false;
		}
		
		if ($formvars['password1'] !== $formvars['password2']) {
			$this->error = "Passwords do not match.";
			return false;
		}
		
		return true;
	}
	
	function insertUser($formvars) {
		$sql = "SELECT email_addr FROM users WHERE email_addr = ?";
		$res = $this->conn->getOne($sql, array($formvars['email_addr']));
		
		if (strlen($res) > 0) {
			$this->error = "A user with that email address already exists in our system.";
			return false;
		}
		
		$sql = "INSERT INTO users (email_addr, password) VALUES (?, SHA1(?))";
		
		if ($this->conn->execute($sql, array($formvars['email_addr'], $formvars['password1'])) === false) {
			$this->error = "An error occurred inserting this user. " . $this->conn->errormsg();
			return false;
		}
		else {
			$this->highlight = "Your user account has been created. Click <a href=\"index.php\">here</a> to continue.";
		}
		
		return true;
	}
}

?>