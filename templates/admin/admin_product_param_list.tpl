{capture name="content_name"}
	Параметры
{/capture}

{capture name="content"}

    <script type="text/javascript">
        function delRecord(id_product_param, id){
                if(confirm("Вы уверены?")) {
                        top.window.location = "/admin/product_param/list/"+id_product_param+"/delete/"+id+"/";
                }
        }
    </script>

    {if $data_product_param}

        <form action="" method="post" id="forma_product_param" enctype="multipart/form-data">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-xs-3">
                            <a class="btn btn-block btn-primary compose-mail" href="/admin/product_param/add/{$id_product_param}/">
                            <i class="fa fa-plus"></i> Добавить {if $level} параметр {else}группу параметров{/if}</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                            {foreach from=$data_product_param item=cur name=loop}
                                <tr id="item_{$cur.id}">
                                    <td>
                                        {if !$level}
                                        <a href="/admin/product_param/list/{$cur.id}/" title="Перейти в этот раздел">{$cur.name}</a>
                                        {else}
                                            {$cur.name}
                                        {/if}
                                    </td>
                                    <td style="font-size:18px;">
                                        <a href="/admin/product_param/add/{$id_product_param}/edit/{$cur.id}/">
                                            <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                            <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$id_product_param}', '{$cur.id}');" onmouseover="this.style.cursor='pointer';"></i>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    {elseif !$data_product_param}
        {if $id_product_param==0}
            <div class="ibox-content ibox-heading">
                <h3 style="">Не добавлено ни одной группы параметров!</h3>
            </div>
        {/if}
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/product_param/add/{$id_product_param}/">
                {if $level}
                    <i class="fa fa-plus"></i>	Добавить параметр
                {else}
                    <i class="fa fa-plus"></i>	Добавить группу параметров
                {/if}
                </a>
            </div>
        </div>
    {/if}

{/capture}

{include file="admin/common/base_page.tpl"}
