{include file="header.tpl"}
<script type="text/javascript">
$(function() {
	$("#move_b, #move_l, #move_d, #move_s").selectmenu({ style:'dropdown', menuWidth:120 });
	$("#button1, #button2, #button3, #button4, #savenote").button();
	$("#button1, #button2, #button3, #button4, #savenote").hover(function() { $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
	$("#chkallbfast, #chkalllunch, #chkalldinner, #chkallsnack").click(function() { var cs = this.checked; $("input[name=item_" + this.value + "[]]").each(function() { this.checked = cs; }); });
	$("#datepicker").datepicker({ showOn: 'both', buttonImage: 'images/calendar.gif', buttonImageOnly: true, onClose: function(dateText, inst) { location.href='tracker.php?action=view&date=' + dateText; } });
	$("#datepicker").datepicker('option', 'defaultDate', '{$date|date_format:"%m/%d/%Y"}');
	$("#savenote").click(function() { $.get("config/ajaxcalls.php", { method: "saveNote", tracker_note: $("#note").val(), user_id: "{$smarty.session.user_info.user_id}", tracker_date: "{$date|date_format:'%Y-%m-%d'}" }, function(data) { }); });
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
<input type="hidden" id="date" name="date" value="{$date}" />
<div class="yui-g">
    <h2>My Tracker for {$date|date_format:'%m/%d/%Y'}
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
<div class="yui-g"> {foreach from=$breakfast_rs key=k item=i name=tracker}
    {if $smarty.foreach.tracker.first}
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
        {/if}
        {if $smarty.foreach.tracker.iteration%2 eq 0}<tr>{else}<tr style="background-color: white">{/if}
            <td style="text-align: center"><input type="checkbox" id="item_b[]" name="item_b[]" value="{$i.ndb_no}" /></td>
            <td><a href="product.php?ndb_no={$i.ndb_no}&quantity={$i.quantity}&weight={$i.weight/$i.quantity}&meal=b">{$i.long_desc}</a></td>
            <td>{$i.quantity|round:1}</td>
            <td>{$i.calories|round}</td>
            <td>{$i.fat|round:1}</td>
            <td>{$i.fiber|round:1}</td>
            <td>{$i.points|round:1}</td>
        </tr>
        {if $smarty.foreach.tracker.last}
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
    {/if}
    {/foreach}
    {if $smarty.foreach.tracker.total eq 0}
    <hr class="thin" style="background-color: #CCC !important;" />
    {/if}
</div>
<!-- Lunch -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Lunch</h3>
    </div>
    <div class="yui-u right addfood"><a href="search.php?meal=l">Add Food</a></div>
</div>
<div class="yui-g"> {foreach from=$lunch_rs key=k item=i name=tracker}
    {if $smarty.foreach.tracker.first}
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
        {/if}
        {if $smarty.foreach.tracker.iteration%2 eq 0}<tr>{else}<tr style="background-color: white">{/if}
            <td style="text-align: center"><input type="checkbox" id="item_l[]" name="item_l[]" value="{$i.ndb_no}" /></td>
            <td><a href="product.php?ndb_no={$i.ndb_no}&quantity={$i.quantity}&weight={$i.weight/$i.quantity}&meal=l">{$i.long_desc}</a></td>
            <td>{$i.quantity|round:1}</td>
            <td>{$i.calories|round}</td>
            <td>{$i.fat|round:1}</td>
            <td>{$i.fiber|round:1}</td>
            <td>{$i.points|round:1}</td>
        </tr>
        {if $smarty.foreach.tracker.last}
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
    {/if}
    {/foreach} 
    {if $smarty.foreach.tracker.total eq 0}
    <hr class="thin" style="background-color: #CCC !important;" />
    {/if}
</div>
<!-- Dinner -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Dinner</h3>
    </div>
    <div class="yui-u right addfood"> <a href="search.php?meal=d">Add Food</a> </div>
</div>
<div class="yui-g"> {foreach from=$dinner_rs key=k item=i name=tracker}
    {if $smarty.foreach.tracker.first}
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
        {/if}
        {if $smarty.foreach.tracker.iteration%2 eq 0}<tr>{else}<tr style="background-color: white">{/if}
            <td style="text-align: center"><input type="checkbox" id="item_d[]" name="item_d[]" value="{$i.ndb_no}" /></td>
            <td><a href="product.php?ndb_no={$i.ndb_no}&quantity={$i.quantity}&weight={$i.weight/$i.quantity}&meal=d">{$i.long_desc}</a></td>
            <td>{$i.quantity|round:1}</td>
            <td>{$i.calories|round}</td>
            <td>{$i.fat|round:1}</td>
            <td>{$i.fiber|round:1}</td>
            <td>{$i.points|round:1}</td>
        </tr>
        {if $smarty.foreach.tracker.last}
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
    {/if}
    {/foreach} 
    {if $smarty.foreach.tracker.total eq 0}
    <hr class="thin" style="background-color: #CCC !important;" />
    {/if}
</div>
<!-- Snack -->
<div class="yui-g">
    <div class="yui-u first">
        <h3>Snack</h3>
    </div>
    <div class="yui-u right addfood"> <a href="search.php?meal=s">Add Food</a> </div>
</div>
<div class="yui-g"> {foreach from=$snack_rs key=k item=i name=tracker}
    {if $smarty.foreach.tracker.first}
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
        {/if}
        {if $smarty.foreach.tracker.iteration%2 eq 0}<tr>{else}<tr style="background-color: white">{/if}
            <td style="text-align: center"><input type="checkbox" id="item_s[]" name="item_s[]" value="{$i.ndb_no}" /></td>
            <td><a href="product.php?ndb_no={$i.ndb_no}&quantity={$i.quantity}&weight={$i.weight/$i.quantity}&meal=s">{$i.long_desc}</a></td>
            <td>{$i.quantity|round:1}</td>
            <td>{$i.calories|round}</td>
            <td>{$i.fat|round:1}</td>
            <td>{$i.fiber|round:1}</td>
            <td>{$i.points|round:1}</td>
        </tr>
        {if $smarty.foreach.tracker.last}
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
    {/if}
    {/foreach}
    {if $smarty.foreach.tracker.total eq 0}
    <hr class="thin" style="background-color: #CCC !important;" />
    {/if}
</div>
<div class="yui-g">
    <div class="yui-u first">
        <h3>Notes</h3>
        <div><textarea id="note" name="note" class="note">{$note}</textarea></div>
        <div><button type="button" id="savenote" class="nt-button">Save Note</button></div>
    </div>
    <div class="yui-u">
        <h3>Totals</h3>
        <!-- Totals -->
        <table class="tracker-totals">
            <tr>
                <td class="first"><small>Calories</small><br />
                    <h2>{$totals.calories|default:0|round}</h2></td>
                <td><small>Fat</small><br />
                    <h2>{$totals.fat|default:0|round:1}</h2></td>
                <td><small>Fiber</small><br />
                    <h2>{$totals.fiber|default:0|round}</h2></td>
                <td><small>Points</small><br />
                    <h2>{$totals.points|default:0|round:1}</h2></td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>
{include file="footer.tpl"}