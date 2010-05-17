<?php
require("config/config.php");
require("lib/profile.class.php");

$profile = new Profile();

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($_action) {
	case 'view':
		$profile->name = $_SESSION['user_info']['name'];
		$profile->email_addr = $_SESSION['user_info']['email_addr'];
		$profile->displayPage();
		break;
	case 'submit':
		if ($profile->mungeFormData($_POST)) {
			$profile->saveProfile($_POST);
		}
		$profile->displayPage($_POST);
		break;
	default:
}

?>