{capture name="content_name"}
	Каталог / {if $data.name}Редактировать - {$data.name}{else}Добавить категорию{/if}
{/capture}


{capture name="content"}
<div class="ibox-title">
	<h5>Форма для добавления категории</h5>
</div>
<div class="ibox-content">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		{include file="common/errors_block.tpl"}
		<div class="form-group">
			<label class="col-sm-2 control-label">Название* :</label>
			<div class="col-sm-10">
				<input name="name" class="form-control" type="text" value="{$data.name}" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Контент <br />(если необходим):</label>
			<div class="col-sm-10">
				<textarea name="text" class="tiny" type="text">{$data.text}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Изображение (превью):</label>
			<div class="col-sm-10">
				<input  type="file" name="image" />

				<br /><br />
				<div id="photo">
					{if $data.ext}
						<a href="/uploaded/category/{$data.id}_sm.{$data.ext}" target="_blank"><img src="/uploaded/category/{$data.id}_sm.{$data.ext}" class="photo" /></a>
						&nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"></i>
						<input type="hidden" name="ext" value="{$data.ext}" />
					{/if}
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Тайтл:</label>
			<div class="col-sm-10">
				<input name="title" class="form-control" type="text" value="{$data.title}" />
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
