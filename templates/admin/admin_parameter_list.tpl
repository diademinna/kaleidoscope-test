{capture name="content_name"}
	Параметры для категорий
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(id_parameter, id){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/parameter/list/"+id_parameter+"/delete/"+id+"/";
			}
		}


		$(function(){
			$("#sortable").sortable({
				opacity:0.8, revert:true, axis:'y'
			});
			$("#sortable_product").sortable({
				opacity:0.8, revert:true, axis:'y'
			});
		});
		$(document).ready(function(){
			$("#sortable").sortable({
				  update : function(){
					var mass_sort = $('#sortable').sortable('toArray');
					xajax_Sort(mass_sort, $('#min_pos').val());
				  }
			});
			$("#sortable_product").sortable({
				  update : function(){
					var mass_sort = $('#sortable_product').sortable('toArray');
					xajax_SortProduct(mass_sort, $('#min_pos_product').val());
				  }
			});


			// при выборе чекбокса для переноса
			$('.choose input').click(function(){
				if($(this).prop("checked")){
					$(this).parent().parent().parent().addClass("choose_active");
				}
				else{
					$(this).parent().parent().parent().removeClass("choose_active");
				}
			});


			// КЛИК выбрать все товары
			$(".select_all_checkbox_choose").click(function() {
				$(".choose").find('input:checkbox').attr('checked', 'checked');
				$('.sort_list li').addClass("choose_active");
				return false;
			});
			// КЛИК снять выделение с товаров
			$(".unselect_all_checkbox_choose").click(function() {
				$(".choose").find('input:checkbox').removeAttr('checked');
				$('.sort_list li').removeClass("choose_active");
				return false;
			});


		});
	</script>

    {if $data_parameter}

        <form action="" method="post" id="forma_parameter" enctype="multipart/form-data">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-xs-3">
                            <a class="btn btn-block btn-primary compose-mail" href="/admin/parameter/add/{$id_parameter}/">
                            <i class="fa fa-plus"></i> Добавить параметр</a>
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
                                {foreach from=$data_parameter item=cur name=loop}
                                    <tr id="item_{$cur.id}">
                                        <td>
                                            {if !$level}
                                            <a href="/admin/parameter/list/{$cur.id}/" title="Перейти в этот раздел">{$cur.name}</a>
                                            {else}
                                                {$cur.name}
                                            {/if}
                                        </td>
                                        <td style="font-size:18px;">
                                            <a href="/admin/parameter/add/{$id_parameter}/edit/{$cur.id}/">
                                                <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('{$id_parameter}', '{$cur.id}');" onmouseover="this.style.cursor='pointer';"></i>
                                        </td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
	{elseif !$data_parameter}
        {if $id_parameter==0}
            <div class="ibox-content ibox-heading">
                    <h3 style="">Параметры не добавлены!</h3>
            </div>
        {/if}
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/parameter/add/{$id_parameter}/">
                <i class="fa fa-plus"></i>	Добавить параметр</a>
            </div>
        </div>

	{/if}


{/capture}

{include file="admin/common/base_page.tpl"}
