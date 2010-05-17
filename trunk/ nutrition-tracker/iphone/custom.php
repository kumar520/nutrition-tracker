<?php require '../config/config.php'; ?>
<?php
$status = '';

if ($_REQUEST['action'] == 'submit') 
{
	require '../lib/weightwatchers.class.php';
	require '../lib/customfood.class.php';
	
	$custom = new CustomFood;
	
	if ($custom->isValidForm($_POST)) {
		if ($custom->addEntry($_POST)) {
			$status = $_POST['name'] . " has been added to the database.";
			unset($_POST);
		}
		else {
			$status = "There was an error adding this custom food to the database.";
		}
	}
	else {
		$status = "In order to submit the form, all fields must be completed.";
	}
}
?>
<?php require 'header.php'; ?>
<div id="topbar">
    <div id="title">Custom Food</div>
    <div id="leftnav"> <a href="index.php">Home</a></div>
</div>
<div id="content">
<? if ($status !== ''): ?>
<ul class="pageitem">
    <li class="textbox"><?=$status?></li>
</ul>
<? endif; ?>
<ul class="pageitem">
	<form method="post" action="custom.php?action=submit">
    	<fieldset>
        	<li class="smallfield">
            	<span class="name">Name</span>
            	<input placeholder="" type="text" value="<?=$_POST['name']?>" name="name" /></li>
        	<li class="smallfield">
            	<span class="name">Calories</span>
            	<input placeholder="" type="text" name="calories" value="<?=$_POST['calories']?>" /></li>
        	<li class="smallfield">
            	<span class="name">Fat</span>
            	<input placeholder="grams" type="text" name="fat" value="<?=$_POST['fat']?>" /></li>
        	<li class="smallfield">
            	<span class="name">Dietary Fiber</span>
            	<input placeholder="grams" type="text" name="fiber" value="<?=$_POST['fiber']?>" /></li>
            <li class="button">
				<input name="Submit" type="submit" value="Submit" /></li>
        </fieldset>
    </form>
</ul>
</div>
<?php require 'footer.php'; ?>