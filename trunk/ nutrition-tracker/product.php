<?php
require("config/config.php");
require("lib/weightwatchers.class.php");
require("lib/product.class.php");

$product =& new Product;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($_action)
{
	case 'submit':
		// $search->doSearch($_REQUEST);
		// $search->displayForm();
		break;
	case 'view':
	default:;
		$product->displayForm($_REQUEST);
		break;
}
?>