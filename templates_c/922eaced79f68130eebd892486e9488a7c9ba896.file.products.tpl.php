<?php /* Smarty version Smarty3-b7, created on 2015-07-14 11:41:10
         compiled from ".\templates\rebuild/products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2423555a4cb260a7106-01393790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '922eaced79f68130eebd892486e9488a7c9ba896' => 
    array (
      0 => '.\\templates\\rebuild/products.tpl',
      1 => 1436863267,
    ),
  ),
  'nocache_hash' => '2423555a4cb260a7106-01393790',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.truncate.php';
if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
?>
<div style="min-height:700px;">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
        <div class="container-product"<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?> style="margin-right:0;"<?php }?>>
            <?php if ($_smarty_tpl->getVariable('cur')->value['actions']){?>
                <div class="container-product_action"><a href="/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id_action'];?>
/"><img src="/img/podarok_icon.png" title="При покупке этого товара вы получаете подарок" alt="При покупке этого товара вы получаете подарок" /></a></div>
            <?php }?>
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
<div class="clear"></div>
<?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>