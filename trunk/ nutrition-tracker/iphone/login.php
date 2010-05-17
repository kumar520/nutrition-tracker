<?php 
require '../config/config.php';
require '../lib/login.class.php';

if ($_REQUEST['action'] == 'submit') 
{	
	$login = new Login;
	
	if ($login->processLogin($_REQUEST)) 
	{
		header('Location: index.php');
	}
}

require 'header.php';
?>
<div id="topbar">
    <div id="title">Login</div>
    <div id="leftbutton"> <a href="index.php">Home</a></div>
</div>
<div id="content">
<ul class="pageitem">
<form method="post" action="login.php?action=submit">
    <fieldset>
        <li class="bigfield">
            <input placeholder="Email Address" type="text" name="email_addr" />
        </li>
        <li class="bigfield">
            <input placeholder="Password" type="password" name="password" />
        </li>
		<li class="button">
			<input name="Submit" type="submit" value="Submit" /></li>        
        <!--<li class="checkbox">
        	<span class="name">Remember Me</span>
			<input name="remember" type="checkbox" /></li>-->
    </fieldset>
</form>
</div>
<!--<div id="content">-->
<?php require 'footer.php'; ?>