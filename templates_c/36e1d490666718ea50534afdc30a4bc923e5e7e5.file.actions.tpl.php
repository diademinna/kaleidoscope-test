<?php /* Smarty version Smarty3-b7, created on 2015-07-14 15:08:35
         compiled from ".\templates\actions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2950055a4fbc3e69f93-73699310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36e1d490666718ea50534afdc30a4bc923e5e7e5' => 
    array (
      0 => '.\\templates\\actions.tpl',
      1 => 1436875714,
    ),
  ),
  'nocache_hash' => '2950055a4fbc3e69f93-73699310',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.truncate.php';
?><?php ob_start(); ?>
    <?php if ($_smarty_tpl->getVariable('data_actions')->value){?> 
        <div class="container-login">
            <div class="navigation">
                <a href="/"><i class="fa fa-home"></i></a>
                <i class="fa fa-chevron-right"></i>Акции
            </div>
            <br />
            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_actions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
                <div class="container-action<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%2==0){?> last<?php }?>">
                    
                   <div class="container-action_image"><img src="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></div>
                   <div class="action-description">
                        <div class="action-description_name">
                            <a href="/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                        </div>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['date_end']){?>
                            <div style="margin-bottom: 5px; color:#9d9d9d; font-size: 12px;">Действует до: <b><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date_end'],"%d.%m.%Y");?>
</b></div>
                        <?php }?>
                        <div class="container-action-text">
                        <?php if ($_smarty_tpl->getVariable('cur')->value['anons']){?>
                            <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('cur')->value['anons'],90,"...");?>

                        <?php }else{ ?>
                            <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('cur')->value['text'],90,"...");?>

                        <?php }?>
                        </div>
                        <div class="action-more"><a href="/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">Подробнее</a></div>
                   </div>
                    <div class="clear"></div>
                </div>
            <?php }} ?>
            <div class="clear"></div>
            <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>
        </div>
		
		
	<?php }else{ ?> 

            <div class="container-login">
                <div class="navigation">
                    <a href="/"><i class="fa fa-home"></i></a>
                    <i class="fa fa-chevron-right"></i><a href="/actions/">Акции</a>
                    <i class="fa fa-chevron-right"></i><?php echo $_smarty_tpl->getVariable('data_item')->value['name'];?>

                </div>
                  <br />
                <div style="float:left;width:488px; margin-right:20px;">
                    <div class="action-image">
                        <img src="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('data_item')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data_item')->value['ext'];?>
" />
                    </div>
                    <div class="action-desciption">
                        <div class="action-description__name"><?php echo $_smarty_tpl->getVariable('data_item')->value['name'];?>
</div>
                        <div class="action-description__date_end">Действует до:<span><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('data_item')->value['date_end'],"%d.%m.%Y");?>
</span></div>
                    </div>
                    <div class="clear"></div>
                    <div class="bgr-dark_red title-block" style="margin-top:30px;">описание</div>
                    <div class="action_category">
                        Действует на товары из следующих категорий:
                        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_actions_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                            <div class="action-category"><a href="/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id_category'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name_category'];?>
</a></div>
                        <?php }} ?>
                        <br />
                        <?php echo $_smarty_tpl->getVariable('data_item')->value['text'];?>

                    </div>
                </div>
                <?php if ($_smarty_tpl->getVariable('data_last_actions')->value){?>
                <div style="float:left;">
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_last_actions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                         <div class="container-action last" style="float: none;">
                    
                            <div class="container-action_image"><img src="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></div>
                            <div class="action-description">
                                 <div class="action-description_name">
                                     <a href="/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                                 </div>
                                 <?php if ($_smarty_tpl->getVariable('cur')->value['date_end']){?>
                                     <div style="margin-bottom: 5px; color:#9d9d9d; font-size: 12px;">Действует до: <b><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date_end'],"%d.%m.%Y");?>
</b></div>
                                 <?php }?>
                                 <div class="container-action-text">
                                 <?php if ($_smarty_tpl->getVariable('cur')->value['anons']){?>
                                     <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('cur')->value['anons'],90,"...");?>

                                 <?php }else{ ?>
                                     <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('cur')->value['text'],90,"...");?>

                                 <?php }?>
                                 </div>
                                 <div class="action-more"><a href="/actions/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">Подробнее</a></div>
                            </div>
                             <div class="clear"></div>
                         </div>
                    <?php }} ?>
                </div>
                <?php }?>
                <div class="clear"></div>
                  
            </div>
		
		
		
		
	<?php }?>
		
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
