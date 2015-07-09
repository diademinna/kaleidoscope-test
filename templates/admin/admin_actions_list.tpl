{capture name="content_name"}
	Акции
{/capture}

{capture name="content"}

<script type="text/javascript">
    function delRecord(page, id, get_param){
        if(confirm("Вы уверены?")){
            top.window.location = "/admin/actions/list/"+page+"/delete/"+id+"/"+get_param;
        }
    }
</script>
{if !$data}
    <div class="ibox-content ibox-heading">
        <h3 style="">Еще не добавлено ни одной акции!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/actions/add/">
        <i class="fa fa-plus"></i>	Добавить акцию</a>
    </div>
</div>
{else} 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-xs-3">
                        <a class="btn btn-block btn-primary compose-mail" href="/admin/actions/add/{if $get_param}{$get_param}{/if}">
                        <i class="fa fa-plus"></i> Добавить акцию</a>
                    </div>
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
                                <th>Название</th>
                                <th>Категории</th>
                                <th>Дата начала</th>
                                <th>Дата окончания</th>
                                <th>На сайте</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$data item=cur name=loop}
                                <tr>
                                    <td>{$cur.name}</td>
                                    <td>
                                        {if $cur.category}
                                            {foreach from=$cur.category item=cur2}
                                                {$cur2.name_category}<br/>
                                            {/foreach}
                                        {/if}
                                    </td>
                                    <td>{$cur.date|date_format:"%d.%m.%Y"}</td>
                                    <td>{if !$cur.date_end}не указана{else}{$cur.date_end|date_format:"%d.%m.%Y"}{/if}</td>
                                    <td>
                                        <div class="checkbox">
                                            <input id="male{$cur.id}" type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')">
                                            <label class="label_checkbox" for="male{$cur.id}"></label>
                                        </div>
                                    </td>
                                    <td style="font-size:18px;">
                                        <a href="/admin/actions/add/{$page}/edit/{$cur.id}/"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                        <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"></i>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
{/if}
<!--
	
	<table class="list" width="100%">
		<tr class="nobgr">
			<td colspan="4">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
									{include file="admin/common/select_count_page.tpl"}
							  </select>
				<br /><br />
			</td>
		</tr>
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/actions/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		
		<tr class="sh">
			<td>Название</td>
			<td>Дата</td>
			<td>Показывать<br />на сайте</td>
			<td width="80" class="center">Действие</td>
		</tr>
		
		{foreach from=$data item=cur name=loop}
			<tr {if $smarty.foreach.loop.iteration%2==0}class="chet"{/if}>
				<td>{$cur.name}</td>
				<td>{$cur.date|date_format:"%d.%m.%Y"}</td>
				<td width="10%"><input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')" /></td>
				
				<td class="center">
					<a href="/admin/actions_photo/add/{$page}/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> 
					&nbsp;
					<a href="/admin/actions/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		{/foreach}
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/actions/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
				
		<tr class="nobgr">
			<td colspan="4">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
		
	</table> -->
	
{/capture}

{include file="admin/common/base_page.tpl"}