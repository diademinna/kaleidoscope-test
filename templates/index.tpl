{capture name="content"}
<ul class="index-category">
{foreach from=$data_category item=cur}
    <li class="index-category__item">
        <a class="index-category__link" href="/category/{$cur.id}/">
            <div class="index-category__image">
                <img src="/uploaded/category/{$cur.id}_prev.{$cur.ext}" />
            </div>
            <div class="index-category__name">{$cur.name}</div>
        </a>
    </li>
{/foreach}
</ul>
<div class="container-width_670px">
<div class="bgr-dark_red title-block">популярные товары</div>
{foreach from=$data_product_popular item=cur name=loop}
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
<div class="container-width_300px">
<div class="bgr-green title-block">часто покупаемые товары</div>
<div class="container-bestsellers">
	<div class="block-bestsellers">
		<div class="block-bestsellers-image">
			<a href="#"><img src="/img/bestsellers/1.png" /></a>
		</div>
		<div class="block-bestsellers-description">
			<div class="block-bestsellers__name"><a href="#">ВЕСЕЛЫЙ МИШКА</a></div>
			<div class="block-bestsellers-price">
				<div class="block-bestsellers__old_price">80  руб.</div>
				<div class="block-bestsellers_price">50  руб.</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="block-bestsellers">
		<div class="block-bestsellers-image">
			<a href="#"><img src="/img/bestsellers/2.png" /></a>
		</div>
		<div class="block-bestsellers-description">
			<div class="block-bestsellers__name"><a href="#">ВЕСЕЛЫЙ МИШКА</a></div>
			<div class="block-bestsellers-price">
				<div class="block-bestsellers__old_price">80  руб.</div>
				<div class="block-bestsellers_price">50  руб.</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="block-bestsellers">
		<div class="block-bestsellers-image">
			<a href="#"><img src="/img/bestsellers/3.png" /></a>
		</div>
		<div class="block-bestsellers-description">
			<div class="block-bestsellers__name"><a href="#">ВЕСЕЛЫЙ МИШКА</a></div>
			<div class="block-bestsellers-price">
				<div class="block-bestsellers__old_price">80  руб.</div>
				<div class="block-bestsellers_price">50  руб.</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="block-bestsellers">
		<div class="block-bestsellers-image">
			<a href="#"><img src="/img/bestsellers/4.png" /></a>
		</div>
		<div class="block-bestsellers-description">
			<div class="block-bestsellers__name"><a href="#">ВЕСЕЛЫЙ МИШКА</a></div>
			<div class="block-bestsellers-price">
				<div class="block-bestsellers__old_price">80  руб.</div>
				<div class="block-bestsellers_price">50  руб.</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<div class="clear"></div>

{/capture}

{include file="common/base_page.tpl"}
