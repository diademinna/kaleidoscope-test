<?php /* Smarty version Smarty3-b7, created on 2015-07-06 17:00:30
         compiled from ".\templates\admin/admin_orders_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15354559a89fe870db7-52654804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2378235d7eb9da3178f29d278e835e15ae75ccf3' => 
    array (
      0 => '.\\templates\\admin/admin_orders_list.tpl',
      1 => 1436131925,
    ),
  ),
  'nocache_hash' => '15354559a89fe870db7-52654804',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
if (!is_callable('smarty_function_math')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\function.math.php';
?><?php ob_start(); ?>
	Заказы
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/order/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
                $(document).ready(function(){
                    $('.fa.fa-info').click(function(){
                        var pr = $(this).parent().parent().next().css('display');
                        if (pr == 'none')
                            $(this).parent().parent().next().show();
                        else
                            $(this).parent().parent().next().hide();
                    });
                });
	</script>
<?php if (!$_smarty_tpl->getVariable('data')->value){?>
    <div class="ibox-content ibox-heading">
            <h3 style="">Пока что не поступило ни одного заказа!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    
</div>
<?php }else{ ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                <div class="col-xs-2">
                    Выводить по :
                </div>    
                <div class="col-xs-3">

                    <select class="form-control m-b" name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');">
                        <?php $_template = new Smarty_Internal_Template("admin/common/select_count_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

                    </select>	
                </div>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Дата заказа</th>
                            <th>Город</th>
                            <th>ФИО</th>
                            <th>Общая сумма заказа</th>
                            <th>Комментарий</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <tr>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%d-%m-%Y");?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%H:%M:%S");?>
</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['city'];?>
</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('cur')->value['last_name'];?>
</td>
                            <td><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['total_summa']);?>
 руб.</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['text'];?>
</td>
                            <td style="font-size:18px;">
                                <i style="cursor: pointer;" title="Полная информация" alt="Полная информация" class="fa fa-info"></i>
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('page')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
', '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');" onmouseover="this.style.cursor='pointer';"></i></td>
                        </tr>
                        <tr class="more_info" style="display: none;">
                            <td colspan="5">
                                <table style="border-collapse: separate;border-spacing: 15px 5px;">
                                    <tr>
                                        <td>Имя : </td>
                                        <td style='font-weight: bold;'><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('cur')->value['last_name'];?>
</td>
                                        <td>Название компании : </td>
                                        <td style='font-weight: bold;'><?php echo $_smarty_tpl->getVariable('cur')->value['name_company'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td style='font-weight: bold;'><?php echo $_smarty_tpl->getVariable('cur')->value['login'];?>
</td>
                                        <td>Телефон : </td>
                                        <td style='font-weight: bold;'><i style="color:#93c567;" class="fa fa-phone"></i> <?php echo $_smarty_tpl->getVariable('cur')->value['phone'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Город : </td>
                                        <td style='font-weight: bold;'><?php echo $_smarty_tpl->getVariable('cur')->value['city'];?>
</td>
                                        <td>Адрес : </td>
                                        <td style='font-weight: bold;'><?php echo $_smarty_tpl->getVariable('cur')->value['address'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Информация по заказу:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table width='100%;'>
                                                <tr>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Название</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Изображение</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Количество</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">за 1 шт</td>
                                                    <td style="border:1px solid #cccccc;padding:0 5px;">Всего</td>
                                                </tr>
                                                <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                                    <tr>
                                                        <td style="border:1px solid #cccccc;padding:0 5px;"><a title='перейти на страницу товара' target="_blank" href='/product/<?php echo $_smarty_tpl->getVariable('cur2')->value['id_product'];?>
/'><?php echo $_smarty_tpl->getVariable('cur2')->value['name_product'];?>
</a></td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><img height='40px' src='/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur2')->value['id_product'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur2')->value['img_ext'];?>
' /></td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><?php echo $_smarty_tpl->getVariable('cur2')->value['count'];?>
</td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur2')->value['price_product']);?>
 руб.</td>
                                                        <td style="border:1px solid #cccccc; text-align: center;padding:0 5px;"><?php echo smarty_function_math(array('assign'=>"price_count",'equation'=>"x*y",'x'=>$_smarty_tpl->getVariable('cur2')->value['price_product'],'y'=>$_smarty_tpl->getVariable('cur2')->value['count']),$_smarty_tpl->smarty,$_smarty_tpl);?><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('price_count')->value);?>
 руб.</td>
                                                    </tr>
                                                <?php }} ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php }} ?>
                    
                </table>
            </div> 
        </div>
        <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?> 
    </div>
<?php }?>
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
