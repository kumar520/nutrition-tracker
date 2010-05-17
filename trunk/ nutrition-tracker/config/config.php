<?php
error_reporting(E_ALL ^E_NOTICE);
session_start();

// Set environment
$env = "DEV"; // PROD

// Database configuration
$config[] = array();

if ($env == "PROD")
{
	define('BASE_DIR', '/home/baseme10/public_html/');
	define('NUTRITION_DIR', '/home/baseme10/public_html/food/');
	$config['DB']['host']	= "localhost";
	$config['DB']['user']	= "baseme10_wrdp1";
	$config['DB']['pass']	= "g[rlcUgFetWF";
	$config['DB']['name']	= "baseme10_wrdp1";
	$config['DB']['type']	= "mysql";
}
else 
{
	define('BASE_DIR', '/Applications/MAMP/htdocs/');
	define('NUTRITION_DIR', '/Applications/MAMP/htdocs/food/');
	$config['DB']['host']	= "localhost";
	$config['DB']['user']	= "root";
	$config['DB']['pass']	= "root";
	$config['DB']['name']	= "nutrition_db";
	$config['DB']['type']	= "mysql";
}

require(BASE_DIR . 'smarty/libs/Smarty.class.php');
require(BASE_DIR . 'adodb5/adodb.inc.php');
require(NUTRITION_DIR . 'lib/SmartyPaginate.class.php');
// require(BASE_DIR . 'lib/FirePHPCore/FirePHP.class.php');
// $firephp = FirePHP::getInstance(true);
// $firephp->setEnabled(true); // set to false in production

$conn = &ADONewConnection($config['DB']['type']);
$conn->PConnect($config['DB']['host'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['name']);

// Smarty configuration
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

/*
Daily Values
Trans Fat (FATRN) is not listed because there is 
no Daily Value % associated with this measurement
TODO: Get source of these numbers
*/
$config['DV']['FAT'] 		= 65;	// g
$config['DV']['FASAT'] 		= 20; 	// g
$config['DV']['CHOLE']		= 300;	// mg
$config['DV']['NA']			= 2400; // mg
$config['DV']['K']			= 3500;	// mg
$config['DV']['CHOCDF']		= 300;	// g
$config['DV']['FIBTG']		= 25;	// g
$config['DV']['PROCNT']		= 50;	// g
$config['DV']['VITA_IU']	= 5000;	// IU
$config['DV']['VITC']		= 60;	// mg
$config['DV']['CA']			= 1000;	// mg
$config['DV']['FE']			= 18;	// mg
$config['DV']['VITD']		= 400;	// IU
$config['DV']['TOCPHA']		= 30;	// IU
$config['DV']['VITK']		= 80;	// mcg
$config['DV']['THIA']		= 1.5;	// mg
$config['DV']['RIBF']		= 1.7;	// mg
$config['DV']['NIA']		= 20;	// mg
$config['DV']['VITB6A']		= 2;	// mg
$config['DV']['FOL']		= 400;	// mcg
$config['DV']['VITB12']		= 6;	// mcg
$config['DV']['PANTAC']		= 10;	// mg
$config['DV']['P']			= 1000;	// mg
$config['DV']['MG']			= 400;	// mg
$config['DV']['ZN']			= 15;	// mg
$config['DV']['SE']			= 70;	// mcg
$config['DV']['CU']			= 2;	// mg
$config['DV']['MN']			= 2;	// mg

/*
Source: http://www.fda.gov/Food/GuidanceComplianceRegulatoryInformation/GuidanceDocuments/FoodLabelingNutrition/FoodLabelingGuide/ucm064904.htm#specific
Calories from fat
21 CFR 101.9(c)(1)(ii)13 	Less than 0.5 g fat 	"Not a significant source of calories from fat"
Saturated fat
21 CFR 101.9(c)(2)(i)14 	Less than 0.5g of total fat 	"Not a significant source of saturated fat"
Trans fat
21 CFR 101.9(c)(2)(ii)15 	Less than 0.5g of total fat 	"Not a significant source of trans fat"
Cholesterol
21 CFR 101.9(c)(3)16 	Less than 2 mg 	"Not a significant source of cholesterol"
Dietary fiber
21 CFR 101.9(c)(6)(i)17 	Less than 1g 	"Not a significant source of dietary fiber"
Sugars
21 CFR 101.9(c)(6)(ii)18 	Less than 1g 	"Not a significant source of sugars"
Vitamins A and C, calcium, and iron
21 CFR 101.9(c)(8)(iii)19 	Less than 2% of RDI 	"Not a significant source of _________" (listing the vitamins or minerals omitted)
*/
$config['DV']['footnote'] 	= "";
