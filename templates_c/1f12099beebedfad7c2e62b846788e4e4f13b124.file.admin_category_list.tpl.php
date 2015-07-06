<?php /* Smarty version Smarty3-b7, created on 2015-07-06 21:16:00
         compiled from ".\templates\admin/admin_category_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5420559ac5e020d236-62075305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f12099beebedfad7c2e62b846788e4e4f13b124' => 
    array (
      0 => '.\\templates\\admin/admin_category_list.tpl',
      1 => 1435173448,
    ),
  ),
  'nocache_hash' => '5420559ac5e020d236-62075305',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Все категории
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

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

	<?php if ($_smarty_tpl->getVariable('data_category')->value){?>

            <?php $_template = new Smarty_Internal_Template("admin/admin_category_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


	<?php }elseif(!$_smarty_tpl->getVariable('data_category')->value){?>
        <?php if ($_smarty_tpl->getVariable('id_category')->value==0){?>
            <div class="ibox-content ibox-heading">
                    <h3 style="">В каталоге нет ни одной категории!</h3>
            </div>
        <?php }?>
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/">
                <i class="fa fa-plus"></i>	Добавить категорию</a>
            </div>
        </div>

	<?php }?>


<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

