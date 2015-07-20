{capture name="content_name"}
	Отзывы
{/capture}

{capture name="content"}

<script type="text/javascript">
    function delRecord(page, id, get_param){
        if(confirm("Вы уверены?")){
            top.window.location = "/admin/review/list/"+page+"/delete/"+id+"/"+get_param;
        }
    }
</script>
{if !$data}
    <div class="ibox-content ibox-heading">
        <h3 style="">Еще не добавлено ни одного отзыва!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/review/add/">
        <i class="fa fa-plus"></i>	Добавить отзыв</a>
    </div>
</div>
{else} 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-xs-3">
                        <a class="btn btn-block btn-primary compose-mail" href="/admin/review/add/{if $get_param}{$get_param}{/if}">
                        <i class="fa fa-plus"></i> Добавить отзыв</a>
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
                                <th>ФИО</th>
                                <th>Дата</th>
                                <th>Отзыв</th>
                                <th>На сайте</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$data item=cur name=loop}
                                <tr>
                                    <td>{$cur.fio}</td>
                                    <td>{$cur.date|date_format:"%d.%m.%Y"}</td>
                                     <td>{$cur.text}</td>
                                    <td>
                                        <div class="checkbox">
                                            <input id="male{$cur.id}" type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')">
                                            <label class="label_checkbox" for="male{$cur.id}"></label>
                                        </div>
                                    </td>
                                    <td style="font-size:18px;">
                                        <a href="/admin/review/add/{$page}/edit/{$cur.id}/"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                        <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"></i>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
            {if $pager_string}<div class="pager">{$pager_string}</div>{/if}  
        </div>
    </form>
{/if}
	
{/capture}

{include file="admin/common/base_page.tpl"}