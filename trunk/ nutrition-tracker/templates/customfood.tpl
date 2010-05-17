{include file="header.tpl"}
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
{if $error neq ""}
<div class="ui-state-error ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>{$error}</div>
{elseif $highlight neq ""}
<div class="ui-state-highlight ui-corner-all" style="padding: .3em .5em; margin-top: .5em;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>{$highlight}</div>
{else}
<hr class="thin" style="background-color: #ccc !important;" />
{/if}
    <div class="yui-g">
        <form action="{$SCRIPT_NAME}?action=submit" method="post" name="foodForm" id="foodForm" class="form-container">
        	<input type="hidden" name="ndb_no" id="ndb_no" value="{$smarty.post.ndb_no}" />
            <table class="custom-tbl form-section">
                <tr class="top">
                    <td colspan="4"><label class="bold" for="name">Name *</label>
                        <br />
                        <input name="name" type="text" class="required" id="name" style="width: 50%" value="{$smarty.post.name|stripslashes}" minlength="5" /></td>
                </tr>
                <tr>
                    <td><label class="bold" for="calories">Calories *</label></td>
                    <td><input name="calories" type="text" class="required" id="calories" value="{$smarty.post.calories|round}" size="5"></td>
                    <td>Calcium</td>
                    <td><input name="calcium" type="text" id="calcium" value="{$smarty.post.calcium|round}" size="5">
                        %</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Fat *</td>
                    <td><input name="fat" type="text" class="required" id="fat" value="{$smarty.post.fat|round}" size="5">
                        g</td>
                    <td>Iron</td>
                    <td><input name="iron" type="text" value="{$smarty.post.iron|round}" size="5" />
                        %</td>
                </tr>
                <tr>
                    <td style="padding-left: 1em;">Saturated Fat</td>
                    <td><input name="satfat" type="text" id="satfat" value="{$smarty.post.satfat|round}" size="5">
                        g</td>
                    <td>Vitamin A</td>
                    <td><input name="vita" type="text" value="{$smarty.post.vita|round}" size="5" />
                        %</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Trans Fat</td>
                    <td><input name="transfat" type="text" id="transfat" value="{$smarty.post.transfat|round}" size="5" /> 
                        g</td>
                    <td>Vitamin C</td>
                    <td><input name="vitc" type="text" value="{$smarty.post.vitc|round}" size="5" />
                        %</td>
                </tr>
                <tr>
                    <td class="bold">Cholesterol</td>
                    <td><input name="cholesterol" type="text" id="cholesterol" value="{$smarty.post.cholesterol|round}" size="5">
                        mg</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Sodium</td>
                    <td><input name="sodium" type="text" id="sodium" value="{$smarty.post.sodium|round}" size="5">
                        mg</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="bold">Carbohydrate</td>
                    <td class="alt"><input name="carbohydrate" type="text" id="carbohydrate" value="{$smarty.post.carbohydrate|round}" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td style="padding-left: 1em;">Dietary Fiber *</td>
                    <td><input name="fiber" type="text" class="required" id="fiber" value="{$smarty.post.fiber|round}" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="alt" style="padding-left: 1em;">Sugars</td>
                    <td class="alt"><input name="sugars" type="text" id="sugars" value="{$smarty.post.sugars|round}" size="5" />
                        g</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="alt">
                    <td class="bold">Protein</td>
                    <td><input name="protein" type="text" id="protein" value="{$smarty.post.protein|round}" size="5" />
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
{include file="footer.tpl"} 