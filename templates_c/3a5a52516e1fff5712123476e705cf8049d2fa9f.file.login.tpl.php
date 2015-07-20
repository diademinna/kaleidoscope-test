<?php /* Smarty version Smarty3-b7, created on 2015-07-17 16:47:05
         compiled from ".\templates\user/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26080559a95ec769de7-33396745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a5a52516e1fff5712123476e705cf8049d2fa9f' => 
    array (
      0 => '.\\templates\\user/login.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '26080559a95ec769de7-33396745',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
    <div class="container-login">
         <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Вход на сайт
        </div>
        <br />
        <div class="container-new_user">
            <div class="login-new-user_heading">
                <i class="fa fa-file-text-o"></i>
                <div class="login-new-heading_text">
                    <h2>Новый покупатель</h2>
                    <b>Регистрация учетной записи</b>
                </div>
                <div class="clear"></div>
            </div>
            <div class="login-new-heading_content">
                Создав аккаунт, вы сможете совершать покупки намного быстрее и быть всегда в курсе состояния заказа.
            </div>
            <a class="login-new-button" href="/registration/">Продолжить<i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <div class="container-login_user">
            <div class="login-new-user_heading" style="margin-bottom: 14px;">
                <i class="fa fa-key"></i>
                <div class="login-new-heading_text">
                    <h2>Постоянный покупатель</h2>
                    <b>Я постоянный покупатель</b>
                </div>
                <div class="clear"></div>
            </div>
            <form method="post" action="">
                <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

                <div class="login-new-heading_content" style="padding-bottom: 4px;">
                    <div class="form-login-row">
                        <div class="form-login-label">E-mail: </div>
                        <div class="form-login-input"><input type="text" name="login" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <div class="form-login-label">Пароль: </div>
                        <div class="form-login-input"><input type="password" name="password" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row"><input type="checkbox" class="checkbox" name="remember" id="remember_login" checked> <label for="remember_login">Запомнить меня</label></div>
                </div>
                <input type="hidden" name="submitted" value="1"/>
                <button class="login-new-button" >Войти<i class="fa fa-arrow-circle-right"></i></button>
                <a class="login-forgot-pass" href="/restore_password/">Забыли пароль?</a>
            </form>
        </div>
        <div class="clear"></div>
    </div>
	<!---<h1>Войти</h1>

	<?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<br />

	<form class="forma" action="" method="post" enctype="multipart/form-data">
		<table class="forma">
		  <tr>
			<td>Логин:</td>
			<td><div class="input_bgr"><input name="login" type="text"  value="<?php echo $_smarty_tpl->getVariable('login')->value;?>
" class="reg" /></div></td>
		  </tr>

		  <tr>
			<td>Пароль:</td>
			<td><div class="input_bgr"><input name="password" type="password" class="text" /></div></td>
		  </tr>			  

		  <tr>
			<td></td>
			<td><input type="checkbox" class="checkbox" name="remember" id="remember_login" checked> <label for="remember_login">Запомнить меня</label></td>
		  </tr>

		  <tr>
			<td></td>
			<td>
				<input type="hidden" name="submitted" value="1"/>
				<input type="image" src="/img/btn_send.png" class="but" />
			</td>
		  </tr>
		</table>
	</form>	



	<?php if (!$_smarty_tpl->getVariable('user')->value){?>
		<div style="clear:both;text-align:center;">
			<br/><br/>
			<span>Если вы ещё не зарегистрированы, пройдите процедуру <a href="/registration/">регистрации</a></span>
			<br/><br/>
		</div>
	<?php }?>
 -->

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
