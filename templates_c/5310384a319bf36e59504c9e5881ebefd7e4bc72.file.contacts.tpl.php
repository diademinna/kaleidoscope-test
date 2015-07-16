<?php /* Smarty version Smarty3-b7, created on 2015-07-15 23:16:44
         compiled from ".\templates\contacts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:504855a6bfac591689-51710889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5310384a319bf36e59504c9e5881ebefd7e4bc72' => 
    array (
      0 => '.\\templates\\contacts.tpl',
      1 => 1436883053,
    ),
  ),
  'nocache_hash' => '504855a6bfac591689-51710889',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Контакты
    </div>
    <br/>
</div>
<div class="container-contacts">
    <div class="container-contacts__title">Контакты</div>
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_contacts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
            <div class="container-contact">
                <div class="container-contact_description">
                    <?php if ($_smarty_tpl->getVariable('cur')->value['address']){?>
                    <div class="container-contact_item">
                        <span><i class="fa fa-home"></i></span><?php echo $_smarty_tpl->getVariable('cur')->value['address'];?>

                    </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->getVariable('cur')->value['phone']){?>
                    <div class="container-contact_item">
                        <span><i class="fa fa-phone"></i></span><?php echo $_smarty_tpl->getVariable('cur')->value['phone'];?>

                    </div>
                    <?php }?>
                </div>
                <div class="container-contact_map">
                    
                        <script type="text/javascript">
                        ymaps.ready(init); // Как только будет загружен API и готов DOM, выполняем инициализацию
                        function init () {
                            var myMap = new ymaps.Map('map_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration'];?>
', {
                            // При инициализации карты, обязательно нужно указать ее центр и коэффициент масштабирования
                            center: [<?php if ($_smarty_tpl->getVariable('cur')->value['latitude']&&$_smarty_tpl->getVariable('cur')->value['longitude']){?><?php echo $_smarty_tpl->getVariable('cur')->value['latitude'];?>
, <?php echo $_smarty_tpl->getVariable('cur')->value['longitude'];?>
<?php }else{ ?>53.199449, 45.020121<?php }?>], // Метка
//							center: [53.199449, 45.020121], // Пенза
                            zoom: 15
                        });
                        myMap.controls   
                        myPlacemark = new ymaps.Placemark([<?php if ($_smarty_tpl->getVariable('cur')->value['latitude']&&$_smarty_tpl->getVariable('cur')->value['longitude']){?><?php echo $_smarty_tpl->getVariable('cur')->value['latitude'];?>
, <?php echo $_smarty_tpl->getVariable('cur')->value['longitude'];?>
<?php }else{ ?>53.199449, 45.020121<?php }?>], 
                                                    {balloonContentBody: '<?php echo $_smarty_tpl->getVariable('cur')->value['name_on_map'];?>
'}

                            );

                            myMap.geoObjects.add(myPlacemark);
                            //myPlacemark.balloon.open();  // открыть сразу балун

                    }
                    </script>
                   
                <div id="map_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration'];?>
" class="map" style="width:458px; height:300px;"></div>
            </div>
            <div class="clear"></div>
        </div>  
        <?php }} ?>
    </div>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>


<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
