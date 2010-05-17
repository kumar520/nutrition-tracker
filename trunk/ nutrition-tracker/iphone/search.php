<?php require '../config/config.php'; ?>
<?php
// $_SESSION['tracker_meal'] = $_GET['meal'];

if ($_REQUEST['action'] == 'submit') 
{
	require '../lib/search.class.php';
	$search = new Search;
	$results = $search->doSearch($_POST, 0, 50);
}
?>
<?php require 'header.php'; ?>
<div id="topbar">
	<div id="title">
    	Search</div>
    <div id="leftnav">
    	<a href="index.php">Home</a></div>
</div>
<div class="searchbox">
	<form action="search.php?action=submit" method="post">
		<fieldset>
        	<input id="term" name="term" placeholder="search" type="text" />
			<input id="submit" type="hidden" />
        </fieldset>
	</form>
</div>
<div id="content">
    <ul class="pageitem">
	<?php if (count($results) == 0) : ?>
		<li class="textbox"><span class="header">Search</span>Use the search box (above) to search the database for specific food items. Registered users can add their own "custom" foods.</li>
    <?php else : ?>
	<?php
	foreach ($results as $result)
	{
		echo '<li class="menu"><a href="facts.php?action=view&meal=' . $_SESSION['tracker_meal'] . '&tracker_date=' . $_SESSION['tracker_date'] . '&ndb_no=' . $result['ndb_no'] . '"><span class="name">' . $result['long_desc'] . '</span><span class="arrow"></span></a></li>';
	}
	// echo '<li class="menu"><a href="search.php?action=submit&start='.$start.'"><span class="name">View more results...</span><span class="arrow"></span></a></li>';
	?>
    <?php endif; ?>
	</ul>
<?php require 'footer.php'; ?>