<?php /*%%SmartyHeaderCode:13965906554bea1d439d87f7-66701337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1273031889,
    ),
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1272640926,
    ),
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1267542010,
    ),
  ),
  'nocache_hash' => '13965906554bea1d439d87f7-66701337',
  'has_nocache_code' => false,
  'cache_lifetime' => 120,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8rc3.custom.css" rel="stylesheet" />
<link type="text/css" href="css/style.css" rel="stylesheet" />
<link type="text/css" href="css/reset-fonts-grids.css" rel="stylesheet" />
<link rel="stylesheet" href="css/ui.selectmenu.css" type="text/css" /> 
<script type="text/javascript" src="js/ui.selectmenu.js"></script>
<script type="text/javascript">
$(function() {
	$('#term').focus(function() {
		// alert($('#term').val());
		if ($('#term').val() == 'Search') {
			$('#term').val('');
			$('#term').addClass('search_focus');
			$('#term').removeClass('search_blur');
		}
	});
	$('#term').blur(function() {
		if ($('#term').val() == '') {
			$('#term').addClass('search_blur');
			$('#term').removeClass('search_focus');
			$('#term').val('Search');
		}		
	});
});
</script>
</head>
<body>
<div id="doc2">
<div id="nav" class="yui-g">
<ul>
<li><a href="index.php">Home</a></li>
<li>|</li>
<li><a href="login.php">Login</a></li>
<li>|</li>
<li><a href="register.php">Register</a></li>
</ul>
</div>
<div id="hd" class="yui-g">
<div class="yui-u first">
<h1><a href="index.php" style="color: #fff;">Nutrition Tracker</a></h1></div>
<div class="yui-u right" style="font-size: 85%">
<form name="frmSearch" id="frmSearch" action="search.php?action=submit" method="post" style="margin-top: .4em;">
<input name="term" type="text" id="term" size="30" value="Search" class="search_blur" /><br />
<!--<a href="javascript:$('#frmSearch').submit()" style="color: #fff; font-weight: bold;">Search</a>-->
</form>
</div>
</div>

<div id="bd">
    <div class="yui-g">
        <h2>Welcome</h2>
    </div>
    <div class="yui-g">
        	C0005 Ruby Tuesday, Lobster Carbonara<br />
        	C0004 Ruby Tuesday, Parmesan Shrimp Pasta<br />
        	C0129 McDONALD'S USA, Chocolate Triple Thick&copy; Shake (32 fl oz cup)<br />
        	C0101 McDONALD'S USA, Deluxe Breakfast (Large Size Biscuit) w/o Syrup & Margarine<br />
        	C0137 McDONALD'S USA, Vanilla Triple Thick&copy; Shake (32 fl oz cup)<br />
        </div>
</div>
		<div id="ft">
        	<small>Copyright 2010 Basement Ventures, Inc. All rights reserved.</small>
        </div>
    </div>
</body>
</html>

