{include file="header.tpl"}
<script language="javascript" type="text/javascript">
$(function() { $('#quantity').change(function() { $("#frmProduct").submit(); }); $('#weight').change(function() { $("#frmProduct").submit(); }); });
</script>
<div id="bd">
    <div class="yui-g">
        <h2>{$description}</h2>
        <div class="yui-u first">
            <form id="frmProduct" action="product.php?ndb_no={$ndb_no}" method="post">
                Serving Size:
                <input type="text" id="quantity" name="quantity" value="{$smarty.request.quantity|default:'1'|round:'1'}" size="4" width="5" />
                <select id="weight" name="weight">
                    {if $is_custom_food eq true}
                    <option value="100.0">Serving</option>
                    {else}
                    <option value="100.0">100 grams</option>
                    {/if}
                    {html_options options=$options selected=$selected}
                </select>            
            </form>
        </div>
        <div class="yui-u right">{if $smarty.session.last_search neq ''}<a href="{$smarty.session.last_search}">Return to Results</a>{/if}{if $smarty.session.user_info.user_id neq ""}&nbsp;|&nbsp;<a href="tracker.php?action=add&ndb_no={$ndb_no}&quantity={$smarty.request.quantity|default:1}&weight={$weight}&fat={$data.FAT.nutr_val|round:1}&calories={$data.ENERC_KCAL.nutr_val|round}&fiber={$data.FIBTG.nutr_val|round}&points={$points}">Add to Tracker</a>{/if}</div>
    </div>
    <div class="nf-container">
    <div class="yui-g">
    	<h2>Nutrition Facts</h2>
    </div>
    <hr class="thick" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Amount Per Serving</span></div>
        <div class="yui-u right">WeightWatchers&trade; Points <span class="bold">{$points}</span></div>
    </div>
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Calories</span> {$data.ENERC_KCAL.nutr_val|round}</div>
        <div class="yui-u right">Calories from Fat {$fat_cals|round}</div>
    </div>
    <hr class="medium" />
    <div class="yui-g right"> <span class="bold">% Daily Value*</span> </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Total Fat</span> {$data.FAT.nutr_val|round:1}{$data.FAT.units}</div>
        <div class="yui-u bold right">{$dvpct.FAT}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="padding-left: 1em">Saturated Fat</span> {$data.FASAT.nutr_val|round:1}{$data.FASAT.units}</div>
        <div class="yui-u bold right">{$dvpct.FASAT}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g"> <span style="padding-left: 1em"><em>Trans</em> Fat</span> {if $data.FATRN.nutr_val lt 0.5}0{else}{$data.FATRN.nutr_val|round:1}{/if}{$data.FATRN.units}</div>
        <!--<div class="yui-u bold right">{$dvpct.FATRN}</div>-->
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span class="bold">Cholesterol</span> {$data.CHOLE.nutr_val|round}{$data.CHOLE.units}</div>
        <div class="yui-u bold right">{$dvpct.CHOLE}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first">
        	<span style="font-weight: bold">Sodium</span> {$data.NA.nutr_val|round}{$data.NA.units}</div>
        <div class="yui-u bold right">{$dvpct.NA}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first">
        	<span style="font-weight: bold">Potassium</span> {$data.K.nutr_val|round}{$data.K.units}</div>
        <div class="yui-u bold right">{$dvpct.K}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="font-weight: bold">Total Carbohydrate</span> {$data.CHOCDF.nutr_val|round}{$data.CHOCDF.units}</div>
        <div class="yui-u bold right">{$dvpct.CHOCDF}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-u first"><span style="padding-left: 1em">Dietary Fiber</span> {$data.FIBTG.nutr_val|round}{$data.FIBTG.units}</div>
        <div class="yui-u bold right">{$dvpct.FIBTG}</div>
    </div>
    <hr class="thin" />
    <div class="yui-g"> <span style="padding-left: 1em">Sugars</span> {$data.SUGAR.nutr_val|round}{$data.SUGAR.units} </div>
    <hr class="thin" />
    <div class="yui-g">
    	<div class="yui-u first">
        	<span class="bold">Protein</span> {$data.PROCNT.nutr_val|round}{$data.PROCNT.units}
        </div>
        <div class="yui-u bold right">{$dvpct.PROCNT}</div>
    </div>
    <hr class="thick" />
    <div class="yui-g">
        <div class="yui-g first">
            <div class="yui-u first">Vitamin A</div>
            <div class="yui-u right">{$dvpct.VITA_IU}</div>
        </div>
        <div class="yui-g">
            <div class="yui-u first">Vitamin C</div>
            <div class="yui-u right">{$dvpct.VITC}</div>
        </div>
    </div>
    <hr class="thin" />
    <div class="yui-g">
        <div class="yui-g first">
            <div class="yui-u first">Calcium</div>
            <div class="yui-u right">{$dvpct.CA}</div>
        </div>
        <div class="yui-g">
            <div class="yui-u first">Iron</div>
            <div class="yui-u right">{$dvpct.FE}</div>
        </div>
    </div>
    <hr class="thin" />
    <div>*Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</div>
    </div>
</div>
{include file="footer.tpl"}