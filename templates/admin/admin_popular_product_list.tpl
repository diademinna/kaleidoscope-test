{capture name="content_name"}
	Популярные продукты
{/capture}

{capture name="content"}

{if !$data}
   товаров нет
{else} 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Просмотры</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$data item=cur name=loop}
                                <tr>
                                    <td>{$cur.name}</td>
                                    <td>{$cur.views}</td>
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