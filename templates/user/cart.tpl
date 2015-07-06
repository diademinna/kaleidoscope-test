{capture name="content"}
<script>
    $(document).ready(function(){
        $(".fancybox").fancybox({
            'width':'600px',
            'beforeLoad': function(){ 
                var table = $('#table-cart').clone();
                table.find('thead td:nth-child(1), thead td:nth-child(3), thead td:nth-child(6)').remove();
                table.find('tbody td:not(.table-total-cost):nth-child(1), tbody td:nth-child(3), tbody td:nth-child(6)').remove();
                table.find('.table-total-cost').attr('colspan','2');
                table.addClass('clone');
                table.find('i').remove();
                table.find('.description-product-count input').attr('disabled', 'disabled').css('border', 'none').css('background-color', '#ffffff');
                table.find('.description-product-count').css('float', 'none');
                $('.table-clone').html("");
                $('.table-clone').append(table);
            },
            'afterClose': function(){
                $('.table-clone').html("");
            }
        });
       
        var val = 0;
        $('.fa.fa-plus').click(function(){
            var id = $(this).parent().parent().next().next().children().attr('id');
            id_product = parseInt(id.replace("remove_", ""));
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/add_one_product/",
                async: false,
                data:{
                    id_product: id_product
                },
                success: function(data){
                }
             });
            ///изменение самого количества
            val = parseInt($(this).prev().val()) + 1;
            $(this).prev().val(val); 
            //назначение цены в зависимости от количества в строке
            price = $(this).parent().parent().next().children().text(); //текущая цена в строке
            price = parseInt(price.replace(" ", ""));
            price_one = parseInt($(this).parent().parent().next().children('input').val());//цена за 1 товар
            price_new = String(price_one * val);
            price_new = price_new.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $(this).parent().parent().next().children().text(price_new);
            
            //изменение общей стоимости
            cur_total_price = $('#total_price_cart span').text(); //узнаем старую стоимость
            cur_total_price = parseInt(cur_total_price.replace(" ", ""));
            new_total_price = String(cur_total_price + price_one);
            new_total_price = new_total_price.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $('#total_price_cart').html('<span>'+new_total_price+'<span> руб.');
            $('#item_product_in_cart_'+ id_product).find('.count').text(val);
            $('.header-cart-total__item').find('span').text(new_total_price+' руб.');
            $('#total_price-cart-header').text(new_total_price);
           
        });
        $('.fa.fa-minus').click(function(){
            val = parseInt($(this).next().val()) - 1;
            if (val>=1)
            {
                var id = $(this).parent().parent().next().next().children().attr('id');
                id_product = parseInt(id.replace("remove_", ""));
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/remove_one_product/",
                    async: false,
                    data:{
                        id_product: id_product
                    },
                    success: function(data){
                    }
                 });
                ///изменение самого количества
                val = parseInt($(this).next().val()) - 1;
                $(this).next().val(val); 
                //назначение цены в зависимости от количества в строке
                price = $(this).parent().parent().next().children().text(); //текущая цена в строке
               
                price = parseInt(price.replace(" ", ""));
                price_one = parseInt($(this).parent().parent().next().children('input').val());//цена за 1 товар
                price_new = String(price_one * val);
                price_new = price_new.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                $(this).parent().parent().next().children().text(price_new);

                //изменение общей стоимости
                cur_total_price = $('#total_price_cart span').text(); //узнаем старую стоимость
                cur_total_price = parseInt(cur_total_price.replace(" ", ""));
                new_total_price = String(cur_total_price - price_one);
                new_total_price = new_total_price.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                $('#total_price_cart').html('<span>'+new_total_price+'<span> руб.');
                $('#item_product_in_cart_'+ id_product).find('.count').text(val);
                $('.header-cart-total__item').find('span').text(new_total_price+' руб.');
                $('#total_price-cart-header').text(new_total_price);
            }
        });
        $('.fa.fa-times').click(function(){
            
            $(this).parent().parent().remove();
            var id = ($(this).attr('id')); 
            id_product = parseInt(id.replace("remove_", ""));
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/remove_product/",
                async: false,
                data:{
                    id_product: id_product
                },
                success: function(data){
                }
            });
            location.reload();
        });
    });
</script>
<script>
    function checkCheckout(login)
    {
        $('.container-checkout input').removeClass('error');
        var counter = 0;
        if (login)
        {
            if (!$('.container-checkout input[name="phone"]').val()) 
            {
                counter++;
                $('.container-checkout input[name="phone"]').addClass('error');
            }
            if (!counter)
            {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/add_order/",
                    async: false,
                    data:{
                        login:login,
                        text:$('.container-checkout textarea[name="text"]').val(),
                        phone: $('.container-checkout input[name="phone"]').val()
                    },
                    success: function(data){
                    }
                });
                $('.container-checkout').html('<div style="margin:60px 0; line-height:1.5; text-align:center; font-size:17px;">Спасибо! Ваш заказ принят!<br />В течение 10 минут мы вам перезвоним!</div>');
            }
            else
            {
                return false;
            }
        }
        else
        {
            $('.container-checkout input[name="email"]').next().text("");
            if (!$('.container-checkout input[name="name"]').val()) 
            {
                counter++;
                $('.container-checkout input[name="name"]').addClass('error');
            }
            if (!$('.container-checkout input[name="last_name"]').val()) 
            {
                counter++;
                $('.container-checkout input[name="last_name"]').addClass('error');
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
                else
                {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/check_email/",
                        async: false,
                        data:  {
                            email: $('.container-checkout input[name="email"]').val()
                        },
                        success: function(data){
                            if (data.data_check_email=='find')
                            {
                                counter++;
                                $('.container-checkout input[name="email"]').addClass('error');
                                $('.container-checkout input[name="email"]').next().html('покупатель с таким e-mail уже существует. Пожалуйста <a href="/login/">войдите</a> в свой аккаунт');
                              //  $('#form-registration input[name="email"]').parent().next().text('покупатель с таким e-mail уже существует');
                            }
                        }
                    });
                }
            }
            if (!$('.container-checkout input[name="phone"]').val()) 
            {
                counter++;
                $('.container-checkout input[name="phone"]').addClass('error');
            }
            if (counter)
                return false;
            else
            {
                 $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/add_order/",
                    async: false,
                    data:{
                        name:$('.container-checkout input[name="name"]').val(),
                        last_name:$('.container-checkout input[name="last_name"]').val(),
                        email:$('.container-checkout input[name="email"]').val(),
                        login:0,
                        text:$('.container-checkout textarea[name="text"]').val(),
                        phone: $('.container-checkout input[name="phone"]').val()
                    },
                    success: function(data){
                    }
                });
                $('.container-checkout').html('<div style="margin:60px 0; line-height:1.5; text-align:center; font-size:17px;">Спасибо! Ваш заказ принят!<br />В течение 10 минут мы вам перезвоним!</div>');
                return false;
            }
        }
    }
</script>
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>
        Корзина покупок
    </div>
    <div class="cart-container">
        <h1>Корзина покупок</h1>
        
        <table class="cart-info" id="table-cart">
            <thead>
                <tr>
                    <td>Изображение</td>
                    <td>Название</td>
                    <td>Артикул</td>
                    <td>Количество</td>
                    <td>Стоимость</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            {foreach from=$cart item=cur}
            <tr>
                <td><img height="80px;" src="/uploaded/product/{$cur.id}_sm.{$cur.ext}" /></td>
                <td><a href="/product/{$cur.id}/">{$cur.name}</a></td>
                <td>{$cur.id_category}{$cur.id}</td>
                <td>
                    <div class="description-product-count">
                        <i class="fa fa-minus"></i>
                        <input class="description-product-count_input" type="text" value="{$cur.count}" />
                        <i class="fa fa-plus"></i>
                    </div>
                </td>
                <td class="price">
                    {math assign="price" equation='x*y' x={$cur.price} y=$cur.count}  
                    <span>{$price|cost}</span>
                    <input type="hidden" name="price-one" value="{$cur.price}" /> руб.
                </td>
                <td><i style="cursor: pointer; font-size: 18px;" id="remove_{$cur.id}" alt="Убрать из корзины" title="Убрать из корзины" class="fa fa-times"></i></td>
            </tr>
            {/foreach}
            <tr>
                <td class="table-total-cost" colspan="4" style="text-align:left;">Общая стоимость:</td>
                <td class="price" id="total_price_cart" style="font-size: 22px;" colspan="2"> <span>{$total_price|cost}</span> руб.</td>
            </tr>
            </tbody>
        </table>
        <div class="buttons-cart">
            <div class="buttons-cart_button">
                <a href="/category/">Продолжить покупки
                <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
            <div class="buttons-cart_button">
                <a class="fancybox" href="#checkout">Оформить заказ<i class="fa fa-check"></i></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="checkout" style="display:none;width:500px;">
    <div style="text-align: center;"><h2>оформление заказа</h2></div>
    <div class="container-checkout">
        <form method="post" action="">
        {if !$user}
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>Ваше имя: </div>
            <div class="form-login-input">
                <input type="text" value="" name="name">
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-login-row">
            <div class="form-login-label big"><span>*</span>Ваша фамилия: </div>
            <div class="form-login-input">
                <input type="text" value="" name="last_name">
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
        {/if}
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
        <div class="table-clone"></div>
        <br />
        <div style="text-align:center;">
            <button class="green_button" onclick="return checkCheckout('{$user.login}');">Оформить заказ</button>
        </div>
        </form>
    </div>
</div>
{/capture}

{include file="common/base_page.tpl"}











