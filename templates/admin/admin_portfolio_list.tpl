{capture name="content_name"}
	Портфолио
{/capture}

{capture name="content"}

    <script type="text/javascript">
        function delRecord(page, id, get_param){
            if(confirm("Вы уверены?")) {
                top.window.location = "/admin/portfolio/list/"+page+"/delete/"+id+"/"+get_param;
            }
        }
        $(function() {			
            $( "#sortable" ).sortable({
                    opacity: 0.8,
                    revert: true,
                    axis:'y'
            });
        });		
        $(document).ready(function() { 
            $("#sortable").sortable({
                    update : function () { 
                        var mass_sort = $('#sortable').sortable('toArray');
                        xajax_Sort(mass_sort, $('#min_pos').val()); 
                    }
            });
        });
    </script>
    {if $data}
<form action="" method="post" id="forma_category" enctype="multipart/form-data">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                <div class="col-xs-3">
                    <a class="btn btn-block btn-primary compose-mail" href="/admin/portfolio/add/">
                    <i class="fa fa-plus"></i> Добавить</a>
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
                            <th>Дата</th>
                            <th>На сайте</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">  
                        {foreach from=$data item=cur name=loop}
                            <tr id="item_{$cur.id}">

                                <td>{$cur.name}</td>
                                <td>{$cur.date|date_format:"%d.%m.%Y"}</td>
                                <td>
                                    <div class="checkbox">
                                        <input id="male{$cur.id}" type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')">
                                        <label class="label_checkbox" for="male{$cur.id}"></label>
                                    </div>
                                </td>
                                <td style="font-size:18px;">
                                    <a href="/admin/portfolio_photo/add/{$page}/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> &nbsp &nbsp
                                    <a href="/admin/portfolio/add/{$page}/edit/{$cur.id}/"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
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
            

    {else}
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/portfolio/add/">
                <i class="fa fa-plus"></i>	Добавить</a>
            </div>
        </div>

    {/if}
{*
	
	<table class="list" width="100%">
		<tr class="nobgr">
			<td colspan="2">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
									{include file="admin/common/select_count_page.tpl"}
							  </select>
				<br /><br />
			</td>
		</tr>
		
	
		<tr class="nobgr">
			<td></td>
			<td style="text-align:right;"><a class="add" href="/admin/gallery/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		
		
		
		<tr class="nobgr">
			<td colspan="2">
				<div class="sort_zag">
					<ul>
						<li>
							<div style="width:70%;" class="sh"><div class="padd">Название</div></div>
							<div style="width:15%;" class="sh"><div class="padd">Показывать<br />на сайте</div></div>
							<div style="width:15%;" class="sh"><div class="padd">Действие</div></div>
							<div class="clean"></div>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		
		
		
		<tr class="nobgr">
			<td colspan="2">	
				
				<div class="sort_list">
				
					<ul id="sortable"  class="sort">
						{foreach from=$data item=cur name=loop}
							<li id="item_{$cur.id}">								
								<div style="width:70%;"><div class="padd">{$cur.name}</div></div>
								
								
								<div style="width:15%;"><div class="padd">
									<input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')" />
								</div></div>
								<div style="width:15%;"><div class="padd">									
									<a href="/admin/gallery_photo/add/{$page}/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> 
									&nbsp;
									<a href="/admin/gallery/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
									<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
								</div></div>
								<div class="clean"></div>
								{assign var="min_pos" value=$cur.pos}
							</li>
						{/foreach}
					</ul>
					<input type="hidden" id="min_pos" value="{$min_pos}">  
				</div>
					
			</td>			
		</tr>
		
				
		
		<tr class="nobgr">
			<td></td>
			<td style="text-align:right;"><a class="add" href="/admin/gallery/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
				
		<tr class="nobgr">
			<td colspan="2">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
		
	</table>*}
	
{/capture}

{include file="admin/common/base_page.tpl"}