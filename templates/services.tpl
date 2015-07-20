{capture name="content"}

    {if $data_services} {* СПИСОК ЭЛЕМЕНТОВ *}
<script>
    $(document).ready(function(){
        $('.button-service').click(function(){
           var id_service =  $(this).attr('id');
           id_service = id_service.replace("service_", "");
           $('#services input[name="id_service"]').val(id_service);
            $(".fancybox").fancybox({
              'width':'600px',
              'beforeLoad': function(){ 
              }
          });
        });
        
       
    });
    
      function checkCheckout()
    {
        
        $('.container-checkout input').removeClass('error');
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
                if (!$('.container-checkout input[name="email"]').val().match(/[a-z0-9!#$%&'*+/=?^_`{ | }~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{ | }~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/))         {
                    counter++;
                    $('.container-checkout input[name="email"]').addClass('error');
                }
                
            }
            if (!$('.container-checkout input[name="phone"]').val()) 
            {
                counter++;
                $('.container-checkout input[name="phone"]').addClass('error');
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
                         $('.container-checkout input[name="kcaptcha"]').parent().next().text('поле "Код подтверждения" обязательно для заполнения');
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
                 $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/add_respond/",
                    async: false,
                    data:{
                        fio:$('.container-checkout input[name="fio"]').val(),
                        email:$('.container-checkout input[name="email"]').val(),
                        phone:$('.container-checkout input[name="phone"]').val(),
                        text:$('.container-checkout textarea[name="text"]').val(),
                        id_service:$('#services input[name="id_service"]').val()
                    },
                    success: function(data){
                    }
                });
                $('.container-checkout').html('<div style="margin:60px 0; line-height:1.5; text-align:center; font-size:17px;">Спасибо! Ваша заявка принята!<br />В течение часа вам перезвонят!</div>');
                return false;
            }
        
    }
</script>
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Услуги
    </div>
    <br />
    <div class="services-list">
        {foreach from=$data_services item=cur name=loop}
            <div class="services-list__item{if $smarty.foreach.loop.iteration%3 == 0} last{/if}">
                <div class="services-list-item__image"><img src="/uploaded/services/{$cur.id}_sm.{$cur.ext}" /></div>
                <div class="services-list-item__name">{$cur.name}</div>
                <div style="min-height:140px;">{$cur.text}</div>
                <div class="button-service fancybox" id="service_{$cur.id}" href="#services">Оставить заявку</div>
            </div>
             {if $smarty.foreach.loop.iteration%3==0}<div class="clear"></div>{/if}
        {/foreach}
        <div class="clear"></div>
        {if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
    </div>
</div>
<div id="services" style="display:none;width:500px;">
    <input type="hidden" name="id_service" value="">
    <div style="text-align: center;"><h2>оформление заявки на услугу</h2></div>
    <div class="container-checkout">
        <form method="post" action="">
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>Ваше имя: </div>
            <div class="form-login-input">
                <input type="text" value="" name="fio">
            </div>
            <div class="clear"></div>
        </div>
       
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>E-mail: </div>
            <div class="form-login-input">
                <input type="text" value="" name="email">
                <div style="color:#d70000; font-size: 12px;"></div>
            </div>
            <div class="clear"></div>
        </div>
     
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>Телефон: </div>
            <div class="form-login-input">
                <input type="text" {if !$user}value=""{else}value="{$user.phone}"{/if} name="phone">
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-login-row">
            <div class="form-login-label big">Комментарий: </div>
            <div class="form-login-input">
                <textarea class="form-control" rows="3" name="text"></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>Код: </div>
            <div class="form-login-input">
                <input class="form-registration_input" style="width:60px;" type="text" name="kcaptcha"><img class="kcaptcha" width="60px" src="/kcaptcha/"><span class="refresh_kcaptcha" style="cursor: pointer; padding-left:10px;"><i alt="Обновить" title="Обновить" class="fa fa-refresh"></i></span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="table-clone"></div>
        <br />
        <div style="text-align:center;">
            <button class="green_button" onclick="return checkCheckout();">Отправить</button>
        </div>
        </form>
    </div>
</div>

    {else} {* ОДИН ЭЛЕМЕНТ *}
	
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i><a href='/portfolio/'>Портфолио</a>
            <i class="fa fa-chevron-right"></i>{$data_item.name}
        </div>
        <br />
    </div>
		
    <div class="portfolio-list">
        <div class='portfolio-text'>{$data_item.text}</div>
        {if $data_photo_goriz || $data_photo_vert}    {* ФОТОГАЛЕРЕЯ *}
            {if $data_photo_goriz}
                {foreach from=$data_photo_goriz item=cur name="loop_g"}
                    <div class="portfolio-list__item{if $smarty.foreach.loop_g.iteration%3 == 0} last{/if}">
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a></div>
                        <div class="highslide-caption">{$cur.name}</div>						
                        <div class="name">{$cur.name}</div>
                    </div>
                    {if $smarty.foreach.loop_g.iteration%3==0}<div class="clear"></div>{/if}
                {/foreach}
                <div class="clear"></div>
            {/if}
            {if $data_photo_vert}
                {foreach from=$data_photo_vert item=cur name="loop_v"}
                    <div class="portfolio-list__item vert{if $smarty.foreach.loop_v.iteration%4 == 0} last{/if}">							
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></div>
                        </a>
                        <div class="highslide-caption">{$cur.name}</div>						
                        <div class="name">{$cur.name}</div>
                    </div>
                    {if $smarty.foreach.loop_v.iteration%4==0}<div class="clear"></div>{/if}
                {/foreach}
                <div class="clear"></div>
            {/if}
        {/if}
    </div>
{/if}
		
{/capture}

{include file="common/base_page.tpl"}