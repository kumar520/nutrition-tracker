{include file="header.tpl"}
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
        <form class="search" action="{$SCRIPT_NAME}?action=submit" method="post">
			<table class="input-form">
                <tr>
                    <td><input name="term" type="text" class="required" id="term" value="{$smarty.request.term|stripslashes}" size="25" />
                    <button type="submit" id="button" class="nt-button ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"><span class="ui-button-text">Search</span></button></td>
                </tr>
            </table>
        </form>
    </div> 
    <div class="yui-g"> 
        {$error}
        {foreach item=i key=k from=$data name=results}
            {if $smarty.foreach.results.first}
			<table class="search-results">
            	<tr>
                	<td style="background-color: #CCC">
                    	{if $paginate.size gt 1}Items {$paginate.first}-{$paginate.last} of 
                        {$paginate.total} displayed.{else}Item {$paginate.first} of {$paginate.total} displayed.{/if}
		            </td>
				</tr>
            	<tr>
            		<td>
            			{paginate_first} {paginate_middle format="page" prefix=" [ " suffix=" ] "} {paginate_last}
            		</td>
				</tr>
            {/if}
            {if $smarty.foreach.results.iteration%2 eq 0}
            	<tr>
            {else}
            	<tr style="background-color: white">
            {/if}
            		<td>
                    	<a href="product.php?ndb_no={$i.ndb_no}">{$i.long_desc}</a>
                    </td>
				</tr>
            {if $smarty.foreach.results.last}
            </table>
            {/if}
        {/foreach}	
    </div> 
</div> 
{include file="footer.tpl"}