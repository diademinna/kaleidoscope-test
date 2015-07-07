{capture name="content"}

<script>
    function SortFunction(action_val, page, id_category)
    {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/sort_product/",
            async: true,
            data:{
                action_val:action_val,
                page:page,
                id_category:id_category,
                min_price:$( "#contentSlider1" ).text(),
                max_price:$( "#contentSlider2" ).text()
            },
            success: function(data){
                $("#sort_products").html(data.data_ajax_sort_products);
                xajax_SetSort(action_val);
            }
        });
    }
</script>
<script type="text/javascript" src="/js/ui/jquery-ui.min.js"></script>

{literal}
<script type="text/javascript">
$(document).ready(function(){
  $( "#slider" ).slider({
        range:true,
        values : [{/literal}{if $cur_min_price}{$cur_min_price}{else}{$min_price}{/if}{literal},{/literal}{if $cur_max_price}{$cur_max_price}{else}{$max_price}{/if}{literal}],//Значение, которое будет выставлено слайдеру при загрузке
        min : {/literal}{$min_price}{literal},//Минимально возможное значение на ползунке
        max : {/literal}{$max_price}{literal},//Максимально возможное значение на ползунке
        step : 100,//Шаг, с которым будет двигаться ползунок
        create: function( event, ui ) {
        $( "#contentSlider1" ).html($("#slider").slider("values", 0));
        $( "#contentSlider2" ).html($("#slider").slider("values", 1));
       },
       slide: function( event, ui ) {
            $( "#contentSlider1" ).html( ui.values[0]);
            $( "#contentSlider2" ).html( ui.values[1]);
        },
        stop: function(event, ui){
            var min_price = $( "#contentSlider1" ).text();
            var max_price = $( "#contentSlider2" ).text();
            var id_category = {/literal}{$id_category}{literal};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/filtr_price_product/",
                async: true,
                data:{
                    min_price:min_price,
                    max_price:max_price,
                    id_category:id_category
                },
                success: function(data){
                    $("#sort_products").html(data.data_ajax_sort_products);
                }
            });
            if (!id_category){
                history.pushState(null, null, '/category/?min_price='+min_price+"&max_price="+max_price);
            }
            else
            {
                history.pushState(null, null, '/category/'+id_category+'/?min_price='+min_price+"&max_price="+max_price);
            }
           // location.reload();
        }
        });
        
        $('.label_checkbox').click(function(){
            var min_price = $( "#contentSlider1" ).text();
            var max_price = $( "#contentSlider2" ).text();
            var id_parameter = $(this).prev().val();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/filtr_parameter/",
                async: true,
                data:{
                    id_parameter:id_parameter,
                    id_category:{/literal}{$id_category}{literal},
                    min_price:min_price,
                    max_price:max_price
                    
                },
                success: function(data){
                    $("#sort_products").html(data.data_ajax_sort_products);
                }
            });
        });
        $('.apply-filtr').click(function(){
            var min_price = $( "#contentSlider1" ).text();
            var max_price = $( "#contentSlider2" ).text();
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "/filtr_parameter/",
                async: true,
                data:{
                    id_parameter:0,
                    id_category:{/literal}{$id_category}{literal},
                    min_price:min_price,
                    max_price:max_price
                },
                success: function(data){
                    $("#sort_products").html(data.data_ajax_sort_products);
                }
            });
        });
});
</script> 
{/literal}
<div class="container-width_300px">
    <div class="container_margin_top">
        <div class="container-catalog">
        {foreach from=$data_catalog item=cur}
            <div class="container-catalog_item">
                <a class="container-catalog_link{if $cur.id==$id_category} active{/if}" href="/category/{$cur.id}/">{$cur.name}</a> 
                {if $cur.subcatalog1}
                <div class="container-subcategory">
                    {foreach from=$cur.subcatalog1 item=cur2}
                        <a class="container-subcatalog1_link{if $cur2.id==$id_category} active{/if}" href="/category/{$cur2.id}/">{$cur2.name}</a>
                    {/foreach}
                </div>
                {/if}
            </div>
        {/foreach}
        </div>
    </div>
    <div class='title-block bgr-orange'>фильтр</div>   
    <div class='container-filtr'>
        <div class='container_filtr_name'>Какая цена?</div>
        <div class="polzunok">
            от <span id="contentSlider1"></span> до <span id="contentSlider2" ></span>
            <div id="slider"></div>
            <div class="polzunok-min_price">{$min_price}</div>
            <div class="polzunok-max_price">{$max_price}</div>
            <div class="clear"></div>
        </div>
    </div>
    <br />
    {if $data_category['data_filtr']}
    <div class='container-filtr'>
        <div class='container_filtr_name'>{$data_category.filtr_name}</div>
        <br />
        {foreach from=$data_category['data_filtr'] item=cur}
            <div class="radio">
                <input id="male{$cur.id}" {if $id_parameter_filtr==$cur.id} checked="checked"{/if} type="radio" value="{$cur.id}" name="id_parameter">
                <label class="label_checkbox" for="male{$cur.id}"><span style="background:url(/uploaded/parameter/{$cur.id}_sm.{$cur.ext}) no-repeat transparent 0 0; padding:0 0 5px 30px;">{$cur.name}</span></label>
            </div>
        {/foreach}
        <div style="text-align:center;"><div class="apply-filtr">Сбросить фильтр</div></div>
    </div>
    {/if}
</div>
<div class="container-width_670px margin-left">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>
        {if $mass_navigation}
            <a href="/category/">Каталог</a>
            {foreach from=$mass_navigation item=cur name=loop}
                <i class="fa fa-chevron-right"></i>
                {if $smarty.foreach.loop.last}
                    {$cur.name}
                {else}
                    <a href="/category/{$cur.id}/">{$cur.name}</a>
                {/if}
            {/foreach}
        {else}
            Каталог
        {/if}
    </div>
    <h1>{$data_category.name}</h1>
    <div class="category-description">{$data_category.text}</div>
    <div class="sort">
        Сортировать по: 
        <select class="form-control" onchange="SortFunction(this.value, {$page}, {$id_category});">
            <option value="0"{if !$val_sort_order} selected="selected"{/if}>не указано</option>
            <option value="1"{if $val_sort_order == '1'} selected="selected"{/if}>Цене: по возрастанию</option>
            <option value="2"{if $val_sort_order == '2'} selected="selected"{/if}>Цене: по убыванию</option>
            <option value="3"{if $val_sort_order == '3'} selected="selected"{/if}>Названию: по возрастанию</option>
            <option value="4"{if $val_sort_order == '4'} selected="selected"{/if}>Названию: по убыванию</option>
        </select>
    </div>
    <div id="sort_products">
        {include file="rebuild/products.tpl"}
    </div>
</div>
<div class="clear"></div>
{/capture}

{include file="common/base_page.tpl"}