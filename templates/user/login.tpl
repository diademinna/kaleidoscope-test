{capture name="content"}
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
                {include file="common/errors_block.tpl"}
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

	{include file="common/errors_block.tpl"}<br />

	<form class="forma" action="" method="post" enctype="multipart/form-data">
		<table class="forma">
		  <tr>
			<td>Логин:</td>
			<td><div class="input_bgr"><input name="login" type="text"  value="{$login}" class="reg" /></div></td>
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



	{if !$user}
		<div style="clear:both;text-align:center;">
			<br/><br/>
			<span>Если вы ещё не зарегистрированы, пройдите процедуру <a href="/registration/">регистрации</a></span>
			<br/><br/>
		</div>
	{/if}
 -->

{/capture}

{include file="common/base_page.tpl"}