<?php /* Smarty version Smarty3-b7, created on 2010-05-13 23:26:45
         compiled from "./templates/tracker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17155128264becc2f55997f0-65562833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27bc884da63f9af90f401d69c2b7dd7196226eb0' => 
    array (
      0 => './templates/tracker.tpl',
      1 => 1272640088,
    ),
  ),
  'nocache_hash' => '17155128264becc2f55997f0-65562833',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_default')) include '/Applications/MAMP/htdocs/smarty/libs/plugins/modifier.default.php';
?><?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript">
$(function() {
	$("#move_b, #move_l, #move_d, #move_s").selectmenu({ style:'dropdown', menuWidth:120 });
	$("#button1, #button2, #button3, #button4, #savenote").button();
	$("#button1, #button2, #button3, #button4, #savenote").hover(function() { $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
	$("#chkallbfast, #chkalllunch, #chkalldinner, #chkallsnack").click(function() { var cs = this.checked; $("input[name=item_" + this.value + "[]]").each(function() { this.checked = cs; }); });
	$("#datepicker").datepicker({ showOn: 'both', buttonImage: 'images/calendar.gif', buttonImageOnly: true, onClose: function(dateText, inst) { location.href='tracker.php?action=view&date=' + dateText; } });
	$("#datepicker").datepicker('option', 'defaultDate', '<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('date')->value,"%m/%d/%Y");?>
');
	$("#savenote").click(function() { $.get("config/ajaxcalls.php", { method: "saveNote", tracker_note: $("#note").val(), user_id: "<?php echo $_SESSION['user_info']['user_id'];?>
", tracker_date: "<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('date')->value,'%Y-%m-%d');?>
" }, function(data) { }); });
	$("#move_b, #move_l, #move_d, #move_s").change(function() { var attr = $(this).val().split("|"); $("#action").val("move"); $("#meal").val(attr[0]); $("#dest").val(attr[1]); if (attr[0] !== "" && attr[1] !== "") this.form.submit();	});
	$("#button1").click(function() { $("#action").val("delete"); $("#meal").val("b"); this.form.submit(); });
	$("#button2").click(function() { $("#action").val("delete"); $("#meal").val("l"); this.form.submit(); });
	$("#button3").click(function() { $("#action").val("delete"); $("#meal").val("d"); this.form.submit(); });
	$("#button4").click(function() { $("#action").val("delete"); $("#meal").val("s"); this.form.submit(); });
});
</script>
<div id="bd">
<form name="frmMain" id="frmMain" method="post" action="tracker.php">
<input type="hidden" id="action" name="action" value="" />
<input type="hidden" id="meal" name="meal" value="" />
<input type="hidden" id="dest" name="dest" value="" />
<input type="hidden" id="date" name="date" value="<?php echo $_smarty_tpl->getVariable('date')->value;?>
" />
<div class="yui-g">
    <h2>My Tracker for <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('date')->value,'%m/%d/%Y');?>

        <input type="hidden" id="datepicker" />
    </h2>
</div>
<hr class="thin" style="background-color: #ccc !important;" />
<!-- Breakfast -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Breakfast</h3>
    </div>
    <div class="yui-u right addfood"> <a href="search.php?meal=b">Add Food</a> </div>
</div>
<div class="yui-g"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('breakfast_rs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total=count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['total'] = $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['first']){?>
    <table class="tracker">
        <tr>
            <th style="width: 5%; text-align: center"><input type="checkbox" id="chkallbfast" name="chkallbfast" value="b" /></th>
            <th>Description</th>
            <th style="width: 5%">Qty</th>
            <th style="width: 5%">Calories</th>
            <th style="width: 5%">Fat</th>
            <th style="width: 5%">Fiber</th>
            <th style="width: 5%">Points</th>
        </tr>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['iteration']%2==0){?><tr><?php }else{ ?><tr style="background-color: white"><?php }?>
            <td style="text-align: center"><input type="checkbox" id="item_b[]" name="item_b[]" value="<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
" /></td>
            <td><a href="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
&quantity=<?php echo $_smarty_tpl->getVariable('i')->value['quantity'];?>
&weight=<?php echo $_smarty_tpl->getVariable('i')->value['weight']/$_smarty_tpl->getVariable('i')->value['quantity'];?>
&meal=b"><?php echo $_smarty_tpl->getVariable('i')->value['long_desc'];?>
</a></td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['quantity'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['calories']);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fat'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fiber'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['points'],1);?>
</td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['last']){?>
    </table>
    <div>
        <div style="float:left; line-height: 24px;">With selected:</div>
        <button type="button" id="button1" style="float:left" class="nt-button">Delete</button>
        <div style="float:left; line-height: 24px;">| Move to:</div>
        <select id="move_b">
            <option value="">Choose...</option>
            <option value="b|l">Lunch</option>
            <option value="b|d">Dinner</option>
            <option value="b|s">Snack</option>
        </select>
    </div>
    <?php }?>
    <?php }} ?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['total']==0){?>
    <hr class="thin" style="background-color: #CCC !important;" />
    <?php }?>
</div>
<!-- Lunch -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Lunch</h3>
    </div>
    <div class="yui-u right addfood"><a href="search.php?meal=l">Add Food</a></div>
</div>
<div class="yui-g"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lunch_rs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total=count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['total'] = $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['first']){?>
    <table class="tracker">
        <tr>
            <th style="width: 5%; text-align: center"><input type="checkbox" id="chkalllunch" value="l" /></th>
            <th>Description</th>
            <th style="width: 5%">Qty</th>
            <th style="width: 5%">Calories</th>
            <th style="width: 5%">Fat</th>
            <th style="width: 5%">Fiber</th>
            <th style="width: 5%">Points</th>
        </tr>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['iteration']%2==0){?><tr><?php }else{ ?><tr style="background-color: white"><?php }?>
            <td style="text-align: center"><input type="checkbox" id="item_l[]" name="item_l[]" value="<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
" /></td>
            <td><a href="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
&quantity=<?php echo $_smarty_tpl->getVariable('i')->value['quantity'];?>
&weight=<?php echo $_smarty_tpl->getVariable('i')->value['weight']/$_smarty_tpl->getVariable('i')->value['quantity'];?>
&meal=l"><?php echo $_smarty_tpl->getVariable('i')->value['long_desc'];?>
</a></td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['quantity'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['calories']);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fat'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fiber'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['points'],1);?>
</td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['last']){?>
    </table>
    <div>
        <div style="float:left; line-height: 24px;">With selected:</div>
        <button type="button" id="button2" style="float:left" class="nt-button">Delete</button>
        <div style="float:left; line-height: 24px;">| Move to:</div>
        <select id="move_l">
            <option value="">Choose...</option>
            <option value="l|b">Breakfast</option>
            <option value="l|d">Dinner</option>
            <option value="l|s">Snack</option>
        </select>
    </div>
    <?php }?>
    <?php }} ?> 
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['total']==0){?>
    <hr class="thin" style="background-color: #CCC !important;" />
    <?php }?>
</div>
<!-- Dinner -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Dinner</h3>
    </div>
    <div class="yui-u right addfood"> <a href="search.php?meal=d">Add Food</a> </div>
</div>
<div class="yui-g"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('dinner_rs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total=count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['total'] = $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['first']){?>
    <table class="tracker">
        <tr>
            <th style="width: 5%; text-align: center"><input type="checkbox" id="chkalldinner" value="d" /></th>
            <th>Description</th>
            <th style="width: 5%">Qty</th>
            <th style="width: 5%">Calories</th>
            <th style="width: 5%">Fat</th>
            <th style="width: 5%">Fiber</th>
            <th style="width: 5%">Points</th>
        </tr>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['iteration']%2==0){?><tr><?php }else{ ?><tr style="background-color: white"><?php }?>
            <td style="text-align: center"><input type="checkbox" id="item_d[]" name="item_d[]" value="<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
" /></td>
            <td><a href="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
&quantity=<?php echo $_smarty_tpl->getVariable('i')->value['quantity'];?>
&weight=<?php echo $_smarty_tpl->getVariable('i')->value['weight']/$_smarty_tpl->getVariable('i')->value['quantity'];?>
&meal=d"><?php echo $_smarty_tpl->getVariable('i')->value['long_desc'];?>
</a></td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['quantity'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['calories']);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fat'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fiber'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['points'],1);?>
</td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['last']){?>
    </table>
    <div>
        <div style="float:left; line-height: 24px;">With selected:</div>
        <button type="button" id="button3" style="float:left" class="nt-button">Delete</button>
        <div style="float:left; line-height: 24px;">| Move to:</div>
        <select id="move_d">
            <option value="">Choose...</option>
            <option value="d|b">Breakfast</option>
            <option value="d|l">Lunch</option>
            <option value="d|s">Snack</option>
        </select>
    </div>            
    <?php }?>
    <?php }} ?> 
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['total']==0){?>
    <hr class="thin" style="background-color: #CCC !important;" />
    <?php }?>
</div>
<!-- Snack -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Snack</h3>
    </div>
    <div class="yui-u right addfood"> <a href="search.php?meal=s">Add Food</a> </div>
</div>
<div class="yui-g"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('snack_rs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total=count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['total'] = $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tracker']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['first']){?>
    <table class="tracker">
        <tr>
            <th style="width: 5%; text-align: center"><input type="checkbox" id="chkallsnack" value="s" /></th>
            <th>Description</th>
            <th style="width: 5%">Qty</th>
            <th style="width: 5%">Calories</th>
            <th style="width: 5%">Fat</th>
            <th style="width: 5%">Fiber</th>
            <th style="width: 5%">Points</th>
        </tr>               
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['iteration']%2==0){?><tr><?php }else{ ?><tr style="background-color: white"><?php }?>
            <td style="text-align: center"><input type="checkbox" id="item_s[]" name="item_s[]" value="<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
" /></td>
            <td><a href="product.php?ndb_no=<?php echo $_smarty_tpl->getVariable('i')->value['ndb_no'];?>
&quantity=<?php echo $_smarty_tpl->getVariable('i')->value['quantity'];?>
&weight=<?php echo $_smarty_tpl->getVariable('i')->value['weight']/$_smarty_tpl->getVariable('i')->value['quantity'];?>
&meal=s"><?php echo $_smarty_tpl->getVariable('i')->value['long_desc'];?>
</a></td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['quantity'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['calories']);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fat'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['fiber'],1);?>
</td>
            <td><?php echo round($_smarty_tpl->getVariable('i')->value['points'],1);?>
</td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['last']){?>
    </table>
    <div>
        <div style="float:left; line-height: 24px;">With selected:</div>
        <button type="button" id="button4" style="float:left" class="nt-button">Delete</button>
        <div style="float:left; line-height: 24px;">| Move to:</div>
        <select id="move_s">
            <option value="">Choose...</option>
            <option value="s|b">Breakfast</option>
            <option value="s|l">Lunch</option>
            <option value="s|d">Dinner</option>
        </select>
    </div>
    <?php }?>
    <?php }} ?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tracker']['total']==0){?>
    <hr class="thin" style="background-color: #CCC !important;" />
    <?php }?>
</div>
<div class="yui-g">
    <div class="yui-u first">
        <h3>Notes</h3>
        <div><textarea id="note" name="note" class="note"><?php echo $_smarty_tpl->getVariable('note')->value;?>
</textarea></div>
        <div><button type="button" id="savenote" class="nt-button">Save Note</button></div>
    </div>
    <div class="yui-u">
        <h3>Totals</h3>
        <!-- Totals -->
        <table class="tracker-totals">
            <tr>
                <td class="first"><small>Calories</small><br />
                    <h2><?php echo round(smarty_modifier_default($_smarty_tpl->getVariable('totals')->value['calories'],0));?>
</h2></td>
                <td><small>Fat</small><br />
                    <h2><?php echo round(smarty_modifier_default($_smarty_tpl->getVariable('totals')->value['fat'],0),1);?>
</h2></td>
                <td><small>Fiber</small><br />
                    <h2><?php echo round(smarty_modifier_default($_smarty_tpl->getVariable('totals')->value['fiber'],0));?>
</h2></td>
                <td><small>Points</small><br />
                    <h2><?php echo round(smarty_modifier_default($_smarty_tpl->getVariable('totals')->value['points'],0),1);?>
</h2></td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
