{include file="header.tpl"}
<script type="text/javascript">
	$(document).ready(function(){
		$("#loginForm").validate({
			errorClass: "error",
			errorPlacement: function(error, element) {
				error.appendTo(element.parent("div").next("input"));
			}
		});
		$("#button").hover(function(){ $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
	});
</script>
<div id="bd">
    <div class="yui-g">
        <h2>Account Login</h2>
    </div>
{if $error neq ""}
<div class="ui-state-error ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>{$error}</div>
{elseif $highlight neq ""}
<div class="ui-state-highlight ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>{$highlight}</div>
{else}
<hr class="thin" style="background-color: #ccc !important;" />
{/if}
    <div class="yui-g">
        <form name="loginForm" id="loginForm" action="{$SCRIPT_NAME}?action=submit" method="post" class="form-container">
            <table class="input-form">
                <tr>
                    <th><label for="email_addr">Email</label></th>
                    <td><input name="email_addr" type="text" class="required email" id="email_addr" value="{$smarty.post.email_addr}" size="30" /><br />
                    	<span class="input-form-help">Enter the email address you used to register.</span></td>
                </tr>
                <tr>
                    <th><label for="password">Password</label></th>
                    <td><input name="password" type="password" class="required" id="password" value="{$smarty.post.password}" size="30" /><br />
                    	<span class="input-form-help">Enter the password you used to regsiter.</span></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><button type="submit" id="button" class="nt-button ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"><span class="ui-button-text">Login</span></button></td>
                </tr>
            </table>
        </form>
    </div> 
</div>
{include file="footer.tpl"}