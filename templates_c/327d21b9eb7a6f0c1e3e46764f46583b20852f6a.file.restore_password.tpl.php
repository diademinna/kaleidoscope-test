<?php /* Smarty version Smarty3-b7, created on 2015-07-02 15:09:17
         compiled from ".\templates\user/restore_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18624559529ed691ba3-29025560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '327d21b9eb7a6f0c1e3e46764f46583b20852f6a' => 
    array (
      0 => '.\\templates\\user/restore_password.tpl',
      1 => 1435838956,
    ),
  ),
  'nocache_hash' => '18624559529ed691ba3-29025560',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Восстановление пароля
        </div>
        <br />
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<br/>
        <form action="" method="post">
            <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
                <div class="form-login-row">
                    <div class="form-login-label big">Ваш E-mail: </div>
                    <div class="form-login-input"><input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
" /></div>
                    <div class="clear"></div>
                </div>
                <div class="form-login-row">
                    <input type="hidden" name="submitted" value="1" />
                    <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
                </div>
            </div>
        </form>
        <br/><br/>
	<p style="text-align:center;font-size:14px;font-weight:bold;"><?php if ($_smarty_tpl->getVariable('result')->value){?><?php echo $_smarty_tpl->getVariable('result')->value;?>
<?php }?></p>
	<br/><br/>
    </div>

	
		
	
	

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
