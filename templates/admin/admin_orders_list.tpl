{capture name="content_name"}
	Заказы
{/capture}

{capture name="content"}
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/order/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
                $(document).ready(function(){
                    $('.fa.fa-info').click(function(){
                        var pr = $(this).parent().parent().next().css('display');
                        if (pr == 'none')
                            $(this).parent().parent().next().show();
                        else
                            $(this).parent().parent().next().hide();
                    });
                });
	</script>
{if !$data}
    <div class="ibox-content ibox-heading">
            <h3 style="">Пока что не поступило ни одного заказа!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    {*<div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/product/add/">
        <i class="fa fa-plus"></i>	Добавить продукт</a>
    </div>*}
</div>
{else}
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                <div class="col-xs-2">
                    Выводить по :
                </div>    
                <div class="col-xs-3">

                    <select class="form-control m-b" name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
                        {include file="admin/common/select_count_page.tpl"}
                    </select>	
                </div>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Дата заказа</th>
                            <th>Город</th>
                            <th>ФИО</th>
                            <th>Общая сумма заказа</th>
                            <th>Комментарий</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    {foreach from=$data item=cur name=loop}
                        <tr>
                            <td>{$cur.date|date_format:"%d-%m-%Y"}<br />{$cur.date|date_format:"%H:%M:%S"}</td>
                            <td>{$cur.city}</td>
                            <td>{$cur.name} {$cur.last_name}</td>
                            <td>{$cur.total_summa|cost} руб.</td>
                            <td>{$cur.text}</td>
                            <td style="font-size:18px;">
                                <i style="cursor: pointer;" title="Полная информация" alt="Полная информация" class="fa fa-info"></i>
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"></i></td>
                        </tr>
                        <tr class="more_info" style="display: none;">
                            <td colspan="5">
                                <table style="border-collapse: separate;border-spacing: 15px 5px;">
                                    <tr>
                                        <td>Имя : </td>
                                        <td style='font-weight: bold;'>{$cur.name} {$cur.last_name}</td>
                                        <td>Название компании : </td>
                                        <td style='font-weight: bold;'>{$cur.name_company}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td style='font-weight: bold;'>{$cur.login}</td>
                                        <td>Телефон : </td>
                                        <td style='font-weight: bold;'><i style="color:#93c567;" class="fa fa-phone"></i> {$cur.phone}</td>
                                    </tr>
                                    <tr>
                                        <td>Город : </td>
                                        <td style='font-weight: bold;'>{$cur.city}</td>
                                        <td>Адрес : </td>
                                        <td style='font-weight: bold;'>{$cur.address}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Информация по заказу:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table width='100%;'>
                                                <tr>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Название</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Изображение</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Количество</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">за 1 шт</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Всего</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Название акции</td>
                                                </tr>
                                                {foreach from=$cur.order_product item=cur2}
                                                    <tr>
                                                        <td style="border:1px solid #cccccc;padding:0 5px;"><a title='перейти на страницу товара' target="_blank" href='/product/{$cur2.id_product}/'>{$cur2.name_product}</a></td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><img height='40px' src='/uploaded/product/{$cur2.id_product}_sm.{$cur2.img_ext}' /></td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;">{$cur2.count}</td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;">{$cur2.price_product|cost} руб.</td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;">{math assign="price_count" equation="x*y" x=$cur2.price_product y=$cur2.count}{$price_count|cost} руб.</td>
                                                         <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><a href="/actions/{$cur.id_action}">{$cur2.name_action}</a></td>
                                                    </tr>
                                                {/foreach}
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    {/foreach}
                    
                </table>
            </div> 
        </div>
        {if $pager_string}<div class="pager">{$pager_string}</div>{/if} 
    </div>
{/if}
	
{/capture}

{include file="admin/common/base_page.tpl"}