{include file="header.tpl"}
<div id="bd">
    <div class="yui-g">
        <h2>Welcome</h2>
    </div>
    <div class="yui-g">
    {foreach item=i key=k from=$cals name=calories}
    	{$i.ndb_no} {$i.long_desc}<br />
    {/foreach}
    </div>
</div>
{include file="footer.tpl"}
