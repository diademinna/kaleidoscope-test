<?php /* Smarty version Smarty3-b7, created on 2015-07-02 15:03:45
         compiled from ".\templates\user/change_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6453559528a1cac5c5-99517808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3feafc05eda18f1d093a449b6f45552bd864bbb' => 
    array (
      0 => '.\\templates\\user/change_password.tpl',
      1 => 1435838625,
    ),
  ),
  'nocache_hash' => '6453559528a1cac5c5-99517808',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>

    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Смена пароля
        </div>
        <br />
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <?php if ($_GET['note']=='save'){?>
		<br/><br/><br/><div style="text-align:center;"><b>Пароль изменен!</b></div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<?php }else{ ?>
            <form action="" method="post">
                <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
                    <div class="form-login-row">
                        <div class="form-login-label big">Текущий пароль: </div>
                        <div class="form-login-input"><input type="text" name="cur_password" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <div class="form-login-label big">Новый пароль: </div>
                        <div class="form-login-input"><input type="password" name="new_password" value="<?php echo htmlspecialchars($_smarty_tpl->getVariable('new_password')->value);?>
" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <div class="form-login-label big">Повтор нового пароля: </div>
                        <div class="form-login-input"><input type="password" name="new_password_rep" value="<?php echo htmlspecialchars($_smarty_tpl->getVariable('new_password_rep')->value);?>
" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <input type="hidden" name="submitted" value="1" />
                        <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
                    </div>
                </div>
            </form>
        <?php }?>
    </div>

    
	
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
