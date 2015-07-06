{capture name="content_name"}
	Покупатели
{/capture}

{capture name="content"}
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/user/list/"+page+"/delete/"+id+"/"+get_param;
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
                    <a class="btn btn-block btn-primary compose-mail" href="/admin/user/add/{$page}/{if $get_param}{$get_param}{/if}">
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
                            <th>E-mail</th>
                            <th>ФИО</th>
                            <th>Дата регистрации</th>
                            <th>Город</th>
                            <th>Телефон</th>
                            <th>Активность</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    {foreach from=$data item=cur name=loop}
                        <tr>
                            <td>{$cur.email}</td>
                            <td>{$cur.name} {$cur.last_name}</td>
                            <td>{$cur.date|date_format:"%d-%m-%Y"}</td>
                            <td>{$cur.city}</td>
                            <td>{$cur.phone}</td>
                            <td>{if $cur.activate==1}ДА{else}нет{/if}</td>
                            <td style="font-size:18px;">
                                {*<a href="/admin/user/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a>*}
                                <i style="cursor: pointer;" title="Полная информация" alt="Полная информация" class="fa fa-info"></i>
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"></i></td>
                        </tr>
                        <tr class="more_info" style="display: none;">
                            <td>
                                <table style="border-collapse: separate;border-spacing: 15px 5px;">
                                    <tr>
                                        <td>Имя : </td>
                                        <td>{$cur.name}</td>
                                    </tr>
                                    <tr>
                                        <td>Фамилия : </td>
                                        <td>{$cur.last_name}</td>
                                    </tr>
                                    <tr>
                                        <td>Название компании : </td>
                                        <td>{$cur.name_company}</td>
                                    </tr>
                                    <tr>
                                        <td>Логин : </td>
                                        <td>{$cur.login}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td>{$cur.email}</td>
                                    </tr>
                                    <tr>
                                        <td>Телефон : </td>
                                        <td>{$cur.phone}</td>
                                    </tr>
                                    <tr>
                                        <td>Город : </td>
                                        <td>{$cur.city}</td>
                                    </tr>
                                    <tr>
                                        <td>Адрес : </td>
                                        <td>{$cur.address}</td>
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