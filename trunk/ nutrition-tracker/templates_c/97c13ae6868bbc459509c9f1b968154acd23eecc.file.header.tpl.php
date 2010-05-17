<?php /* Smarty version Smarty3-b7, created on 2010-05-11 23:10:06
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13142416764bea1c0e901dc5-98573314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1272640926,
    ),
  ),
  'nocache_hash' => '13142416764bea1c0e901dc5-98573314',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
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
<?php if ($_SESSION['user_info']['email_addr']==''){?>
<li><a href="login.php">Login</a></li>
<li>|</li>
<li><a href="register.php">Register</a></li>
<?php }else{ ?>
<li><a href="profile.php">Profile</a></li>
<li>|</li>
<li><a href="tracker.php">Tracker</a></li>
<li>|</li>
<li><a href="customfood.php">Custom Food</a></li>
<li>|</li>
<li><a href="logout.php">Sign Out</a>
<?php }?>
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
