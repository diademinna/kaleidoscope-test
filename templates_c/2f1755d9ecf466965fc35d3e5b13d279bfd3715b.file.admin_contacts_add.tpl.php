<?php /* Smarty version Smarty3-b7, created on 2015-07-14 16:16:03
         compiled from ".\templates\admin/admin_contacts_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1312555a50b937b5349-24286519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f1755d9ecf466965fc35d3e5b13d279bfd3715b' => 
    array (
      0 => '.\\templates\\admin/admin_contacts_add.tpl',
      1 => 1436879761,
    ),
  ),
  'nocache_hash' => '1312555a50b937b5349-24286519',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Редактировать - Контакты
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>

    
    <script type="text/javascript">
        // Как только будет загружен API и готов DOM, выполняем инициализацию
        ymaps.ready(init);

        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с заданным id ("map")
            var myMap = new ymaps.Map('map', {
                // При инициализации карты, обязательно нужно указать
                // ее центр и коэффициент масштабирования
				center: [<?php if ($_smarty_tpl->getVariable('data')->value['latitude']&&$_smarty_tpl->getVariable('data')->value['longitude']){?><?php echo $_smarty_tpl->getVariable('data')->value['latitude'];?>
, <?php echo $_smarty_tpl->getVariable('data')->value['longitude'];?>
<?php }else{ ?>53.199449, 45.020121<?php }?>], // Метка
                //center: [53.199449, 45.020121], // Пенза
                zoom: 16
            });
            
            
            // Для добавления элемента управления на карту
            // используется поле controls, ссылающееся на
            // коллекцию элементов управления картой.
            // Добавление элемента в коллекцию производится
            // с помощью метода add().

            // В метод add можно передать строковый идентификатор
            // элемента управления и его параметры.
            myMap.controls                
                .add('zoomControl') // Кнопка изменения масштаба                
                .add('typeSelector') // Список типов карты
                .add('smallZoomControl', { right: 5, top: 75 }) // Кнопка изменения масштаба - компактный вариант.  Расположим её справа                
                .add('mapTools') // Стандартный набор кнопок
				.add(new ymaps.control.SearchControl({noPlacemark : 'true'})); // Строка поиска, по завершении поиска не создавать метку
					
            // Также в метод add можно передать экземпляр класса, реализующего определенный элемент управления.
            // Например, линейка масштаба ('scaleLine')
            myMap.controls.add(new ymaps.control.ScaleLine())
            
           
            myPlacemark = new ymaps.Placemark([<?php if ($_smarty_tpl->getVariable('data')->value['latitude']&&$_smarty_tpl->getVariable('data')->value['longitude']){?><?php echo $_smarty_tpl->getVariable('data')->value['latitude'];?>
, <?php echo $_smarty_tpl->getVariable('data')->value['longitude'];?>
<?php }else{ ?>53.199449, 45.020121<?php }?>], {
                    hintContent: 'Подвинь меня!'
                }, {
                    draggable: true // Метку можно перетаскивать, зажав левую кнопку мыши.
                });
            myMap.geoObjects.add(myPlacemark);
            
			// Перетаскивание метки мышкой, занесение координат
	       myPlacemark.events.add("dragend", function (result) {
			    var coordinates =  this.geometry.getCoordinates();
			    var x = this.geometry.getCoordinates()[0];
			    var y = this.geometry.getCoordinates()[1];  
			    $('#latitude').val(x);
			    $('#longitude').val(y);
		   },myPlacemark);
			   
			   
		   // При клике по карте переместить туда метку, занести координаты
		   myMap.events.add("click", function(e) {
			    myPlacemark.geometry.setCoordinates(e.get("coordPosition"));
			    var x = myPlacemark.geometry.getCoordinates()[0];
			    var y = myPlacemark.geometry.getCoordinates()[1];  
			    $('#latitude').val(x);
			    $('#longitude').val(y);
		   });
        }
    </script>

<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <div class="form-group">
            <label class="col-sm-2 control-label">Название <br />местоположения* :</label>
            <div class="col-sm-10">
                <input name="name_place" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['name_place'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Адрес:</label>
            <div class="col-sm-10">
                <input name="address" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['address'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Телефон:</label>
            <div class="col-sm-10">
                <input name="phone" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['phone'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Расположение на карте:</label>
            <div class="col-sm-10">
                <div id="map" style="width:600px;height:500px;"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2"> 		
                <input type="hidden" name="submitted" value="1" />
                <input type="hidden" id="latitude" name="latitude" value="<?php echo $_smarty_tpl->getVariable('data')->value['latitude'];?>
" />
                <input type="hidden" id="longitude" name="longitude" value="<?php echo $_smarty_tpl->getVariable('data')->value['longitude'];?>
" />
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
</div>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
