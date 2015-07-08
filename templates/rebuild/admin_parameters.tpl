<label class="col-sm-2 control-label">Параметры* :</label>
<div class="col-sm-10">
    {foreach from=$data_filtr item=cur}
        <div class="checkbox">
           <input id="male{$cur.id}" {if $cur.select} checked="checked"{/if} type="checkbox" value="{$cur.id}" name="id_param[{$cur.id}]"><label class="label_checkbox"  for="male{$cur.id}">{$cur.name}</label>
        </div>
    {/foreach}
</div>