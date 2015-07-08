<?php /* Smarty version Smarty3-b7, created on 2015-07-09 00:32:09
         compiled from ".\templates\product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20797559d96d9f01dc2-43646936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0a0ea1f4ba0b28399383d7b7c7c75c5ef8ab4d7' => 
    array (
      0 => '.\\templates\\product.tpl',
      1 => 1436391117,
    ),
  ),
  'nocache_hash' => '20797559d96d9f01dc2-43646936',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
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
            <?php if ($_smarty_tpl->getVariable('mass_navigation')->value){?>
                <a href="/category/">Каталог</a>
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mass_navigation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                    <i class="fa fa-chevron-right"></i>
                    <a href="/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                <?php }} ?>
                <i class="fa fa-chevron-right"></i>
                <?php echo $_smarty_tpl->getVariable('data_product')->value['name'];?>

            <?php }else{ ?>
                Каталог
            <?php }?>
        </div>
        <div class="description-product">
            <div class="description-product_images">
                <div class="description-product-main_img">
                    <a onclick="return hs.expand(this, config1);" onfocus="this.blur();" href="/uploaded/product/<?php echo $_smarty_tpl->getVariable('data_product')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data_product')->value['ext'];?>
" align="left"><img alt="<?php echo $_smarty_tpl->getVariable('data_product')->value['name'];?>
" title="<?php echo $_smarty_tpl->getVariable('data_product')->value['name'];?>
" src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('data_product')->value['id'];?>
_prev.<?php echo $_smarty_tpl->getVariable('data_product')->value['ext'];?>
" /></a>
                    <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('data_product')->value['name'];?>
</div>
                </div>
                <?php if ($_smarty_tpl->getVariable('data_product_photo')->value){?>
                <div id="carousel-container">
                    <div class="gallery-carousel-content">
                        <div style="left:0px;">
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product_photo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                <div class="gallery-carousel-block">
                                    <a onclick="return hs.expand(this, config1);" onfocus="this.blur();" href="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id_product'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" align="left"><img alt="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id_product'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_prev.<?php echo $_smarty_tpl->getVariable('data_product')->value['ext'];?>
" /></a>
                                    <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                    <?php if (count($_smarty_tpl->getVariable('data_product_photo')->value)>3){?>
                        <div class="gallery-carousel-left"><i class="fa fa-chevron-left"></i></div>
                        <div class="gallery-carousel-right"><i class="fa fa-chevron-right"></i></div>
                    <?php }?>
                </div>
                <?php }?>
            </div>
            <div class="description-product_text">
                <div class="description-product_name"><?php echo $_smarty_tpl->getVariable('data_product')->value['name'];?>
</div>
                <div class="description-product-price">
                    <?php if ($_smarty_tpl->getVariable('data_product')->value['price']){?><div class="description-product-price-actual"><?php echo $_smarty_tpl->getVariable('data_product')->value['price'];?>
 руб.</div><?php }?>
                    <?php if ($_smarty_tpl->getVariable('data_product')->value['old_price']){?><div class="description-product-price_old"><?php echo $_smarty_tpl->getVariable('data_product')->value['old_price'];?>
 руб.</div><?php }?>
                    <div class="clear"></div>
                </div>
                <div class="description-product-code"><span>Артикул:</span> <?php echo $_smarty_tpl->getVariable('data_product')->value['code'];?>
</div>
                <div class="description-product-count">
                    <span>Количество:</span><i class="fa fa-minus"></i><input class="description-product-count_input" type="text" value="1" name="count" /><i class="fa fa-plus"></i>
                </div>
                <div class="description_in_cart" style="margin-top:10px;">
                    <div class="button-in-cart" id="id_product_<?php echo $_smarty_tpl->getVariable('data_product')->value['id'];?>
"><i class="fa fa-shopping-cart"></i> В корзину</div>
                </div>
                <div class="clear"></div>
                <?php if ($_smarty_tpl->getVariable('data_product')->value['filtr']){?>
                <div class="product-params">
                    <div class="product-params_name"><?php echo $_smarty_tpl->getVariable('data_product')->value['name_filtr']['name_filtr'];?>
:</div>
                    <ul class="product-params-param">
                        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product')->value['filtr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                            <li style="background: url('/uploaded/parameter/<?php echo $_smarty_tpl->getVariable('cur')->value['id_parameter'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
') no-repeat transparent 0 0;"><?php echo $_smarty_tpl->getVariable('cur')->value['name_parameter'];?>
</li>
                        <?php }} ?>
                    </ul>
                </div>
                <?php }?>
                <div class='product-podarok'>
                    <div class='product_podarok_icon'>  При покупке этого товара вы получаете в подарок 1 герберу
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <?php if ($_smarty_tpl->getVariable('data_product')->value['text']){?>
                <div class="bgr-dark_red title-block" style='margin-top:30px;'>описание</div>
                <div class='detail-product-description user-content'><?php echo $_smarty_tpl->getVariable('data_product')->value['text'];?>
</div>
            <?php }?>
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
	
	
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
