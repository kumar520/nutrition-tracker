<?php /*%%SmartyHeaderCode:5057890154b9a6a240dd062-66759308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78a1caec36414e9a88b61b5bd4cf22ed36876391' => 
    array (
      0 => './templates/additem.tpl',
      1 => 1268411178,
    ),
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1268324882,
    ),
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1267542010,
    ),
  ),
  'nocache_hash' => '5057890154b9a6a240dd062-66759308',
  'cache_lifetime' => 120,
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nutrition Tracker</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8rc3.custom.css" rel="stylesheet" />
<link type="text/css" href="css/style.css" rel="stylesheet" />
<link type="text/css" href="css/reset-fonts-grids.css" rel="stylesheet" />
</head>
<body>
<div id="doc2">
<div id="nav" class="yui-g">
<ul>
<li><a href="index.php">Home</a></li>
<li>|</li>
<li><a href="search.php">Search</a></li>
<li>|</li>
<li><a href="tracker.php">Tracker</a></li>
<li>|</li>
<li><a href="additem.php">Custom Food</a></li>
</ul>
</div>
<div id="hd" class="yui-g">
<h1>Nutrition Tracker</h1>
</div>
<script>
$(document).ready(function(){
	$("#foodForm").validate({
		errorClass: "error",
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td").next("input"));
		}
	});
});
</script>
<div id="bd">
    <div class="yui-g">
        <h2>Add Custom Food</h2>
    </div>
        <div class="yui-g">
        <form action="additem.php" method="post" name="foodForm" id="foodForm">
            <table class="custom-tbl">
                <tr class="top">
                    <td colspan="4"><label class="bold" for="name">Name *</label>
                        <br />
                        <input name="name" type="text" id="name" size="30" minlength="5" class="required" /></td>
                </tr>
                <tr>
                    <td><label class="bold" for="calories">Calories *</label></td>
                    <td><input id="calories" name="calories" type="text" size="5" class="required"></td>
                    <td>Calcium</td>
                    <td><input name="calcium" type="text" size="5" id="calcium">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Fat *</td>
                    <td><input name="fat" type="text" size="5" id="fat" class="required">
                        g</td>
                    <td>Copper</td>
                    <td><input name="copper" type="text" size="5" id="copper">
                        %</td>
                </tr>
                <tr>
                    <td style="padding-left: 1em;">Saturated Fat</td>
                    <td><input name="satfat" type="text" size="5" id="satfat">
                        g</td>
                    <td>Iron</td>
                    <td><input name="iron" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Polyunsaturated Fat</td>
                    <td><input name="polyfat" type="text" size="5" id="polyfat">
                        g</td>
                    <td>Magnesium</td>
                    <td><input name="magnesium" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td style="padding-left: 1em;">Monounsaturated Fat</td>
                    <td><input name="monofat" type="text" size="5" id="monofat">
                        g</td>
                    <td>Manganese</td>
                    <td><input name="manganese" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Cholesterol</td>
                    <td><input name="cholesterol" type="text" size="5" id="cholesterol">
                        mg</td>
                    <td>Niacin</td>
                    <td><input name="niacin" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td class="bold">Sodium</td>
                    <td><input name="sodium" type="text" size="5" id="sodium">
                        mg</td>
                    <td>Phosphorus</td>
                    <td><input name="phosphorus" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Potassium</td>
                    <td><input name="potassium" type="text" size="5" id="potassium">
                        mg</td>
                    <td>Riboflavin</td>
                    <td><input name="riboflavin" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td class="bold">Carbohydrate</td>
                    <td><input name="carbohydrate" type="text" size="5" id="carbohydrate">
                        g</td>
                    <td>Selenium</td>
                    <td><input name="selenium" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Dietary Fiber *</td>
                    <td><input name="fiber" type="text" size="5" id="fiber" class="required">
                        g</td>
                    <td>Thiamin</td>
                    <td><input name="thiamin" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td style="padding-left: 1em;">Sugars</td>
                    <td><input name="sugars" type="text" size="5" id="sugars" />
                        g</td>
                    <td>Vitamin A</td>
                    <td><input name="vita" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Protein</td>
                    <td><input name="protein" type="text" size="5" id="protein" />
                        g</td>
                    <td>Vitamin B12</td>
                    <td><input name="vitb12" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td class="bold">Alcohol</td>
                    <td class="alt"><input name="alcohol" type="text" size="5" id="alcohol" />
                        g</td>
                    <td>Vitamin B6</td>
                    <td><input name="vitb6" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Vitamin C</td>
                    <td><input name="vitc" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Vitamin D</td>
                    <td><input name="vitd" type="text" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Vitamin E</td>
                    <td><input name="vite" type="text" size="5">
                        %</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Zinc</td>
                    <td><input name="zinc" type="text" size="5">
                        %</td>
                </tr>
            </table>
            <input type="submit" id="save" value="Save" />
        </form>
    </div>
</div>
		<div id="ft">
        	<small>Copyright 2010 Basement Ventures, Inc. All rights reserved.</small>
        </div>
    </div>
</body>
</html>
 