{capture name="content_name"}
	Все категории
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(id_category, id){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/category/list/"+id_category+"/delete/"+id+"/";
			}
		}

		function delRecordProduct(id_category, id){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/product/list/"+id_category+"/delete/"+id+"/";
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

	{if $data_category}

            {include file="admin/admin_category_block.tpl"}

	{elseif !$data_category}
        {if $id_category==0}
            <div class="ibox-content ibox-heading">
                    <h3 style="">В каталоге нет ни одной категории!</h3>
            </div>
        {/if}
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/category/add/{$id_category}/">
                <i class="fa fa-plus"></i>	Добавить категорию</a>
            </div>
        </div>

	{/if}


{/capture}

{include file="admin/common/base_page.tpl"}
