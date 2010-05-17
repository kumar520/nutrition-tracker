<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Weight Watchers Points Calculator</title>
<style type="text/css">
	.weight { color: #CCC; }
</style>
</head>
<body>
<?php
	error_reporting(E_ALL ^E_NOTICE);
    if ($_REQUEST['sex'] != '')
    {
    	$pts = $_REQUEST['sex'] + $_REQUEST['age'] + $_REQUEST['weight'] + $_REQUEST['height'] + $_REQUEST['day'];
        echo $pts;
    }
?>
<form id="form1" name="form1" method="post" action="ww.php">
    <table border="1" cellpadding="2" width="400">
    	<tr>
        	<td><label for="sex">Sex:</label></td>
            <td><select name="sex" id="sex">
        <option value="-1">-</option>
        <option value="2">Female</option>
        <option value="8">Male</option>
        <option value="12">Nursing</option>
    </select></td>
        </tr>
    	<tr>
    	    <td>Age:</td>
    	    <td><select name="age" id="age">
                <option value="-1">-</option>
                <option value="4">17-26</option>
                <option value="3">27-37</option>
                <option value="2">38-47</option>
                <option value="1">48-58</option>
                <option value="0">58+</option>
            </select></td>
	    </tr>
    	<tr>
    	    <td>Weight:</td>
    	    <td><input type="text" class="weight" name="weight" id="weight" value="First two digits" onfocus="this.value='';this.style.color='#000'" onblur="if (this.value.length==2) {this.value='First two digits';this.style.color='#CCC';)" /></td>
	    </tr>
    	<tr>
    	    <td>Height:</td>
    	    <td><select name="height" id="height">
                <option value="-1">-</option>
                <option value="0">Under 5'1&quot;</option>
                <option value="1">5'1&quot;-5'10&quot;</option>
                <option value="2">over 5'10&quot;</option>
            </select></td>
	    </tr>
    	<tr>
    	    <td>How do you spend your day? </td>
    	    <td><select name="day" id="day">
                <option value="-1">-</option>
                <option value="0">Sitting down</option>
                <option value="2">Occasionally sitting, but mainly standing</option>
                <option value="4">Walking most of the time</option>
                <option value="6">Doing hard physical work</option>
            </select></td>
	    </tr>
    </table>
    <input type="submit" name="calc" id="calc" value="Calculate" />
</form>
</body>
</html>
