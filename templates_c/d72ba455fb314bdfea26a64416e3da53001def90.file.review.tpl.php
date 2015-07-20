<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:35:12
         compiled from "./templates/review.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82464233955aaaa70bfc427-28904415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd72ba455fb314bdfea26a64416e3da53001def90' => 
    array (
      0 => './templates/review.tpl',
      1 => 1437229350,
    ),
  ),
  'nocache_hash' => '82464233955aaaa70bfc427-28904415',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
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
    <?php if ($_smarty_tpl->getVariable('errors')->value){?><?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
    <?php if ($_smarty_tpl->getVariable('notes')->value){?><?php $_template = new Smarty_Internal_Template("common/notify_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
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
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_review')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
        <div class="container-review">
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%2==0){?>
                <div class="container-review__image">
                    <?php if ($_smarty_tpl->getVariable('cur')->value['ext']){?>
                        <img class="review-image" src="/uploaded/review/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" />
                    <?php }else{ ?>
                        <img class="review-image" src="/img/no_photo_review.png" />
                    <?php }?>
                </div>
                <div class="container-review__text">
                    <div class="review_fio"><?php echo $_smarty_tpl->getVariable('cur')->value['fio'];?>
</div><?php echo $_smarty_tpl->getVariable('cur')->value['text'];?>

                </div>
                <div class="clear"></div>
            <?php }else{ ?>
                <div class="container-review__image" style="float:right;">
                    <?php if ($_smarty_tpl->getVariable('cur')->value['ext']){?>
                        <img class="review-image" src="/uploaded/review/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" />
                    <?php }else{ ?>
                        <img class="review-image" src="/img/no_photo_review.png" />
                    <?php }?>
                </div>
                <div class="container-review__text_right" style="float:right;">
                    <div class="review_fio"><?php echo $_smarty_tpl->getVariable('cur')->value['fio'];?>
</div> <?php echo $_smarty_tpl->getVariable('cur')->value['text'];?>

                </div>
                <div class="clear"></div>
            <?php }?>
        </div>
    <?php }} ?>
    <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>
</div>

	
	
		
	</div>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
