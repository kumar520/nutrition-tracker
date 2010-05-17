<?php /* Smarty version Smarty3-b7, created on 2010-05-13 23:27:02
         compiled from "./templates/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10079723344becc306eb4f66-13696471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '596a02a5b0280a75530d396803234209abb39d26' => 
    array (
      0 => './templates/product.tpl',
      1 => 1272736682,
    ),
  ),
  'nocache_hash' => '10079723344becc306eb4f66-13696471',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_default')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/modifier.default.php';
if (!is_callable('smarty_function_html_options')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/function.html_options.php';
?><?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script language="javascript" type="text/javascript">
$(function() { $('#quantity').change(function() { $("#frmProduct").submit(); }); $('#weight').change(function() { $("#frmProduct").submit(); }); });
</script>
<div id="bd">
    <div class="yui-g">
        <h2><?php echo $_smarty_tpl->getVariable('description')->value;?>
</h2>
        <div class="yui-u first">
            <form id="frmProduct" action="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('ndb_no')->value;?>
" method="post">
                Serving Size:
                <input type="text" id="quantity" name="quantity" value="<?php echo round(smarty_modifier_default($_REQUEST['quantity'],'1'),'1');?>
" size="4" width="5" />
                <select id="weight" name="weight">
                    <?php if ($_smarty_tpl->getVariable('is_custom_food')->value==true){?>
                    <option value="100.0">Serving</option>
                    <?php }else{ ?>
                    <option value="100.0">100 grams</option>
                    <?php }?>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('options')->value,'selected'=>$_smarty_tpl->getVariable('selected')->value),$_smarty_tpl->smarty,$_smarty_tpl);?>
                </select>            
            </form>
        </div>
        <div class="yui-u right"><?php if ($_SESSION['last_search']!=''){?><a href="<?php echo $_SESSION['last_search'];?>
">Return to Results</a><?php }?><?php if ($_SESSION['user_info']['user_id']!=''){?>&nbsp;|&nbsp;<a href="tracker.php?action=add&ndb_no=<?php echo $_smarty_tpl->getVariable('ndb_no')->value;?>
&quantity=<?php echo smarty_modifier_default($_REQUEST['quantity'],1);?>
&weight=<?php echo $_smarty_tpl->getVariable('weight')->value;?>
&fat=<?php echo round($_smarty_tpl->getVariable('data')->value['FAT']['nutr_val'],1);?>
&calories=<?php echo round($_smarty_tpl->getVariable('data')->value['ENERC_KCAL']['nutr_val']);?>
&fiber=<?php echo round($_smarty_tpl->getVariable('data')->value['FIBTG']['nutr_val']);?>
&points=<?php echo $_smarty_tpl->getVariable('points')->value;?>
">Add to Tracker</a><?php }?></div>
    </div>
    <div class="nf-container">
    <div class="yui-g">
    	<h2>Nutrition Facts</h2>
    </div>
    <hr class="thick" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Amount Per Serving</span></div>
        <div class="yui-u right">WeightWatchers&trade; Points <span class="bold"><?php echo $_smarty_tpl->getVariable('points')->value;?>
</span></div>
    </div>
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Calories</span> <?php echo round($_smarty_tpl->getVariable('data')->value['ENERC_KCAL']['nutr_val']);?>
</div>
        <div class="yui-u right">Calories from Fat <?php echo round($_smarty_tpl->getVariable('fat_cals')->value);?>
</div>
    </div>
    <hr class="medium" />
    <div class="yui-g right"> <span class="bold">% Daily Value*</span> </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Total Fat</span> <?php echo round($_smarty_tpl->getVariable('data')->value['FAT']['nutr_val'],1);?>
<?php echo $_smarty_tpl->getVariable('data')->value['FAT']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['FAT'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="padding-left: 1em">Saturated Fat</span> <?php echo round($_smarty_tpl->getVariable('data')->value['FASAT']['nutr_val'],1);?>
<?php echo $_smarty_tpl->getVariable('data')->value['FASAT']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['FASAT'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g"> <span style="padding-left: 1em"><em>Trans</em> Fat</span> <?php if ($_smarty_tpl->getVariable('data')->value['FATRN']['nutr_val']<0.5){?>0<?php }else{ ?><?php echo round($_smarty_tpl->getVariable('data')->value['FATRN']['nutr_val'],1);?>
<?php }?><?php echo $_smarty_tpl->getVariable('data')->value['FATRN']['units'];?>
</div>
        <!--<div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['FATRN'];?>
</div>-->
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Cholesterol</span> <?php echo round($_smarty_tpl->getVariable('data')->value['CHOLE']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['CHOLE']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['CHOLE'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first">
        	<span style="font-weight: bold">Sodium</span> <?php echo round($_smarty_tpl->getVariable('data')->value['NA']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['NA']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['NA'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first">
        	<span style="font-weight: bold">Potassium</span> <?php echo round($_smarty_tpl->getVariable('data')->value['K']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['K']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['K'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="font-weight: bold">Total Carbohydrate</span> <?php echo round($_smarty_tpl->getVariable('data')->value['CHOCDF']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['CHOCDF']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['CHOCDF'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="padding-left: 1em">Dietary Fiber</span> <?php echo round($_smarty_tpl->getVariable('data')->value['FIBTG']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['FIBTG']['units'];?>
</div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['FIBTG'];?>
</div>
    </div>
    <hr class="thin" />
    <div class="yui-g"> <span style="padding-left: 1em">Sugars</span> <?php echo round($_smarty_tpl->getVariable('data')->value['SUGAR']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['SUGAR']['units'];?>
 </div>
    <hr class="thin" />
    <div class="yui-g">
    	<div class="yui-u first">
        	<span class="bold">Protein</span> <?php echo round($_smarty_tpl->getVariable('data')->value['PROCNT']['nutr_val']);?>
<?php echo $_smarty_tpl->getVariable('data')->value['PROCNT']['units'];?>

        </div>
        <div class="yui-u bold right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['PROCNT'];?>
</div>
    </div>
    <hr class="thick" />
    <div class="yui-g">
        <div class="yui-g first">
            <div class="yui-u first">Vitamin A</div>
            <div class="yui-u right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['VITA_IU'];?>
</div>
        </div>
        <div class="yui-g">
            <div class="yui-u first">Vitamin C</div>
            <div class="yui-u right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['VITC'];?>
</div>
        </div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-g first">
            <div class="yui-u first">Calcium</div>
            <div class="yui-u right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['CA'];?>
</div>
        </div>
        <div class="yui-g">
            <div class="yui-u first">Iron</div>
            <div class="yui-u right"><?php echo $_smarty_tpl->getVariable('dvpct')->value['FE'];?>
</div>
        </div>
    </div>
    <hr class="thin" />
    <div>*Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</div>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
