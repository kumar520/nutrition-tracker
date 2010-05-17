<? 
require '../config/config.php'; 
require '../lib/tracker.class.php';

function add_day($days,$time_zone,$format) 
{
	$zone=3600*$time_zone;
	$new_time = time() + $zone + ($days * 24 * 60 * 60);
	$new_date=gmdate($format, $new_time);
	return $new_date;
}

$tracker_date = isset($_REQUEST['tracker_date']) ? $_REQUEST['tracker_date'] : date('Y-m-d');
$prev_date = date('Y-m-d', strtotime($tracker_date . ' - 1 days')); 
$next_date = date('Y-m-d', strtotime($tracker_date . ' + 1 days')); 

// This is set to be used by search when a user clicks 'add to tracker'
$_SESSION['tracker_date'] = $tracker_date;
$tracker = new Tracker($_SESSION['tracker_date']);
?>
<? require 'header.php'; ?>
<script type="text/javascript">
function pickDate() {
	var now = new Date();
	var days = { };
	var years = { };
	var months = { 1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr', 5: 'May', 6: 'Jun', 7: 'Jul', 8: 'Aug', 9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec' };
		
	for( var i = 1; i < 32; i += 1 ) {
		days[i] = i;
	}

	for( i = now.getFullYear()-1; i < now.getFullYear()+2; i += 1 ) {
		years[i] = i;
	}

	SpinningWheel.addSlot(years, 'right', now.getFullYear());
	SpinningWheel.addSlot(months, '', now.getMonth()+1);
	SpinningWheel.addSlot(days, 'right', now.getDate());
	SpinningWheel.setCancelAction(cancel);
	SpinningWheel.setDoneAction(done);
	SpinningWheel.open();
}

function done() {
	var results = SpinningWheel.getSelectedValues();
	if (results.keys[1].length < 2) results.keys[1] = '0' + results.keys[1];
	if (results.keys[2].length < 2) results.keys[2] = '0' + results.keys[2];
	var tracker_date = results.keys[0] + '-' + results.keys[1] + '-' + results.keys[2];
	location.href='tracker.php?tracker_date=' + tracker_date;
	// alert('values:' + results.values.join(', ') + ' - keys: ' + results.keys.join(', '));
}

function cancel() {
	// alert('cancelled!');
}
</script>
<div id="topbar">
	<div id="title">
    	My Tracker</div>
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
<div id="tributton">
    <div class="links">
	   	<a href="tracker.php?tracker_date=<?=$prev_date?>">&lt;&lt; Prev</a><a href="javascript:pickDate()"><?=$tracker_date?></a><a href="tracker.php?tracker_date=<?=$next_date?>">Next &gt;&gt;</a></div>
</div>
<div id="content">
	<span class="graytitle">Breakfast</span>
    <ul class="pageitem">
    	<?
		$results = $tracker->getTrackerMobile($tracker_date, 'B', $_SESSION['user_info']['user_id']);
		if (!$results->EOF) :
			while(!$results->EOF) { echo '<li class="menu"><span class="name">' . $results->fields['long_desc'] . '</span></li>'; $results->MoveNext(); }
		else:
			echo '<li class="menu"><a href="search.php"><span class="name">Add Item</span><span class="arrow"></span></a></li>';
		endif;
		?>
        <!---->
    </ul>
	<span class="graytitle">Lunch</span>
    <ul class="pageitem">
    	<? 
		$results = $tracker->getTrackerMobile($tracker_date, 'L', $_SESSION['user_info']['user_id']);
		if (!$results->EOF) :
			while(!$results->EOF) { echo '<li class="menu"><span class="name">' . $results->fields['long_desc'] . '</span></li>'; $results->MoveNext(); }
		else:
			echo '<li class="menu"><a href="search.php"><span class="name">Add Item</span><span class="arrow"></span></a></li>';
		endif;
		?>
        <!--<li class="menu"><a href="search.php?meal=lunch"><span class="name">Add Item</span>
            <span class="arrow"></span></a></li>-->
    </ul>
	<span class="graytitle">Dinner</span>
    <ul class="pageitem">
    	<? 
		$results = $tracker->getTrackerMobile($tracker_date, 'D', $_SESSION['user_info']['user_id']);
		if (!$results->EOF) :
			while(!$results->EOF) { echo '<li class="menu"><span class="name">' . $results->fields['long_desc'] . '</span></li>'; $results->MoveNext(); }
		else:
			echo '<li class="menu"><a href="search.php"><span class="name">Add Item</span><span class="arrow"></span></a></li>';
		endif;
		?>
        <!--<li class="menu"><a href="search.php?meal=dinner"><span class="name">Add Item</span>
            <span class="arrow"></span></a></li>-->
    </ul>
	<span class="graytitle">Snacks</span>
    <ul class="pageitem">
    	<? 
		$results = $tracker->getTrackerMobile($tracker_date, 'S', $_SESSION['user_info']['user_id']);
		if (!$results->EOF) :
			while(!$results->EOF) { echo '<li class="menu"><span class="name">' . $results->fields['long_desc'] . '</span></li>'; $results->MoveNext(); }
		else:
			echo '<li class="menu"><a href="search.php"><span class="name">Add Item</span><span class="arrow"></span></a></li>';
		endif;
		?>
        <!--<li class="menu"><a href="search.php?meal=snacks"><span class="name">Add Item</span>
            <span class="arrow"></span></a></li>-->
    </ul>
</div>
<? require 'footer.php'; ?>