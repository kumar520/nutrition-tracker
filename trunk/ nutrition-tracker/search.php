<?php
require("config/config.php");
require("lib/search.class.php");

$search =& new Search;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_meal = isset($_REQUEST['meal']) ? $_REQUEST['meal'] : $_SESSION['trackerMeal'];
if (!isset($_meal)) $_meal = 'b';

$_SESSION['trackerMeal'] = $_meal;

switch($_action) {
	case 'submit':
		$data = $search->doSearch($_REQUEST);
		$search->paginateResults($data, $_REQUEST['term']);
		$search->displayForm();
		break;
	case 'view':
	default:
		$search->displayForm();
		break;
}

?>