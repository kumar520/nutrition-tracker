<?php

class Login
{
	var $tpl = null;
	var $error = null;
	var $conn = null;
	
	function Login() {
		global $conn;
		$this->conn =& $conn;
		$this->tpl =& new Smarty;
	}
	
	// Set default value to formvars so we can load the page before submitting the form!
	function displayPage($formvars = array()) {
		$this->tpl->clear_cache('login.tpl');
		$this->tpl->assign('error', $this->error);
		$this->tpl->display('login.tpl');
	}	

	function mungeFormData($formvars) {
		$formvars['email_addr'] = trim($formvars['email_addr']);
		$formvars['password'] = trim($formvars['password']);
		
		if ($formvars['email_addr'] == '') {
			$this->error = "Email address is empty.";
			return false;
		}

		if ($formvars['password'] == '') {
			$this->error = "Password is empty.";
			return false;
		}
		
		return true;
	}

	function processLogin($formvars) {
		$sql = "SELECT name, user_id FROM users WHERE email_addr = ? AND password = SHA1(?)";
		$user = $this->conn->getRow($sql, array($formvars['email_addr'], $formvars['password']));
		
		if (strlen($user['user_id']) > 0) {
			$_SESSION['user_info'] = array('user_id'=>$user['user_id'], 'email_addr'=>$formvars['email_addr'], 'timestamp'=>getdate(), 'name'=>$user['name']);			
		}
		else {
			$this->error = "User and password not found.";
			return false;
		}
		
		return true;
	}
}

?>