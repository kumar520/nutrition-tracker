<?php
require("config/config.php");
require("lib/tracker.class.php");

// Security
if (!isset($_SESSION['user_info'])) {
	header('location: login.php');
}

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_date = isset($_REQUEST['date']) ? $_REQUEST['date'] : $_SESSION['trackerDate']; 
$_meal = isset($_REQUEST['meal']) ? $_REQUEST['meal'] : $_SESSION['trackerMeal'];

if (!isset($_date)) $_date = date('Y-m-d');
if (!isset($_meal)) $_meal = 'b';

$tracker =& new Tracker(date_format(date_create($_date), 'Y-m-d'));
$tracker->meal = $_meal;

$_SESSION['trackerDate'] = $_date;
$_SESSION['trackerMeal'] = $_meal;

switch ($_action) {
	case 'add':
		$tracker->insertTracker($_GET);
		$tracker->displayPage();
		break;
	case 'delete':
		$tracker->deleteItems($_POST);
		$tracker->displayPage();
		break;
	case 'move':
		$tracker->moveItems($_POST);
		$tracker->displayPage();
		break;
	case 'view':
		$tracker->displayPage();
		break;
	default:
		$tracker->displayPage();
}

?>