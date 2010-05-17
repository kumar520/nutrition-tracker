<?php require '../config/config.php'; ?>
<?php
if ($_SESSION['user_info']['user_id'] == '')
	header('Location: index.php');

if ($_REQUEST['action'] == 'view')
{
	require '../lib/weightwatchers.class.php';
	require '../lib/product.class.php';
	$product = new Product;
	$food = $product->getFood($_REQUEST['ndb_no']);
	$data = $product->getProduct($_REQUEST['ndb_no'], 1);
	// print_r($data);
}
elseif ($_REQUEST['action'] == 'submit')
{
	require '../lib/tracker.class.php';
	$tracker = new Tracker($_SESSION['tracker_date']);
	$tracker->insertTrackerMobile($_SESSION['tracker_date'], $_POST['ndb_no'], $_POST['meal'], $_SESSION['user_info']['user_id'], 1, 100, intval($_POST['calories']), intval($_POST['fat']), intval($_POST['fiber']), $_POST['ww_no']);
	header('Location: tracker.php?tracker_date=' . $_SESSION['tracker_date']);
}
else {}
?>
<?php require 'header.php'; ?>
<div id="topbar">
	<div id="title">
    	Nutrition Facts</div>
    <div id="leftnav">
    	<a href="javascript:history.go(-1);">Back</a></div>
</div>
<div id="content">
	<span class="graytitle"><?=$food['long_desc']?></span>
    <form name="" method="post" action="facts.php?action=submit">
    <input type="hidden" value="1" name="quantity" />
    <input type="hidden" value="100" name="weight" />
    <input type="hidden" value="<?=$_SESSION['tracker_date']?>" name="tracker_date" />
    <input type="hidden" value="<?=$_REQUEST['ndb_no']?>" name="ndb_no" />
    <input type="hidden" value="<?=$_SESSION['user_info']['user_id']?>" name="user_id" />
    <fieldset>
    <ul class="pageitem">
		<li class="smallfield">
        	<span class="name">Serving Size</span>
            <input readonly placeholder="" type="text" value="100 g" name="serving" />
    	</li>          
        <li class="smallfield">
        	<span class="name">Calories</span>
            <input readonly placeholder="" type="text" value="<?=round($data['ENERC_KCAL']['nutr_val'],0).' '.$data['ENERC_KCAL']['units']?>" name="calories" />
    	</li>
		<li class="smallfield">
        	<span class="name">Fat</span>
            <input readonly placeholder="" type="text" value="<?=round($data['FAT']['nutr_val'],0).' '.$data['FAT']['units']?>" name="fat" />
    	</li>
		<li class="smallfield">
        	<span class="name">Cholesterol</span>
            <input readonly placeholder="" type="text" value="<?=round($data['CHOLE']['nutr_val'],0).' '.$data['CHOLE']['units']?>" name="cholesterol" />
    	</li>
		<li class="smallfield">
        	<span class="name">Sodium</span>
            <input readonly placeholder="" type="text" value="<?=round($data['NA']['nutr_val'],0).' '.$data['NA']['units']?>" name="sodium" />
    	</li>
		<li class="smallfield">
        	<span class="name">Carbohydrates</span>
            <input readonly placeholder="" type="text" value="<?=round($data['CHOCDF']['nutr_val'],0).' '.$data['CHOCDF']['units']?>" name="carbohydrates" />
    	</li>
        <? if (count($data['FIBTG']) > 0): ?>      
		<li class="smallfield">
        	<span class="name">Dietary Fiber</span>
            <input readonly placeholder="" type="text" value="<?=round($data['FIBTG']['nutr_val'],0).' '.$data['FIBTG']['units']?>" name="fiber" />
    	</li>
        <? endif; ?>
		<li class="smallfield">
        	<span class="name">Points</span>
            <input readonly placeholder="" type="text" value="<?=$food['ww_no']?>" name="ww_no" />
    	</li>      
	</ul>
	<span class="graytitle">Add to Tracker</span>
    <ul class="pageitem">
    	<li class="select">
        <select name="meal">
        	<option value="" selected="selected">Choose meal...</option>
			<option value="b">Breakfast</option>
			<option value="l">Lunch</option>
			<option value="d">Dinner</option>
			<option value="s">Snack</option>
        </select><span class="arrow"></span>
        </li>
        <li class="button">
        	<input name="Submit" type="submit" value="Submit" />
        </li>
    </ul>
    </fieldset>
    </form>
</div>
<?php require 'footer.php'; ?>