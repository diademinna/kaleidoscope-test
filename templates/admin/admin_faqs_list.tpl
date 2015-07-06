{capture name="content_name"}
	Вопрос-Ответ
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/faqs/list/"+page+"/delete/"+id+"/"+get_param;
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
			<td colspan="2" style="text-align:right;"><a class="add" href="/admin/faqs/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
					
		<tr class="nobgr">
			<td colspan="2">
				<div class="sort_zag">
					<ul>
						<li>
							<div style="width:20%;" class="sh"><div class="padd">Имя</div></div>
							<div style="width:25%;" class="sh"><div class="padd">Вопрос</div></div>
							<div style="width:25%;" class="sh"><div class="padd">Ответ</div></div>
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
								<div style="width:20%;"><div class="padd">{$cur.fio}</div></div>
								<div style="width:25%;"><div class="padd">{$cur.question}</div></div>
								<div style="width:25%;"><div class="padd">{$cur.answer}</div></div>
								<div style="width:15%;"><div class="padd">
									<input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate({$cur.id})" />
								</div></div>
								<div style="width:15%;"><div class="padd">								
									<a href="/admin/faqs/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
									<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
								</div></div>
								<div class="clean"></div>
								{assign var="min_pos" value=$cur.pos}
							</li>
						{/foreach}
					</ul>
					<input type="hidden" id="min_pos" value="{$min_pos}">  {* минимальная позиция на странице *}
				</div>
					
			</td>			
		</tr>
		
		<tr class="nobgr">
			<td colspan="2" style="text-align:right;"><a class="add" href="/admin/faqs/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		
		<tr class="nobgr">
			<td colspan="2">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
		
	</table>

{/capture}

{include file="admin/common/base_page.tpl"}
