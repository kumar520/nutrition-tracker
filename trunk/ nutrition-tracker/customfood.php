<?php
require('config/config.php');
require('lib/weightwatchers.class.php');
require('lib/customfood.class.php');

// Security
if (!isset($_SESSION['user_info'])) {
	header('location: login.php');
}

$customfood =& new CustomFood;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($_action) {
	case 'submit':
		$customfood->mungeFormData($_POST);
		if ($customfood->isValidForm($_POST)) {
			$customfood->addUpdateEntry($_POST);
		}
		$customfood->displayForm();
		break;
	case 'adminview':
		// $customfood->getCustomFoods();
		$customfood->displayAdminView();
		break;
	case 'edit':
		$customfood->getItem($_REQUEST['ndb_no']);
		$customfood->displayForm();
		break;
	case 'remove':
		$customfood->removeItem($_REQUEST['ndb_no']);
		$customfood->displayAdminView();
		break;
	case 'view':
	default:
		$customfood->displayForm();
		break;
}

$smarty->clear_cache('viewcustomfood.tpl');
?>