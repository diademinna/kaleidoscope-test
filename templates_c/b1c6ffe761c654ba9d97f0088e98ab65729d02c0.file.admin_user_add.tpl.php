<?php /* Smarty version Smarty3-b7, created on 2015-06-30 00:45:51
         compiled from ".\templates\admin/admin_user_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80965591bc8f359073-76119396%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1c6ffe761c654ba9d97f0088e98ab65729d02c0' => 
    array (
      0 => '.\\templates\\admin/admin_user_add.tpl',
      1 => 1435614350,
    ),
  ),
  'nocache_hash' => '80965591bc8f359073-76119396',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Редактировать - Пользователи
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
<div class="ibox-title">
    <h5>Форма для добавления / редактирования профиля пользователя</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <div class="form-group">
            <label class="col-sm-2 control-label">Имя :</label>
            <div class="col-sm-10">
                <input name="name" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Фамилия :</label>
            <div class="col-sm-10">
                <input name="last_name" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['last_name'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Логин :</label>
            <div class="col-sm-10">
                <input name="login" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['login'];?>
" />
            </div>
        </div>
        <?php if ($_smarty_tpl->getVariable('action')->value=="edit"){?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Пароль (свертка) :</label>
            <div class="col-sm-10">
                <input name="password" id="password" readonly class="form-control" type="password" value="<?php echo $_smarty_tpl->getVariable('data')->value['password'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Установить Новый пароль :</label>
            <div class="col-sm-10">
                <input name="new_password" id="new_password" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['new_password'];?>
" />
            </div>
        </div>
        <?php }else{ ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Пароль :</label>
            <div class="col-sm-10">
                <input name="password" id="password" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['password'];?>
" />
            </div>
        </div>
        <?php }?>
        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['email'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Телефон :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['phone'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Город :</label>
            <div class="col-sm-10">
                <input name="city" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['city'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Адрес :</label>
            <div class="col-sm-10">
                <input name="address" class="form-control" value="<?php echo $_smarty_tpl->getVariable('data')->value['address'];?>
" />
            </div>
        </div>
        <?php if ($_smarty_tpl->getVariable('action')->value=="edit"){?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Дата регистрации:<br />(2012-12-31)</label>
                <div class="col-sm-10"><textarea name="date" id="date"><?php echo $_smarty_tpl->getVariable('data')->value['date'];?>
</textarea></div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Последний визит:<br />(2012-12-31)</label>
                <div class="col-sm-10"><textarea name="last_visit" id="last_visit" readonly><?php echo $_smarty_tpl->getVariable('data')->value['last_visit'];?>
</textarea></div>
            </div>
           <!--- <div class="form-group">
                <div class="checkbox">
                    <label class="col-sm-2 control-label">Активность :</label>
                    <div class="col-sm-10"><input id="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" type="checkbox" name="my_checkbox" value="<?php echo $_smarty_tpl->getVariable('data')->value['activate'];?>
" <?php if ($_smarty_tpl->getVariable('data')->value['activate']==1){?>checked<?php }?>>
                    <label class="label_checkbox" for="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"></label></div>
                </div>
            </div>-->
        <?php }?>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="submitted" value="1" />
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->getVariable('action')->value;?>
">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
">
    </form>
</div>
			
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
