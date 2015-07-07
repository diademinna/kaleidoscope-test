<?php /* Smarty version Smarty3-b7, created on 2015-07-07 11:35:11
         compiled from ".\templates\category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13390559a64b56a0365-08518279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b8d5e7c56e6e5abaed147561ae75e91b2c83948' => 
    array (
      0 => '.\\templates\\category.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '13390559a64b56a0365-08518279',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.truncate.php';
if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
?><?php ob_start(); ?>

<script>
    function SortFunction(action_val, page, id_category)
    {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/sort_product/",
            async: true,
            data:{
                action_val:action_val,
                page:page,
                id_category:id_category,
                min_price:$( "#contentSlider1" ).text(),
                max_price:$( "#contentSlider2" ).text()
            },
            success: function(data){
                $("#sort_products").html(data.data_ajax_sort_products);
                xajax_SetSort(action_val);
            }
        });
    }
</script>
<script type="text/javascript" src="/js/ui/jquery-ui.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
  $( "#slider" ).slider({
        range:true,
        values : [<?php if ($_smarty_tpl->getVariable('cur_min_price')->value){?><?php echo $_smarty_tpl->getVariable('cur_min_price')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('min_price')->value;?>
<?php }?>,<?php if ($_smarty_tpl->getVariable('cur_max_price')->value){?><?php echo $_smarty_tpl->getVariable('cur_max_price')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('max_price')->value;?>
<?php }?>],//Значение, которое будет выставлено слайдеру при загрузке
        min : <?php echo $_smarty_tpl->getVariable('min_price')->value;?>
,//Минимально возможное значение на ползунке
        max : <?php echo $_smarty_tpl->getVariable('max_price')->value;?>
,//Максимально возможное значение на ползунке
        step : 100,//Шаг, с которым будет двигаться ползунок
        create: function( event, ui ) {
        $( "#contentSlider1" ).html($("#slider").slider("values", 0));
        $( "#contentSlider2" ).html($("#slider").slider("values", 1));
       },
       slide: function( event, ui ) {
            $( "#contentSlider1" ).html( ui.values[0]);
            $( "#contentSlider2" ).html( ui.values[1]);
        },
        stop: function(event, ui){
            var min_price = $( "#contentSlider1" ).text();
            var max_price = $( "#contentSlider2" ).text();
            var id_category = <?php echo $_smarty_tpl->getVariable('id_category')->value;?>
;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/filtr_price_product/",
                async: true,
                data:{
                    min_price:min_price,
                    max_price:max_price,
                    id_category:id_category
                },
                success: function(data){
                    $("#sort_products").html(data.data_ajax_sort_products);
                }
            });
            if (!id_category){
                history.pushState(null, null, '/category/?min_price='+min_price+"&max_price="+max_price);
            }
            else
            {
                history.pushState(null, null, '/category/'+id_category+'/?min_price='+min_price+"&max_price="+max_price);
            }
           // location.reload();
        }
        });
});
</script> 

<div class="container-width_300px">
    <div class="container_margin_top">
        <div class="container-catalog">
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_catalog')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
            <div class="container-catalog_item">
                <a class="container-catalog_link<?php if ($_smarty_tpl->getVariable('cur')->value['id']==$_smarty_tpl->getVariable('id_category')->value){?> active<?php }?>" href="/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a> 
                <?php if ($_smarty_tpl->getVariable('cur')->value['subcatalog1']){?>
                <div class="container-subcategory">
                    <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcatalog1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                        <a class="container-subcatalog1_link<?php if ($_smarty_tpl->getVariable('cur2')->value['id']==$_smarty_tpl->getVariable('id_category')->value){?> active<?php }?>" href="/category/<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</a>
                    <?php }} ?>
                </div>
                <?php }?>
            </div>
        <?php }} ?>
        </div>
    </div>
    <div class='title-block bgr-orange'>фильтр</div>   
    <div class='container-filtr'>
        <div class='container_filtr_name'>Какая цена?</div>
        <div class="polzunok">
            от <span id="contentSlider1"></span> до <span id="contentSlider2" ></span>
            <div id="slider"></div>
            <div class="polzunok-min_price"><?php echo $_smarty_tpl->getVariable('min_price')->value;?>
</div>
            <div class="polzunok-max_price"><?php echo $_smarty_tpl->getVariable('max_price')->value;?>
</div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="container-width_670px margin-left">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>
        <?php if ($_smarty_tpl->getVariable('mass_navigation')->value){?>
            <a href="/category/">Каталог</a>
            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mass_navigation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur']->total=count($_from);
 $_smarty_tpl->tpl_vars['cur']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['total'] = $_smarty_tpl->tpl_vars['cur']->total;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['cur']->iteration++;
 $_smarty_tpl->tpl_vars['cur']->last = $_smarty_tpl->tpl_vars['cur']->iteration === $_smarty_tpl->tpl_vars['cur']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['last'] = $_smarty_tpl->tpl_vars['cur']->last;
?>
                <i class="fa fa-chevron-right"></i>
                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['last']){?>
                    <?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>

                <?php }else{ ?>
                    <a href="/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                <?php }?>
            <?php }} ?>
        <?php }else{ ?>
            Каталог
        <?php }?>
    </div>
    <h1><?php echo $_smarty_tpl->getVariable('data_category')->value['name'];?>
</h1>
    <div class="category-description"><?php echo $_smarty_tpl->getVariable('data_category')->value['text'];?>
</div>
    <div class="sort">
        Сортировать по: 
        <select class="form-control" onchange="SortFunction(this.value, <?php echo $_smarty_tpl->getVariable('page')->value;?>
, <?php echo $_smarty_tpl->getVariable('id_category')->value;?>
);">
            <option value="0"<?php if (!$_smarty_tpl->getVariable('val_sort_order')->value){?> selected="selected"<?php }?>>не указано</option>
            <option value="1"<?php if ($_smarty_tpl->getVariable('val_sort_order')->value=='1'){?> selected="selected"<?php }?>>Цене: по возрастанию</option>
            <option value="2"<?php if ($_smarty_tpl->getVariable('val_sort_order')->value=='2'){?> selected="selected"<?php }?>>Цене: по убыванию</option>
            <option value="3"<?php if ($_smarty_tpl->getVariable('val_sort_order')->value=='3'){?> selected="selected"<?php }?>>Названию: по возрастанию</option>
            <option value="4"<?php if ($_smarty_tpl->getVariable('val_sort_order')->value=='4'){?> selected="selected"<?php }?>>Названию: по убыванию</option>
        </select>
    </div>
    <div id="sort_products">
        <?php $_template = new Smarty_Internal_Template("rebuild/products.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    </div>
</div>
<div class="clear"></div>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
