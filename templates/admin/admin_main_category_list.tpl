{capture name="content_name"}
	Разделы на главной
{/capture}


{capture name="content"}
<div class="ibox-title">
	<h5>Укажите категории на главной странице</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal">
        {include file="common/errors_block.tpl"}
        <div class="form-group">
            <label class="col-sm-2 control-label">1 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat1">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "1"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "1"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">2 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat2">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "2"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "2"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">3 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat3">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "3"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "3"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">4 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat4">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "4"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "4"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">5 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat5">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "5"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "5"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">6 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat6">
                    <option value="0">--- Выберите ---</option>
                    {foreach from=$data_category item=cur}
                        {if $cur.main == "6"}
                            <option selected="selected" style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {else}
                            <option style="font-weight: 700;" value="{$cur.id}">{$cur.name}</option>
                        {/if}
                        {if $cur.subcategory}
                            {foreach from=$cur.subcategory item=cur2}
                                {if $cur2.main == "6"}
                                    <option selected="selected" value="{$cur2.id}">{$cur2.name}</option>
                                {else}
                                    <option value="{$cur2.id}">{$cur2.name}</option>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="submitted" value="1" />
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
</div>

	<!--<form action="" method="post" enctype="multipart/form-data">

		{include file="common/errors_block.tpl"}

		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>

			<tr>
				<td>Контент	<br />(если необходим):</td>
				<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
			</tr>

			<tr>
				<td>Изображение (превью)<br />(если необходимо):</td>
				<td>
					<input type="file" name="image" />
					<select name="type_resize">
						<option value="1">Обрезать края</option>
						<option value="2">Добавлять пустые поля</option>
					</select>

					<br /><br />
					<div id="photo">
						{if $data.ext}
							<a href="/uploaded/category/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/category/{$data.id}_sm.{$data.ext}" class="photo" /></a>
							&nbsp;<a href="" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
							<input type="hidden" name="ext" value="{$data.ext}" />
						{/if}
					</div>
				</td>
			</tr>

			<tr>
				<td>Тайтл <br />(если необходим):</td>
				<td><textarea name="title">{$data.title}</textarea></td>
			</tr>

			<tr>
				<td></td>
				<td>
					<input type="hidden" name="submitted" value="1" />
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
-->
{/capture}

{include file="admin/common/base_page.tpl"}
