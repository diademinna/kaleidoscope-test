{capture name="content"}
<script>
    $(document).ready(function(){
         $('.refresh_kcaptcha').click(function(){ 
            var mass_el = document.getElementsByClassName('kcaptcha');
            var rand_number = Math.random();
            for (var i = 0; i < mass_el.length; i++) {
                mass_el[i].src='/kcaptcha?'+rand_number;
              }
        });
    });
   
    function checkBeforeSubmit(){
        var counter = 0;
        $('td.error').text("");
        $('.form-registration_input').removeClass('error');
        $('.form-registration_input').removeClass('ok');
        $.ajax({
           type: "POST",
           dataType: "json",
           url: "/check_captcha/",
           async: false,
           data:{
               text_kcaptcha: $('#form-registration input[name="kcaptcha"]').val()
           },
           success: function(data){
               if(data.data_ajax=="error")
               {
                    counter++;
                    $('#form-registration input[name="kcaptcha"]').addClass('error');
                    $('#form-registration input[name="kcaptcha"]').parent().next().text('поле "Код подтверждения" обязательно для заполнения');
               }
               else if (data.data_ajax=="ok")
               {
                   $('#form-registration input[name="kcaptcha"]').addClass('ok');
               }
           }
        });
        if (!$('#form-registration input[name="name"]').val()) 
        {
            counter++;
            $('#form-registration input[name="name"]').addClass('error');
            $('#form-registration input[name="name"]').parent().next().text('поле "Имя" обязательно для заполнения');
        }
        else {
            $('#form-registration input[name="name"]').addClass('ok');
        }
        if (!$('#form-registration input[name="last_name"]').val()) 
        {
            counter++;
            $('#form-registration input[name="last_name"]').addClass('error');
            $('#form-registration input[name="last_name"]').parent().next().text('поле "Фамилия" обязательно для заполнения');
        }
        else {
            $('#form-registration input[name="last_name"]').addClass('ok');
        }
        if (!$('#form-registration input[name="email"]').val()) {
            counter++;
            $('#form-registration input[name="email"]').addClass('error');
            $('#form-registration input[name="email"]').parent().next().text('поле "E-mail" обязательно для заполнения');
        }
        else if (!$('#form-registration input[name="email"]').val().match(/[a-z0-9!#$%&'*+/=?^_`{ | }~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{ | }~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/)) {
            counter++;
            $('#form-registration input[name="email"]').addClass('error');
            $('#form-registration input[name="email"]').parent().next().text('неправильный формат поля "E-mail" ');
    	}
        else {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "/check_email/",
                async: false,
                data:  {
                    email: $('#form-registration input[name="email"]').val()
                },
                success: function(data){
                    if (data.data_check_email=='find')
                    {
                        counter++;
                        $('#form-registration input[name="email"]').addClass('error');
                        $('#form-registration input[name="email"]').parent().next().text('покупатель с таким e-mail уже существует');
                    }
                    else if (data.data_check_email=='ok')
                    {
                        $('#form-registration input[name="email"]').addClass('ok');
                    }
                }
            });
        }
        if (!$('#form-registration input[name="city"]').val()) {
            counter++;
            $('#form-registration input[name="city"]').addClass('error');
            $('#form-registration input[name="city"]').parent().next().text('укажите ваш город или населенный пункт');
        }
        else {
            $('#form-registration input[name="city"]').addClass('ok');
        }
        if (!$('#form-registration input[name="password"]').val()) {
            counter++;
            $('#form-registration input[name="password"]').addClass('error');
            $('#form-registration input[name="password"]').parent().next().text('укажите пароль для вашей учетной записи');
        }
        else
        {

            var t = $('#form-registration input[name="password"]').val();
            if( String(t).length <= 5)
            {
                counter++;
                $('#form-registration input[name="password"]').addClass('error');
                $('#form-registration input[name="password"]').parent().next().text('длина пароля должна быть не менее 6 символов');
            }
            else if (!$('#form-registration input[name="password_confirm"]').val()) {
                counter++;
                $('#form-registration input[name="password_confirm"]').addClass('error');
                $('#form-registration input[name="password_confirm"]').parent().next().text('повторите пароль для вашей учетной записи');
            }
            else
            {
                var pass = $('#form-registration input[name="password"]').val();
                var pass_confirm = $('#form-registration input[name="password_confirm"]').val();
                if (pass !== pass_confirm)
                {
                    counter++;
                    $('#form-registration input[name="password_confirm"]').addClass('error');
                    $('#form-registration input[name="password_confirm"]').parent().next().text('пароли не совпадают');
                }
                else
                {
                    $('#form-registration input[name="password"]').addClass('ok');
                    $('#form-registration input[name="password_confirm"]').addClass('ok');
                }
            }
        }
        if (counter)
            return false;
        else
        {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/registration_user/",
                async: false,
                data:  {
                    name: $('#form-registration input[name="name"]').val(),
                    last_name: $('#form-registration input[name="last_name"]').val(),
                    email: $('#form-registration input[name="email"]').val(),
                    name_company: $('#form-registration input[name="name_company"]').val(),
                    phone: $('#form-registration input[name="phone"]').val(),
                    city: $('#form-registration input[name="city"]').val(),
                    address: $('#form-registration input[name="address"]').val(),
                    password: $('#form-registration input[name="password"]').val()
                },
                success: function(data){
                    if (data)
                    {
                        $('#form-user').hide();
                        $('.registration-form-ok').show();
                    }
                }
            });
            return false;
        }
    }
</script>
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Регистрация учетной записи
        </div>
        <br />
        <h1>Регистрация учетной записи</h1>
        <div class="container-registration">
            <div id="form-user">
            <p>Если у вас уже есть учетная запись на этом сайте, пожалуйста перейдите на страницу <a href="/login/">входа в систему</a></p>
            
            <form method="post" action="" id="form-registration">
                {include file="common/errors_block.tpl"}
                <h2>Ваши персональные данные</h2>
                <table class="form-registration">
                    <tr>
                        <td class="form-registration_label"><span>*</span>Имя:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="name" value="" /></td>
                        <td class="error"></td>
                        
                    </tr>
                    <tr>
                        <td class="form-registration_label"><span>*</span>Фамилия:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="last_name" value="" /></td>
                        <td class="error"></td>
                        
                    </tr>
                    <tr>
                        <td class="form-registration_label"><span>*</span>E-mail:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="email" value="" /></td>
                        <td class="error"></td>
                    </tr>
                    <tr>
                        <td class="form-registration_label">Телефон:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="phone" value="" /></td>
                        <td class="error"></td>
                        
                    </tr>
                    <tr>
                        <td class="form-registration_label"><span>*</span>Город / населенный пункт:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="city" value="" /></td>
                        <td class="error"></td>
                        
                    </tr>
                    <tr>
                        <td class="form-registration_label">Адрес:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="text" name="address" value="" /></td>
                        <td class="error"></td>
                        
                    </tr>
                </table>
                
                <h2>Ваш пароль</h2>
                <table class="form-registration">
                    <tr>
                        <td class="form-registration_label"><span>*</span>Пароль:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="password" name="password" value="" /></td>
                        <td class="error"></td>
                    </tr>
                    <tr>
                        <td class="form-registration_label"><span>*</span>Подтверждение пароля:</td>
                        <td style="width:260px;"><input class="form-registration_input" type="password" name="password_confirm" maxlength="50" value="" /></td>
                        <td class="error"></td>
                    </tr>
                     <tr>
                        <td class="form-registration_label"><span>*</span>Код подтверждения:</td>
                        <td><input class="form-registration_input" style="width:60px;" type="text" data-content="" data-placement="bottom" data-trigger="manual" name="kcaptcha"><img class="kcaptcha" src="/kcaptcha/"><span class="refresh_kcaptcha" style="cursor: pointer; padding-left:10px;"><i alt="Обновить" title="Обновить" class="fa fa-refresh"></i></span></td>
                        <td class="error"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br /><button class="green_button" onclick="return checkBeforeSubmit();">Зарегистрироваться</button></td>
                        
                    </tr>
                </table>
            </form>
            </div>
            <div class="registration-form-ok" style="display: none;">
                <h2>Ваша учетная запись создана!</h2>
                <p>Подтверждение отправлено по указанному адресу электронной почты. Если вы не получили письмо в течение часа, пожалуйста, свяжитесь с нами. После подтверждения, войдите в свою учетную запись на странице <a href="/login/">логинизации</a>.</p>
            </div>
        </div>
    </div>
    
	<!--<h1>Регистрация</h1>
		
	{include file="common/errors_block.tpl"}

	<form name="regform" method="post" action="">
        <table class="forma">
        
		  <tr>
			<td colspan="2"><p><span class="red">(*)</span> - отмечены поля обязательные для заполнения</p></td>
		  </tr>

		  <tr>
			<td>Логин: <span class="red">*</span></td>
			<td><div class="input_bgr"><input name="login" type="text"  value="{$login}" /></div></td>
		  </tr>
		  
		  <tr>
			<td>Пароль: <span class="red">*</span></td>
			<td><div class="input_bgr"><input name="reg_password" type="password"  /></div></td>
		  </tr>
		  
		  <tr>
			<td>Подтверждение пароля: <span class="red">*</span></td>
			<td><div class="input_bgr"><input name="reg_password2" type="password" maxlength="50"  /></div></td>
		  </tr>
		  
		  <tr>
			<td>ФИО: </td>
			<td><div class="input_bgr"><input name="fio" type="text"  value="{$fio}" /></div></td>
		  </tr>
		  
		  <tr>
			<td>E-mail: <span class="red">*</span></td>
			<td><div class="input_bgr"><input name="email" type="text"  value="{$email}" /></div></td>
		  </tr>
		  
		  <tr>
		    <td></td>
			<td>
				<input type="image" src="/img/btn_send.png" class="but" />
				<input type="hidden" name="submitted" value="1"/>
				<input type="hidden" name="registr" value="1"/>
			</td>
		  </tr>
		  
		</table>
    </form>-->

{/capture}

{include file="common/base_page.tpl"}