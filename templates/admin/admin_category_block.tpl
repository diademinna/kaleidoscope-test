<form action="" method="post" id="forma_category" enctype="multipart/form-data">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="row">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/category/add/{$id_category}/">
                <i class="fa fa-plus"></i> Добавить категорию</a>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>Фильтр по</th>
                        <th>На сайте</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                {foreach from=$data_category item=cur name=loop}
                    <tr id="item_{$cur.id}">
                        <td>
                            <div class="checkbox choose">
                                <input id="male1{$cur.id}" type="checkbox" name="checkbox_choose[{$cur.id}]" value="1">
                                <label for="male1{$cur.id}" class="label_checkbox"></label>
                            </div>
                        </td>
                        <td>
                            <a href="/admin/category/list/{$cur.id}/" title="Перейти в этот раздел">{$cur.name}</a> 
                        </td>
                        
                        <td>
                            <input id="optionsRadios0" type="radio" name="id_cat_{$cur.id}" value="0" {if !$cur.id_parameter} checked="checked"{/if} {if $level} disabled="disabled"{/if} onclick="xajax_SetParameter('{$cur.id}',0);">  нет фильтра<br/>
                            {foreach from=$data_parameters item=cur2}
                                
                                <input id="optionsRadios{$cur2.id}" type="radio" name="id_cat_{$cur.id}" value="{$cur2.id}" {if $cur.id_parameter==$cur2.id} checked="checked"{/if} {if $level} disabled="disabled"{/if}  onclick="xajax_SetParameter('{$cur.id}','{$cur2.id}');">  {$cur2.name}<br/>
                            {/foreach}
                        </td>
                        <td>
                            <div class="checkbox">
                                <input id="male{$cur.id}" type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')">
                                <label class="label_checkbox" for="male{$cur.id}"></label>
                            </div>
                        </td>
                        <td style="font-size:18px;">
                            <a href="/admin/category/add/{$id_category}/edit/{$cur.id}/">
                                <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$id_category}', '{$cur.id}');" onmouseover="this.style.cursor='pointer';"></i>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
                {*
        <div class="table-responsive">
           <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Дополнительный функционал</th>
                    </tr>
                    <tr class="nobgr">
                        <td>
                            Перенести выбранные категории в &nbsp;
                            <select style="width:300px;" class="form-control m-b-xs" name="select_category">
                                    <option value="">...выберите...</option>
                                    <option value="0">Корневой уровень каталога</option>
                                    {foreach from=$data_category_all item=cur}
                                            <option value="{$cur.id}">{$cur.name}</option>
                                    {/foreach}
                            </select>
                            &nbsp;
                            <a style="width:300px;" class="btn btn-block btn-info" href="#" onclick="if(confirm('Перенести выбранные категории. Вы уверены?')) xajax_ChangeCategory(xajax.getFormValues('forma_category')); return false;">выполнить</a>

                        </td>
                </tr>
                </thead>
            </table>
        </div>*}
    </div>
</div>
</form>



<!--<form action="" method="post" id="forma_category" enctype="multipart/form-data">
<table class="list" width="100%">
	<tr class="nobgr">
		<td colspan="2" class="zag">КАТЕГОРИИ</td>
	</tr>

	<tr class="nobgr">
		<td></td>
		<td style="text-align:right;"><a class="add" href="/admin/category/add/{$id_category}/">Добавить</a></td>
	</tr>

	<tr class="nobgr">
		<td colspan="2">
			<div class="sort_zag">
				<ul>
					<li>
						<div style="width:3%;" class="sh"><div class="padd"></div></div>
						<div style="width:67%;" class="sh"><div class="padd">Название</div></div>
						<div style="width:15%;" class="sh"><div class="padd">На сайте</div></div>
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
					{foreach from=$data_category item=cur name=loop}
						<li id="item_{$cur.id}">
							<div style="width:3%;"><div class="padd choose"><input type="checkbox" name="checkbox_choose[{$cur.id}]" value="1"></div></div>
							<div style="width:67%;"><div class="padd"><a href="/admin/category/list/{$cur.id}/" title="Перейти в этот раздел">{$cur.name}</a></div></div>

							<div style="width:15%;"><div class="padd">
								<input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')" />
							</div></div>


							<div style="width:15%;"><div class="padd">
								<a href="/admin/category/add/{$id_category}/edit/{$cur.id}/"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>&nbsp;&nbsp;
								<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$id_category}', '{$cur.id}');" onmouseover="this.style.cursor='pointer';"/>
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
		<td style="text-align:right;"><a class="add" href="/admin/category/add/{$id_category}/">Добавить</a></td>
	</tr>


	

</table>
</form>->
