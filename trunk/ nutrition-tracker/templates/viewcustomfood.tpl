{include file="header.tpl"}
<div id="bd">
    <div class="yui-g">
        <h2>View Custom Food</h2>
    </div>
    <hr class="thin" style="background-color: #ccc !important;" />
    <div class="yui-g">
    	{foreach item=i key=k from=$data name=results}
        {if $smarty.foreach.results.first}
        <table class="search-results">
        <tr>
            <td style="background-color: #CCC" colspan="2">
            {if $paginate.size gt 1}Items {$paginate.first}-{$paginate.last} of 
            {$paginate.total} displayed.
            {else}Item {$paginate.first} of {$paginate.total} displayed.{/if}
            </td>
        </tr>
        <tr>
            <td colspan="2">{paginate_first} {paginate_middle format="page" prefix=" [ " suffix=" ] "} {paginate_last}</td>
        </tr>
		{/if}
        {if $smarty.foreach.results.iteration%2 eq 0}
            <tr>
        {else}
            <tr style="background-color: white">
        {/if}
        	<td>{$k} : <a href="customfood.php?action=edit&ndb_no={$k}">{$i}</a></td>
            <td style="text-align:center"><a href="customfood.php?action=edit&ndb_no={$k}">Edit</a> | <a href="customfood.php?action=remove&ndb_no={$k}">Delete</a></td>
        </tr>
        {if $smarty.foreach.results.last}
        </table>
        {/if}
        {/foreach}
    </div>
</div>
{include file="footer.tpl"}