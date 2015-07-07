<?php /* Smarty version Smarty3-b7, created on 2015-07-07 18:16:18
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18957559bed420b5235-32017659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1436282166,
    ),
  ),
  'nocache_hash' => '18957559bed420b5235-32017659',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.truncate.php';
if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
?><?php ob_start(); ?>
<ul class="index-category">
<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
    <li class="index-category__item">
        <a class="index-category__link" href="/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">
            <div class="index-category__image">
                <img src="/uploaded/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_prev.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" />
            </div>
            <div class="index-category__name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
        </a>
    </li>
<?php }} ?>
</ul>
<div class="container-width_670px">
<div class="bgr-dark_red title-block">популярные товары</div>
<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product_popular')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
    <div class="container-product"<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?> style="margin-right:0;"<?php }?>>
        <div class="container-product_filtr">
            fddsf
        </div>
        <div class="container-product__image"><a href="/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><img src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></a></div>
        <div class="container-product__name"><a href="/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('cur')->value['name'],35,"...");?>
</a></div>
        <div class="container-product-price">
            <?php if (!$_smarty_tpl->getVariable('cur')->value['old_price']){?>
                <div class="container-product__price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price']);?>
 руб.</div>
                <div class="clear"></div>
            <?php }else{ ?>
                <div class="container-product__old_price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['old_price']);?>
 руб.</div>
                <div class="container-product__price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price']);?>
 руб.</div>
                <div class="clear"></div>
            <?php }?>
        </div>
        <div class="button-in-cart product" id="product_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><i class="fa fa-shopping-cart"></i> Добавить в корзину</div>
    </div>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?><div class="clear"></div><?php }?>
<?php }} ?>
</div>
<div class="container-width_300px">
<div class="bgr-green title-block">часто покупаемые товары</div>
<div class="container-bestsellers">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product_buys')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
	<div class="block-bestsellers">
            <div class="block-bestsellers-image">
                    <a href="/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><img src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_buy.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></a>
            </div>
            <div class="block-bestsellers-description">
                <div class="block-bestsellers__name"><a href="/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a></div>
                <div class="block-bestsellers-price">
                    <?php if ($_smarty_tpl->getVariable('cur')->value['old_price']){?>
                        <div class="block-bestsellers__old_price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['old_price']);?>
  руб.</div>
                    <?php }?>
                    <div class="block-bestsellers_price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price']);?>
  руб.</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
	</div>
    <?php }} ?>
	
</div>
</div>
<div class="clear"></div>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

