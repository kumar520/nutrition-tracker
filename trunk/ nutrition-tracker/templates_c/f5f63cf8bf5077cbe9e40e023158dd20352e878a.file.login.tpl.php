<?php /* Smarty version Smarty3-b7, created on 2010-05-12 17:51:34
         compiled from "./templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12889498074beb22e6928673-97403775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5f63cf8bf5077cbe9e40e023158dd20352e878a' => 
    array (
      0 => './templates/login.tpl',
      1 => 1269178902,
    ),
  ),
  'nocache_hash' => '12889498074beb22e6928673-97403775',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

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
<?php if ($_smarty_tpl->getVariable('error')->value!=''){?>
<div class="ui-state-error ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><?php echo $_smarty_tpl->getVariable('error')->value;?>
</div>
<?php }elseif($_smarty_tpl->getVariable('highlight')->value!=''){?>
<div class="ui-state-highlight ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><?php echo $_smarty_tpl->getVariable('highlight')->value;?>
</div>
<?php }else{ ?>
<hr class="thin" style="background-color: #ccc !important;" />
<?php }?>
    <div class="yui-g">
        <form name="loginForm" id="loginForm" action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post" class="form-container">
            <table class="input-form">
                <tr>
                    <th><label for="email_addr">Email</label></th>
                    <td><input name="email_addr" type="text" class="required email" id="email_addr" value="<?php echo $_POST['email_addr'];?>
" size="30" /><br />
                    	<span class="input-form-help">Enter the email address you used to register.</span></td>
                </tr>
                <tr>
                    <th><label for="password">Password</label></th>
                    <td><input name="password" type="password" class="required" id="password" value="<?php echo $_POST['password'];?>
" size="30" /><br />
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
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
