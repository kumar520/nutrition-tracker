<?php
require("config/config.php");
require("lib/login.class.php");

$login = new Login;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($_action) {
	case 'view':
		$login->displayPage();
		break;
	case 'submit':
		$login->mungeFormData($_POST);
		if ($login->processLogin($_POST)) {
			$smarty->clear_cache('index.tpl');
			$smarty->display('index.tpl');
		}
		else
			$login->displayPage();
		break;
	default:
		$login->displayPage();
		break;
}

?>