{capture name="content"}
<script>
  $(document).ready(function(){
        $(".fancybox").fancybox({
            'width':'600px',
            'beforeLoad': function(){ 
            }
        });
        $('.refresh_kcaptcha').click(function(){ 
            var mass_el = document.getElementsByClassName('kcaptcha');
            var rand_number = Math.random();
            for (var i = 0; i < mass_el.length; i++) {
                mass_el[i].src='/kcaptcha?'+rand_number;
              }
        });
        
        $('.add-review').click(function(){
            if ($('#add-review').css('display')=='none')
                $('#add-review').css('display', 'block');
            else
                $('#add-review').css('display', 'none');
        });
    });
    function checkAddReview()
    {
        $('.container-checkout input').removeClass('error');
        $('.container-checkout textarea').removeClass('error');
        var counter = 0;
        $('.container-checkout input[name="email"]').next().text("");
        if (!$('.container-checkout input[name="fio"]').val()) 
        {
            counter++;
            $('.container-checkout input[name="fio"]').addClass('error');
        }
        
        if (!$('.container-checkout input[name="email"]').val()) 
        {
            counter++;
            $('.container-checkout input[name="email"]').addClass('error');
        }
        else
        {
            if (!$('.container-checkout input[name="email"]').val().match(/[a-z0-9!#$%&'*+/=?^_`{ | }~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{ | }~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/))           {
                counter++;
                $('.container-checkout input[name="email"]').addClass('error');
            }
            
        }
        if (!$('.container-checkout textarea[name="text"]').val()) 
        {
            counter++;
            $('.container-checkout textarea[name="text"]').addClass('error');
        }
        $.ajax({
           type: "POST",
           dataType: "json",
           url: "/check_captcha/",
           async: false,
           data:{
               text_kcaptcha: $('.container-checkout input[name="kcaptcha"]').val()
           },
           success: function(data){
               if(data.data_ajax=="error")
               {
                    counter++;
                    $('.container-checkout input[name="kcaptcha"]').addClass('error');
               }
               else if (data.data_ajax=="ok")
               {
                   $('.container-checkout input[name="kcaptcha"]').addClass('ok');
               }
           }
        });
        if (counter)
            return false;
        else
        {
           
           // $('.container-checkout').html('<div style="margin:60px 0; line-height:1.5; text-align:center; font-size:17px;">Спасибо за отзыв!</div>');
             return true;
        }
        
    }
</script>
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Отзывы покупателей
    </div>
    <br />
    <div class="add-review">
        <i class="fa fa-envelope-o"></i>
        Оставить отзыв
    </div>
    <div class="clear"></div>
    {if $errors}{include file="common/errors_block.tpl"}{/if}
    {if $notes}{include file="common/notify_block.tpl"}{/if}
<div id="add-review" style="display:none;">
    <div class="forma-review__title">Добавить отзыв</div>
    <div class="container-checkout">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-login-row" style="margin:10px 195px;">
                <div class="form-login-label"><span>*</span>Имя: </div>
                <div class="form-login-input">
                    <input style="width:335px;" type="text" value="" name="fio">
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row" style="margin:10px 195px;">
                <div class="form-login-label"><span>*</span>E-mail: </div>
                <div class="form-login-input">
                    <input style="width:335px;" type="text" value="" name="email">
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row" style="margin:10px 195px;">
                <div class="form-login-label">Фото: </div>
                <div class="form-login-input">
                    <input style="width:335px;padding:10px; background: none;padding:0; border:none;" type="file" class="form-control" rows="3" name="image" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row" style="margin:10px 195px;">
                <div class="form-login-label"><span>*</span>Отзыв: </div>
                <div class="form-login-input">
                    <textarea style="width:335px;padding:10px;" class="form-control" rows="3" name="text"></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row" style="margin:10px 195px;">
                <div class="form-login-label"><span>*</span>Код: </div>
                <div class="form-login-input">
                    <input class="form-registration_input" type="text" name="kcaptcha" data-trigger="manual" data-placement="bottom" data-content="" style="width:60px;">
                    <img class="kcaptcha" width="100px;" src="/kcaptcha/" style="">
                    <span class="refresh_kcaptcha" style="cursor: pointer; padding-left:10px;">
                        <i class="fa fa-refresh" title="Обновить" alt="Обновить"></i>
                    </span>
                </div>
                <div class="clear"></div>
            </div>
            <br />
            <div style="text-align:center;">
                <input type="hidden" value="1" name="submitted">
                <button class="green_button" onclick="return checkAddReview();">Добавить отзыв</button>
            </div>
        </form>
    </div>
</div>
    {foreach from=$data_review item=cur name=loop}
        <div class="container-review">
            {if $smarty.foreach.loop.iteration%2==0}
                <div class="container-review__image">
                    {if $cur.ext}
                        <img class="review-image" src="/uploaded/review/{$cur.id}_sm.{$cur.ext}" />
                    {else}
                        <img class="review-image" src="/img/no_photo_review.png" />
                    {/if}
                </div>
                <div class="container-review__text">
                    <div class="review_fio">{$cur.fio}</div>{$cur.text}
                </div>
                <div class="clear"></div>
            {else}
                <div class="container-review__image" style="float:right;">
                    {if $cur.ext}
                        <img class="review-image" src="/uploaded/review/{$cur.id}_sm.{$cur.ext}" />
                    {else}
                        <img class="review-image" src="/img/no_photo_review.png" />
                    {/if}
                </div>
                <div class="container-review__text_right" style="float:right;">
                    <div class="review_fio">{$cur.fio}</div> {$cur.text}
                </div>
                <div class="clear"></div>
            {/if}
        </div>
    {/foreach}
    {if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
</div>

	
	{*<div id="rewier_form">
		{if $errors}{include file="common/errors_block.tpl"}{/if}
		{if $notes}{include file="common/notify_block.tpl"}{/if}
		
		<form action="#rewier_form" method="POST" enctype="multipart/form-data">
		 	
		 	<table class="forma">
				<tr>
					<td colspan="2"><i>Поля, помеченные знаком <span class="red">*</span>, являются обязательными для заполнения.</i><br></td>
				</tr>
				<tr>
					<td>ФИО: <span class="red">*</span></td>
					<td><input type="text" value="{if $data_form.fio}{$data_form.fio}{/if}" name="fio" class="content_input"></td>
				</tr>
				<tr>
					<td>Эл. почта: </td>
					<td><input type="text" value="{if $data_form.email}{$data_form.email}{/if}" name="email" class="content_input"></td>
				</tr>
				<tr>
					<td>Телефон: </td>
					<td><input type="text" value="{if $data_form.tel}{$data_form.tel}{/if}" name="tel" class="content_input"></td>
				</tr>
				<tr>
					<td>Сообщение: <span class="red">*</span></td>
					<td><textarea name="text" class="content_input">{if $data_form.text}{$data_form.text}{/if}</textarea></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input name="submit" type="image" src="/img/btn_send.png" />
						<input type="hidden" value="1" name="submitted">
					</td>
				</tr>
			</table>
		 	
		</form>*}
		
	</div>

{/capture}
{include file="common/base_page.tpl"}