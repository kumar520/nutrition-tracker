<?php /* Smarty version Smarty3-b7, created on 2010-05-11 23:10:06
         compiled from "./templates/customfood.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13010772414bea1c0e71e074-36042711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aa6bc5b7e2f6c56d0a4d1b91c2fe696211c70f7' => 
    array (
      0 => './templates/customfood.tpl',
      1 => 1273633327,
    ),
  ),
  'nocache_hash' => '13010772414bea1c0e71e074-36042711',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script>
$(document).ready(function(){
	$("#foodForm").validate({
		errorClass: "error",
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td").next("input"));
		}
	});
	$("#button").hover(
	function(){ 
		$(this).addClass("ui-state-hover"); 
	},
	function(){ 
		$(this).removeClass("ui-state-hover"); 
	});
});


</script>
<div id="bd">
    <div class="yui-g">
        <h2>Add Custom Food</h2>
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
        <form action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post" name="foodForm" id="foodForm" class="form-container">
        	<input type="hidden" name="ndb_no" id="ndb_no" value="<?php echo $_POST['ndb_no'];?>
" />
            <table class="custom-tbl form-section">
                <tr class="top">
                    <td colspan="4"><label class="bold" for="name">Name *</label>
                        <br />
                        <input name="name" type="text" class="required" id="name" style="width: 50%" value="<?php echo stripslashes($_POST['name']);?>
" minlength="5" /></td>
                </tr>
                <tr>
                    <td><label class="bold" for="calories">Calories *</label></td>
                    <td><input name="calories" type="text" class="required" id="calories" value="<?php echo round($_POST['calories']);?>
" size="5"></td>
                    <td>Calcium</td>
                    <td><input name="calcium" type="text" id="calcium" value="<?php echo round($_POST['calcium']);?>
" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Fat *</td>
                    <td><input name="fat" type="text" class="required" id="fat" value="<?php echo round($_POST['fat']);?>
" size="5">
                        g</td>
                    <td>Iron</td>
                    <td><input name="iron" type="text" value="<?php echo round($_POST['iron']);?>
" size="5" />
                        %</td>
                </tr>
                <tr>
                    <td style="padding-left: 1em;">Saturated Fat</td>
                    <td><input name="satfat" type="text" id="satfat" value="<?php echo round($_POST['satfat']);?>
" size="5">
                        g</td>
                    <td>Vitamin A</td>
                    <td><input name="vita" type="text" value="<?php echo round($_POST['vita']);?>
" size="5" />
                        %</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Trans Fat</td>
                    <td><input name="transfat" type="text" id="transfat" value="<?php echo round($_POST['transfat']);?>
" size="5" /> 
                        g</td>
                    <td>Vitamin C</td>
                    <td><input name="vitc" type="text" value="<?php echo round($_POST['vitc']);?>
" size="5" />
                        %</td>
                </tr>
                <tr>
                    <td class="bold">Cholesterol</td>
                    <td><input name="cholesterol" type="text" id="cholesterol" value="<?php echo round($_POST['cholesterol']);?>
" size="5">
                        mg</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Sodium</td>
                    <td><input name="sodium" type="text" id="sodium" value="<?php echo round($_POST['sodium']);?>
" size="5">
                        mg</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="bold">Carbohydrate</td>
                    <td class="alt"><input name="carbohydrate" type="text" id="carbohydrate" value="<?php echo round($_POST['carbohydrate']);?>
" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Dietary Fiber *</td>
                    <td><input name="fiber" type="text" class="required" id="fiber" value="<?php echo round($_POST['fiber']);?>
" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="alt" style="padding-left: 1em;">Sugars</td>
                    <td class="alt"><input name="sugars" type="text" id="sugars" value="<?php echo round($_POST['sugars']);?>
" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Protein</td>
                    <td><input name="protein" type="text" id="protein" value="<?php echo round($_POST['protein']);?>
" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div class="form-section">
            	<button type="submit" id="button">Save</button>
            </div>
        </form>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
 