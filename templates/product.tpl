{capture name="content"}
    <script type="text/javascript" src="/js/carousel/jquery.jcarousel.js" charset="utf-8"></script>
<script>
    $(document).ready(function(){
        var val = 0;
        $('.fa.fa-plus').click(function(){
            val = parseInt($('.description-product-count_input').val()) + 1;
            $('.description-product-count_input').val(val); 
        });
        $('.fa.fa-minus').click(function(){
            val = parseInt($('.description-product-count_input').val()) - 1;
            if (val>=1)
            $('.description-product-count_input').val(val);
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.gallery-carousel-content').jcarousel({
            'wrap': 'circular'
        });
        $('.gallery-carousel-left').bind('click',function(){
            $('.gallery-carousel-content').jcarousel('scroll', '-=1');
        });
        $('.gallery-carousel-right').bind('click',function(){
            $('.gallery-carousel-content').jcarousel('scroll', '+=1');
        });
        
        $('.button-in-cart').click(function(){
            var id_product = $('.button-in-cart').attr('id');
            id_product = id_product.replace("id_product_", "");
            count = $('.description-product-count_input').val();
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "/add_product/",
                async: false,
                data:{
                    id_product: id_product,
                    count: count
                },
                success: function(data){
                }
             });
            $('#info_about_cart').show();
            location.reload();
        });
       
    });
</script>
    <div class="container-width_670px">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>
            {if $mass_navigation}
                <a href="/category/">Каталог</a>
                {foreach from=$mass_navigation item=cur}
                    <i class="fa fa-chevron-right"></i>
                    <a href="/category/{$cur.id}/">{$cur.name}</a>
                {/foreach}
                <i class="fa fa-chevron-right"></i>
                {$data_product.name}
            {else}
                Каталог
            {/if}
        </div>
        <div class="description-product">
            <div class="description-product_images">
                <div class="description-product-main_img">
                    <a onclick="return hs.expand(this, config1);" onfocus="this.blur();" href="/uploaded/product/{$data_product.id}.{$data_product.ext}" align="left"><img alt="{$data_product.name}" title="{$data_product.name}" src="/uploaded/product/{$data_product.id}_prev.{$data_product.ext}" /></a>
                    <div class="highslide-caption">{$data_product.name}</div>
                </div>
                {if $data_product_photo}
                <div id="carousel-container">
                    <div class="gallery-carousel-content">
                        <div style="left:0px;">
                            {foreach from=$data_product_photo item=cur}
                                <div class="gallery-carousel-block">
                                    <a onclick="return hs.expand(this, config1);" onfocus="this.blur();" href="/uploaded/product/{$cur.id_product}/{$cur.id}.{$cur.ext}" align="left"><img alt="{$cur.name}" title="{$cur.name}" src="/uploaded/product/{$cur.id_product}/{$cur.id}_prev.{$data_product.ext}" /></a>
                                    <div class="highslide-caption">{$cur.name}</div>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                    {if count($data_product_photo) >3}
                        <div class="gallery-carousel-left"><i class="fa fa-chevron-left"></i></div>
                        <div class="gallery-carousel-right"><i class="fa fa-chevron-right"></i></div>
                    {/if}
                </div>
                {/if}
            </div>
            <div class="description-product_text">
                <div class="description-product_name">{$data_product.name}</div>
                <div class="description-product-price">
                    {if $data_product.price}<div class="description-product-price-actual">{$data_product.price} руб.</div>{/if}
                    {if $data_product.old_price}<div class="description-product-price_old">{$data_product.old_price} руб.</div>{/if}
                    <div class="clear"></div>
                </div>
                <div class="description-product-code"><span>Артикул:</span> {$data_product.code}</div>
                <div class="description-product-count">
                    <span>Количество:</span><i class="fa fa-minus"></i><input class="description-product-count_input" type="text" value="1" name="count" /><i class="fa fa-plus"></i>
                </div>
                <div class="description_in_cart" style="margin-top:10px;">
                    <div class="button-in-cart" id="id_product_{$data_product.id}"><i class="fa fa-shopping-cart"></i> В корзину</div>
                </div>
                <div class="clear"></div>
                {if $data_product['filtr']}
                <div class="product-params">
                    <div class="product-params_name">{$data_product['name_filtr']['name_filtr']}:</div>
                    <ul class="product-params-param">
                        {foreach from=$data_product['filtr'] item=cur}
                            <li style="background: url('/uploaded/parameter/{$cur.id_parameter}_sm.{$cur.ext}') no-repeat transparent 0 0;">{$cur.name_parameter}</li>
                        {/foreach}
                    </ul>
                </div>
                {/if}
                <div class='product-podarok'>
                    <div class='product_podarok_icon'>  При покупке этого товара вы получаете в подарок 1 герберу
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            {if $data_product.text}
                <div class="bgr-dark_red title-block" style='margin-top:30px;'>описание</div>
                <div class='detail-product-description user-content'>{$data_product.text}</div>
            {/if}
        </div>
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
	
	{*{if $mass_navigation}
		<div class="navigation">
			<a href="/category/">КАТАЛОГ</a> :: 
			{foreach from=$mass_navigation item=cur name=loop}
				{if $smarty.foreach.loop.last} 
					{$cur.name} 
				{else}
					<a href="/category/{$cur.id}/">{$cur.name}</a> :: 
				{/if}		
			{/foreach}
		</div>
	{/if}
	
	<br />
	
	{if $data_product}    
			 
		<div>
			<b>{$data_product.name}</b>
			{if $data_brand.$data_product_id_brand.name}[{$data_brand.$data_product_id_brand.name}]{/if}
		</div>

		Цена: {$data_product.cost} руб.
		<br />
		Код: {$data_product.code}
		<br />
		Описание: {$data_product.text}
		<br />

		{if $data_product.ext}
			<a onclick="return hs.expand(this)" onfocus="this.blur()" href="/uploaded/product/{$data_product.id}.{$data_product.ext}">
				<img src="/uploaded/product/{$data_product.id}_sm.{$data_product.ext}" />
			</a>
		{else}
			<img src="/img/no_photo.png" />
		{/if}
		
		
	{/if}*}
	
{/capture}

{include file="common/base_page.tpl"}