<?php /* Smarty version Smarty3-b7, created on 2015-07-17 17:53:16
         compiled from ".\templates\services.tpl" */ ?>
<?php /*%%SmartyHeaderCode:632055a916dc6b32f9-69013584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72f5f123d58debb6b2363644dcd81316dc840493' => 
    array (
      0 => '.\\templates\\services.tpl',
      1 => 1437144760,
    ),
  ),
  'nocache_hash' => '632055a916dc6b32f9-69013584',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>

    <?php if ($_smarty_tpl->getVariable('data_services')->value){?> 
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
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_services')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
            <div class="services-list__item<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?> last<?php }?>">
                <div class="services-list-item__image"><img src="/uploaded/services/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></div>
                <div class="services-list-item__name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                <div style="min-height:140px;"><?php echo $_smarty_tpl->getVariable('cur')->value['text'];?>
</div>
                <div class="button-service fancybox" id="service_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" href="#services">Оставить заявку</div>
            </div>
             <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%3==0){?><div class="clear"></div><?php }?>
        <?php }} ?>
        <div class="clear"></div>
        <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>
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
                <input type="text" <?php if (!$_smarty_tpl->getVariable('user')->value){?>value=""<?php }else{ ?>value="<?php echo $_smarty_tpl->getVariable('user')->value['phone'];?>
"<?php }?> name="phone">
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

    <?php }else{ ?> 
	
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i><a href='/portfolio/'>Портфолио</a>
            <i class="fa fa-chevron-right"></i><?php echo $_smarty_tpl->getVariable('data_item')->value['name'];?>

        </div>
        <br />
    </div>
		
    <div class="portfolio-list">
        <div class='portfolio-text'><?php echo $_smarty_tpl->getVariable('data_item')->value['text'];?>
</div>
        <?php if ($_smarty_tpl->getVariable('data_photo_goriz')->value||$_smarty_tpl->getVariable('data_photo_vert')->value){?>    
            <?php if ($_smarty_tpl->getVariable('data_photo_goriz')->value){?>
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_photo_goriz')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_g"]['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_g"]['iteration']++;
?>
                    <div class="portfolio-list__item<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_g']['iteration']%3==0){?> last<?php }?>">
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" /></a></div>
                        <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>						
                        <div class="name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                    </div>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_g']['iteration']%3==0){?><div class="clear"></div><?php }?>
                <?php }} ?>
                <div class="clear"></div>
            <?php }?>
            <?php if ($_smarty_tpl->getVariable('data_photo_vert')->value){?>
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_photo_vert')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_v"]['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["loop_v"]['iteration']++;
?>
                    <div class="portfolio-list__item vert<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_v']['iteration']%4==0){?> last<?php }?>">							
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/<?php echo $_smarty_tpl->getVariable('cur')->value['id_portfolio'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" /></div>
                        </a>
                        <div class="highslide-caption"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>						
                        <div class="name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div>
                    </div>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop_v']['iteration']%4==0){?><div class="clear"></div><?php }?>
                <?php }} ?>
                <div class="clear"></div>
            <?php }?>
        <?php }?>
    </div>
<?php }?>
		
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
