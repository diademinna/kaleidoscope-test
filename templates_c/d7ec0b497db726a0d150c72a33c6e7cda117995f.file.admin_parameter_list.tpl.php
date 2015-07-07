<?php /* Smarty version Smarty3-b7, created on 2015-07-07 15:37:42
         compiled from ".\templates\admin/admin_parameter_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4978559bc816ce1648-25914724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7ec0b497db726a0d150c72a33c6e7cda117995f' => 
    array (
      0 => '.\\templates\\admin/admin_parameter_list.tpl',
      1 => 1436272661,
    ),
  ),
  'nocache_hash' => '4978559bc816ce1648-25914724',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Параметры для категорий
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

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

    <?php if ($_smarty_tpl->getVariable('data_parameter')->value){?>

        <form action="" method="post" id="forma_parameter" enctype="multipart/form-data">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-xs-3">
                            <a class="btn btn-block btn-primary compose-mail" href="/admin/parameter/add/<?php echo $_smarty_tpl->getVariable('id_parameter')->value;?>
/">
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
                                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_parameter')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                    <tr id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                                        <td>
                                            <?php if (!$_smarty_tpl->getVariable('level')->value){?>
                                            <a href="/admin/parameter/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/" title="Перейти в этот раздел"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                                            <?php }else{ ?>
                                                <?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>

                                            <?php }?>
                                        </td>
                                        <td style="font-size:18px;">
                                            <a href="/admin/parameter/add/<?php echo $_smarty_tpl->getVariable('id_parameter')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">
                                                <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('id_parameter')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
');" onmouseover="this.style.cursor='pointer';"></i>
                                        </td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
	<?php }elseif(!$_smarty_tpl->getVariable('data_parameter')->value){?>
        <?php if ($_smarty_tpl->getVariable('id_parameter')->value==0){?>
            <div class="ibox-content ibox-heading">
                    <h3 style="">Параметры не добавлены!</h3>
            </div>
        <?php }?>
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/parameter/add/<?php echo $_smarty_tpl->getVariable('id_parameter')->value;?>
/">
                <i class="fa fa-plus"></i>	Добавить параметр</a>
            </div>
        </div>

	<?php }?>


<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

