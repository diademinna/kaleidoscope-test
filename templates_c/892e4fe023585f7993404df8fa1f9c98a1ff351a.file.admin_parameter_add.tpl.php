<?php /* Smarty version Smarty3-b7, created on 2015-07-07 15:56:49
         compiled from ".\templates\admin/admin_parameter_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11493559bcc91536cc6-99971681%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '892e4fe023585f7993404df8fa1f9c98a1ff351a' => 
    array (
      0 => '.\\templates\\admin/admin_parameter_add.tpl',
      1 => 1436273808,
    ),
  ),
  'nocache_hash' => '11493559bcc91536cc6-99971681',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Параметры для категорий / <?php if ($_smarty_tpl->getVariable('data')->value['name']){?>Редактировать - <?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
<?php }else{ ?>Добавить<?php }?>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>


<?php ob_start(); ?>
<div class="ibox-title">
	<h5>Форма для добавления категории</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <div class="form-group">
            <label class="col-sm-2 control-label">Название* :</label>
            <div class="col-sm-10">
                    <input name="name" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" />
            </div>
        </div>
       <?php if ($_smarty_tpl->getVariable('parent_id')->value){?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Изображение (превью):</label>
            <div class="col-sm-10">
                <input  type="file" name="image" />
                <br /><br />
                <div id="photo">
                    <?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
                        <a href="/uploaded/parameter/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/parameter/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" class="photo" /></a>
                        &nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
'); return false;"></i>
                            <input type="hidden" name="ext" value="<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" />
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                        <input type="hidden" name="submitted" value="1" />
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
        </div>
    </form>
</div>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

