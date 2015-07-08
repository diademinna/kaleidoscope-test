{capture name="content_name"}
	Товары / {if $data.name}Редактировать - {$data.name}{else}Добавить продукт{/if}
{/capture}


{capture name="content"}

<script>
    function ChangeCategory(id_category)
    {
         $.ajax({
            type: "POST",
            dataType: "json",
            url: "/admin_change_category/",
            async: true,
            data:{
                id_category:id_category
            },
            success: function(data){
                if (data.data_ajax_filtr)
                    $("#block-parameters").html(data.data_ajax_filtr);
            }
        });
    }
</script>
<div class="ibox-title">
	<h5>Форма для добавления / редактирования продукта</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {include file="common/errors_block.tpl"}
        <div class="errors_block id_category" style="color:#d70000; display: none;">
            <ul>
                <li>Не заполнено поле "Категория"</li>
            </ul>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Категория* :</label>
                <div class="col-sm-10">
                    <select class="form-control m-b" name="id_category" onchange="ChangeCategory(this.value);">
                        <option value="0">--- Выберите ---</option>
                        {foreach from=$data_category item=cur}
                            {if $cur.subcategory}
                                <optgroup label="{$cur.name}">
                                    {foreach from=$cur.subcategory item=cur2}
                                        <option {if $data.id_category == $cur2.id}selected="selected"{/if} value="{$cur2.id}">{$cur2.name}</option>
                                    {/foreach}
                                </optgroup>
                            {else}
                                <option {if $data.id_category == $cur.id}selected="selected"{/if} value="{$cur.id}">{$cur.name}</option>
                            {/if}
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Название* :</label>
                <div class="col-sm-10">
                    <input name="name" class="form-control" type="text" value="{$data.name}" />
                </div>
            </div>
            {if $data_filtr}
                <div class="form-group" id="block-parameters">
                    {include file="rebuild/admin_parameters.tpl"}
                </div>
            {/if}
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4"> 
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Цена* :</label>
                                    <div class="col-sm-6">
                                         <div class="input-group m-b">
                                            <input name="price" class="form-control" type="text" value="{$data.price}" />
                                            <span class="input-group-addon">руб.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5"> 
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Старая цена:</label>
                                    <div class="col-sm-6">
                                         <div class="input-group m-b">
                                            <input name="old_price" class="form-control" type="text" value="{$data.old_price}" />
                                            <span class="input-group-addon">руб.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <a href="/uploaded/product/{$data.id}_sm.{$data.ext}" target="_blank"><img src="/uploaded/product/{$data.id}_sm.{$data.ext}" class="photo" /></a>
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
<script>
    $(document).ready(function(){
        $('.errors_block.id_category').hide();
        if (!$('.form-group select[name="id_category"]').val() ||$('.form-group select[name="id_category"]').val()==0 )
        {
            $('.errors_block.id_category').show();
            return false;
        }
    });
    
</script>
	
{/capture}

{include file="admin/common/base_page.tpl"}
