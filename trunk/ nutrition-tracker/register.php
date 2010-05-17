<?php
require("config/config.php");
require("lib/register.class.php");

$register = new Register;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($_action) {
	case 'submit':
		$register->mungeFormData($_POST);
		if ($register->isValidForm($_POST)) {
			$register->insertUser($_POST);
		}
		$register->displayPage($_POST);
		break;
	case 'view':
	default:
		$register->displayPage($_POST);
}

?>