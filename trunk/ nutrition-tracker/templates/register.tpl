{include file="header.tpl"}
<script type="text/javascript">
 	$(function(){
		$("#button").hover(function(){ $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
	});
</script>
<div id="bd">
    <div class="yui-g">
        <h2>Register</h2>
    </div>
    {if $error neq ""}
    <div class="ui-state-error ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>{$error}</div>
    {elseif $highlight neq ""}
    <script type="text/javascript">$(function() { $("#regForm").hide();	});</script>
    <div class="ui-state-highlight ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>{$highlight}</div>
    {else}
    <hr class="thin" style="background-color: #ccc !important;" />
    {/if}
    <div class="yui-g">
        <form name="regForm" id="regForm" action="{$SCRIPT_NAME}?action=submit" method="post" class="form-container">
            <table class="input-form">
                <tr>
                    <th><label for="email_addr">Email</label></th>
                    <td><input name="email_addr" type="text" class="required email" id="email_addr" value="{$smarty.post.email_addr}" size="30" /><br />
                    	<span class="input-form-help">Carefully enter your email address.</span></td>
                </tr>
                <tr>
                    <th><label for="password1">Password</label></th>
                    <td><input name="password1" type="password" class="required" id="password1" value="{$smarty.post.password1}" size="30" /><br />
                    	<span class="input-form-help">Password must be at least 8 characters long.</span></td>
                </tr>
                <tr>
                    <th><label for="password2">Password again</label></th>
                    <td><input name="password2" type="password" class="required" id="password2" value="{$smarty.post.password2}" size="30" /><br />
                    	<span class="input-form-help">Re-enter your password so we get it right.</span></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><button type="submit" id="button" class="nt-button ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"><span class="ui-button-text">Register</span></button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
{include file="footer.tpl"}