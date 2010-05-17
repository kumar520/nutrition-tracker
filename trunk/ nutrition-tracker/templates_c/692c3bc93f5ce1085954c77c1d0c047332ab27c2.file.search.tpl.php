<?php /* Smarty version Smarty3-b7, created on 2010-05-13 23:26:48
         compiled from "./templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3018257184becc2f80ee359-32690052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '692c3bc93f5ce1085954c77c1d0c047332ab27c2' => 
    array (
      0 => './templates/search.tpl',
      1 => 1272638746,
    ),
  ),
  'nocache_hash' => '3018257184becc2f80ee359-32690052',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_paginate_first')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/function.paginate_first.php';
if (!is_callable('smarty_function_paginate_middle')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/function.paginate_middle.php';
if (!is_callable('smarty_function_paginate_last')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/function.paginate_last.php';
?><?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script>
$(function() {
	$("#button").hover(function(){ $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
});
</script>
<div id="bd">
    <div class="yui-g">
        <h2>Search</h2>
    </div>
    <hr class="thin" style="background-color: #ccc !important;" />
    <div class="yui-g"> 
        <form class="search" action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post">
			<table class="input-form">
                <tr>
                    <td><input name="term" type="text" class="required" id="term" value="<?php echo stripslashes($_REQUEST['term']);?>
" size="25" />
                    <button type="submit" id="button" class="nt-button ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"><span class="ui-button-text">Search</span></button></td>
                </tr>
            </table>
        </form>
    </div> 
    <div class="yui-g"> 
        <?php echo $_smarty_tpl->getVariable('error')->value;?>

        <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total=count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['results']['total'] = $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['results']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['results']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['results']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['results']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['results']['first']){?>
			<table class="search-results">
            	<tr>
                	<td style="background-color: #CCC">
                    	<?php if ($_smarty_tpl->getVariable('paginate')->value['size']>1){?>Items <?php echo $_smarty_tpl->getVariable('paginate')->value['first'];?>
-<?php echo $_smarty_tpl->getVariable('paginate')->value['last'];?>
 of 
                        <?php echo $_smarty_tpl->getVariable('paginate')->value['total'];?>
 displayed.<?php }else{ ?>Item <?php echo $_smarty_tpl->getVariable('paginate')->value['first'];?>
 of <?php echo $_smarty_tpl->getVariable('paginate')->value['total'];?>
 displayed.<?php }?>
		            </td>
				</tr>
            	<tr>
            		<td>
            			<?php echo smarty_function_paginate_first(array(),$_smarty_tpl->smarty,$_smarty_tpl);?> <?php echo smarty_function_paginate_middle(array('format'=>"page",'prefix'=>" [ ",'suffix'=>" ] "),$_smarty_tpl->smarty,$_smarty_tpl);?> <?php echo smarty_function_paginate_last(array(),$_smarty_tpl->smarty,$_smarty_tpl);?>
            		</td>
				</tr>
            <?php }?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['results']['iteration']%2==0){?>
            	<tr>
            <?php }else{ ?>
            	<tr style="background-color: white">
            <?php }?>
            		<td>
                    	<a href="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
"><?php echo $_smarty_tpl->getVariable('i')->value['long_desc'];?>
</a>
                    </td>
				</tr>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['results']['last']){?>
            </table>
            <?php }?>
        <?php }} ?>	
    </div> 
</div> 
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
