{capture name="content_name"}
	Заявки на услуги
{/capture}

{capture name="content"}
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/respond/list/"+page+"/delete/"+id+"/"+get_param;
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
            <h3 style="">Еще не зарегистрировано ни одного покупателя!</h3>
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
                {*<div class="col-xs-3">
                    <a class="btn btn-block btn-primary compose-mail" href="/admin/respond/add/{$page}/{if $get_param}{$get_param}{/if}">
                    <i class="fa fa-plus"></i> Добавить пользователя</a>
                </div>*}
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
                            <th>Дата</th>
                            <th>ФИО</th>
                            <th>E-mail</th>
                            <th>Телефон</th>
                            <th>Комментарий</th>
                            <th>Название услуги</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    {foreach from=$data item=cur name=loop}
                        <tr>
                            <td>{$cur.date|date_format:"%d-%m-%Y"}</td>
                            <td>{$cur.fio}</td>
                            <td>{$cur.email}</td>
                            <td>{$cur.phone}</td>
                            <td>{$cur.text}</td>
                            <td>{$cur.name_service}</td>
                            <td style="font-size:18px;">
                                {*<a href="/admin/respond/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a>*}
                              
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"></i></td>
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