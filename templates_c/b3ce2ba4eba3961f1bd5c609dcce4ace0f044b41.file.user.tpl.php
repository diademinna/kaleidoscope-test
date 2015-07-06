<?php /* Smarty version Smarty3-b7, created on 2015-06-30 09:54:40
         compiled from ".\templates\user/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3005055923d30d7f931-97638874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3ce2ba4eba3961f1bd5c609dcce4ace0f044b41' => 
    array (
      0 => '.\\templates\\user/user.tpl',
      1 => 1435647279,
    ),
  ),
  'nocache_hash' => '3005055923d30d7f931-97638874',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Редактирование профиля
    </div>
    <br />
    <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    <?php if ($_GET['note']=='save'){?><div style="text-align:center;font-size:14px;"><b>Сохранено</b></div><br /><?php }?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
            <div class="form-login-row">
                <div class="form-login-label big">Ваше имя: </div>
                <div class="form-login-input"><input type="text" name="name" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваша фамилия: </div>
                <div class="form-login-input"><input type="text" name="last_name" value="<?php echo $_smarty_tpl->getVariable('data')->value['last_name'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Название компании: </div>
                <div class="form-login-input"><input type="text" name="name_company" value="<?php echo $_smarty_tpl->getVariable('data')->value['name_company'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш E-mail: </div>
                <div class="form-login-input"><input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('data')->value['email'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш телефон: </div>
                <div class="form-login-input"><input type="text" name="phone" value="<?php echo $_smarty_tpl->getVariable('data')->value['phone'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш город: </div>
                <div class="form-login-input"><input type="text" name="city" value="<?php echo $_smarty_tpl->getVariable('data')->value['city'];?>
" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш адрес: </div>
                <div class="form-login-input"><input type="text" name="address" value="<?php echo $_smarty_tpl->getVariable('data')->value['address'];?>
" /></div>
                <div class="clear"></div>
            </div>
                <br />
            <div class="form-login-row">
                <input type="hidden" name="submitted" value="1" />
                <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
            </div>
        </div>
    </form>
</div>

		
				
		
				
		


<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>












