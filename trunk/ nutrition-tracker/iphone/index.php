<?php require '../config/config.php'; ?>
<?php require 'header.php'; ?>

<!-- Topbar -->
<div id="topbar">
	<div id="title">Nutrition Tracker</div>
    <!--<div id="rightnav">
    	<a href="search.php">Search</a>
    </div>-->
</div>
<!-- Navigation 
<div id=""></div>-->
<div id="content">
	<span class="graytitle">Features</span>
    <ul class="pageitem">
        <?php if ($_SESSION['user_info']['user_id'] == ''): ?>
    	<li class="textbox">Welcome to Nutrition Tracker. Track everything you eat to lose weight, get healthy, and enjoy life!
		</li>
        <li class="menu"><a href="login.php"><span class="name">Login</span>
            <span class="arrow"></span></a>
        </li>
    	<li class="menu"><a href="register.php"><span class="name">Register</span>
			<span class="arrow"></span></a>
        </li>  
        <li class="menu"><a href="search.php"><span class="name">Search</span>
            <span class="arrow"></span></a>
        </li> 
        <?php else: ?>
        <li class="menu"><a href="custom.php"><span class="name">Custom Food</span>
        	<span class="arrow"></span></a></li>
        <li class="menu"><a href="tracker.php"><span class="name">My Tracker</span>
        	<span class="arrow"></span></a></li>
        <li class="menu"><a href="profile.php"><span class="name">Profile</span>
        	<span class="arrow"></span></a></li>
		<li class="menu"><a href="search.php"><span class="name">Search</span>
            <span class="arrow"></span></a></li> 
        <li class="menu"><a href="logout.php"><span class="name">Logout</span>
        	<span class="arrow"></span></a></li>
		<?php endif; ?>          
	</ul>
</div>
<div id="footer">
	<a class="noeffect" href="http://basementventures.com">Copyright &copy; 2010 Basement Ventures Inc</a><br />
	<a class="noeffect" href="http://iwebkit.net">JS\CSS by iWebKit</a></div>
<?php require 'footer.php'; ?>