{capture name="content_name"}
	{if !$id_section}Разделы сайта{else}{$data_section_cur.name}{/if}
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(id_section, id){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/section/list/"+id_section+"/delete/"+id+"/";
			}
		}
				
		$(function(){
			$("#sortable").sortable({
				opacity:0.8, revert:true, axis:'y'
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

	{*if $mass_navigation}
		<div class="navigation">
			<a href="/admin/section/list/">КАТАЛОГ</a> :: 
			{foreach from=$mass_navigation item=cur name=loop}
				{if $smarty.foreach.loop.last} 
					{$cur.name} 
				{else}
					<a href="/admin/section/list/{$cur.id}/">{$cur.name}</a> :: 
				{/if}		
			{/foreach}
		</div>
	{/if*}
	
	
		
		<table class="list" width="100%">
			
			<tr class="nobgr">
				<td></td>
				<td style="text-align:right;"><a class="add" href="/admin/section/add/{$id_section}/">Добавить</a></td>
			</tr>		
			
			<tr class="nobgr">
				<td colspan="2">
					<div class="sort_zag">
						<ul>
							<li>
								<div style="width:{if $id_section}45{else}60{/if}%;" class="sh"><div class="padd">Название</div></div>
								<div style="width:25%;" class="sh"><div class="padd">URL</div></div>
								
								{if $id_section}<div style="width:15%;" class="sh"><div class="padd">На сайте</div></div>{/if}
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
							{foreach from=$data_section item=cur name=loop}
								<li id="item_{$cur.id}">								
									<div style="width:{if $id_section}45{else}60{/if}%;"><div class="padd">
										{if !$id_section AND !$cur.flag_nosection}<a href="/admin/section/list/{$cur.id}/" title="Перейти в этот раздел">{$cur.name}</a>{else}{$cur.name}{/if}											
									</div></div>
																		
									<div style="width:25%;"><div class="padd">
										{$cur.url}
									</div></div>
									
									{if $id_section}
										<div style="width:15%;"><div class="padd">
											<input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')" />
										</div></div>
									{/if}
									
									<div style="width:15%;"><div class="padd">
											{if $id_section OR $cur.flag_nosection}
												
												&nbsp;<a href="/admin/section_photo/add/{$id_section}/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a>&nbsp;
											{else}
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											{/if}
											<a href="/admin/section/add/{$id_section}/edit/{$cur.id}/"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>&nbsp;&nbsp;
											
										<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$id_section}', '{$cur.id}');" onmouseover="this.style.cursor='pointer';"/>
										
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
				<td></td>
				<td style="text-align:right;"><a class="add" href="/admin/section/add/{$id_section}/">Добавить</a></td>
			</tr>
		
		</table>
		

	
{/capture}

{include file="admin/common/base_page.tpl"}