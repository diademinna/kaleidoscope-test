<?php /* Smarty version Smarty3-b7, created on 2015-07-15 17:29:53
         compiled from ".\templates\portfolio.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2986255a66e61dadbe3-80372792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bcb6a997dd897f6a9b49bb23951f24b380161bc' => 
    array (
      0 => '.\\templates\\portfolio.tpl',
      1 => 1436970591,
    ),
  ),
  'nocache_hash' => '2986255a66e61dadbe3-80372792',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>

    <?php if ($_smarty_tpl->getVariable('data_portfolio')->value){?> 

<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Портфолио
    </div>
    <br />
    <div class="portfolio-list">
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_portfolio')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
            <div class="portfolio-list__item<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?> last<?php }?>">
                <div class='portfolio-list-item__image'><a href="/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><img src="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></a></div>
                <div class="portfolio-list-item__name"><a href="/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a></div>
                <div class='portfolio-list-item__anons'><?php echo $_smarty_tpl->getVariable('cur')->value['anons'];?>
</div>
            </div>
             <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?><div class="clear"></div><?php }?>
        <?php }} ?>
        <div class="clear"></div>
        <div class="clear"></div>
        <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>
    </div>
</div>

    <?php }else{ ?> 
	
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i><a href='/portfolio/'>Портфолио</a>
            <i class="fa fa-chevron-right"></i><?php echo $_smarty_tpl->getVariable('data_item')->value['name'];?>

        </div>
        <br />
    </div>
		
    <div class="portfolio-list">
        <div class='portfolio-text'><?php echo $_smarty_tpl->getVariable('data_item')->value['text'];?>
</div>
        <?php if ($_smarty_tpl->getVariable('data_photo_goriz')->value||$_smarty_tpl->getVariable('data_photo_vert')->value){?>    
            <?php if ($_smarty_tpl->getVariable('data_photo_goriz')->value){?>
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_photo_goriz')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_g"]['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_g"]['iteration']++;
?>
                    <div class="portfolio-list__item<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_g']['iteration']%3==0){?> last<?php }?>">
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" /></a></div>
                        <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>						
                        <div class="name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                    </div>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_g']['iteration']%3==0){?><div class="clear"></div><?php }?>
                <?php }} ?>
                <div class="clear"></div>
            <?php }?>
            <?php if ($_smarty_tpl->getVariable('data_photo_vert')->value){?>
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_photo_vert')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_v"]['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_v"]['iteration']++;
?>
                    <div class="portfolio-list__item vert<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_v']['iteration']%4==0){?> last<?php }?>">							
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" /></div>
                        </a>
                        <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>						
                        <div class="name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                    </div>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_v']['iteration']%4==0){?><div class="clear"></div><?php }?>
                <?php }} ?>
                <div class="clear"></div>
            <?php }?>
        <?php }?>
    </div>
<?php }?>
		
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
