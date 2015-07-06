
<div style="min-height:700px;">
    {foreach from=$data_product item=cur name=loop}
        <div class="container-product"{if $smarty.foreach.loop.iteration%3==0} style="margin-right:0;"{/if}>
            <div class="container-product__image"><a href="/product/{$cur.id}/"><img src="/uploaded/product/{$cur.id}_sm.{$cur.ext}" /></a></div>
            <div class="container-product__name"><a href="/product/{$cur.id}/">{$cur.name|truncate:35:"..."}</a></div>
            <div class="container-product-price">
                {if !$cur.old_price}
                    <div class="container-product__price">{$cur.price|cost} руб.</div>
                    <div class="clear"></div>
                {else}
                    <div class="container-product__old_price">{$cur.old_price|cost} руб.</div>
                    <div class="container-product__price">{$cur.price|cost} руб.</div>
                    <div class="clear"></div>
                {/if}
            </div>
            <div class="button-in-cart product" id="product_{$cur.id}"><i class="fa fa-shopping-cart"></i> Добавить в корзину</div>
        </div>
        {if $smarty.foreach.loop.iteration%3==0}<div class="clear"></div>{/if}
    {/foreach}
</div>
<div class="clear"></div>
{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}