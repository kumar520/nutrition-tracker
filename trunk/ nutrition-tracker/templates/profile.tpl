{include file="header.tpl"}
<script type="text/javascript">
$(function() {
	$("#button").hover(function(){ $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
});
</script>
<div id="bd">
    <div class="yui-g">
        <h2>Profile</h2>
    </div>
    {if $error neq ""}
    <div class="ui-state-error ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>{$error}</div>
    {elseif $highlight neq ""}
    <div class="ui-state-highlight ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>{$highlight}</div>
    {else}
    <hr class="thin" style="background-color: #ccc !important;" />
    {/if}
    <div class="yui-g">
    <form name="frmProfile" id="frmProfile" action="profile.php?action=submit" method="post">
	<table class="input-form">
        <tr>
        	<th><label for="name">Name</label></th>
            <td><input name="name" type="text" id="name" value="{$name|stripslashes}" size="30" /><br />
            	<span class="input-form-help">Enter your real name, or an alias.</span></td>
        </tr>
        <tr>
        	<th><label for="email_addr">Email</label></th>
            <td><input name="email_addr" type="text" id="email_addr" value="{$email_addr}" size="30" /><br />
            	<span class="input-form-help">Carefully enter your current email address.</span></td>
        </tr>
        <tr>
        	<th><label for="password">Password</label></th>
            <td><input name="password" type="password" id="password" value="" size="30" /><br />
            	<span class="input-form-help">Only fill-in this field if you are changing your password.</span></td>
        </tr>
        <tr>
        	<th></th>
            <td><button type="submit" id="button" class="nt-button ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"><span class="ui-button-text">Register</span></button></td>
        </tr>
    </table>
    </form>
    </div>
</div>
{include file="footer.tpl"}