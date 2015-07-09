{capture name="content_name"}
	Параметры для категорий / {if $data.name}Редактировать - {$data.name}{else}Добавить{/if}
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
       {if $parent_id}
        <div class="form-group">
            <label class="col-sm-2 control-label">Изображение (превью) <br /> 25 х 25:</label>
            <div class="col-sm-10">
                <input  type="file" name="image" />
                <br /><br />
                <div id="photo">
                    {if $data.ext}
                        <a href="/uploaded/parameter/{$data.id}_sm.{$data.ext}" target="_blank"><img src="/uploaded/parameter/{$data.id}_sm.{$data.ext}" class="photo" /></a>
                        &nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"></i>
                            <input type="hidden" name="ext" value="{$data.ext}" />
                    {/if}
                </div>
            </div>
        </div>
        {/if}
        <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                        <input type="hidden" name="submitted" value="1" />
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
        </div>
    </form>
</div>

{/capture}

{include file="admin/common/base_page.tpl"}
