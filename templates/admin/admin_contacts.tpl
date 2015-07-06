{capture name="content_name"}
	Редактировать - Контакты
{/capture}

{capture name="content"}

	<!--
        Подключаем API карт 2.x
        Параметры:
          - load=package.full - полная сборка;
	      - lang=ru-RU - язык русский.
    -->
	{literal}
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>

    
    <script type="text/javascript">
        // Как только будет загружен API и готов DOM, выполняем инициализацию
        ymaps.ready(init);

        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с заданным id ("map")
            var myMap = new ymaps.Map('map', {
                // При инициализации карты, обязательно нужно указать
                // ее центр и коэффициент масштабирования
				center: [{/literal}{if $data.latitude && $data.longitude}{$data.latitude}, {$data.longitude}{else}53.199449, 45.020121{/if}{literal}], // Метка
                //center: [53.199449, 45.020121], // Пенза
                zoom: 13
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
            
           
            myPlacemark = new ymaps.Placemark([{/literal}{if $data.latitude && $data.longitude}{$data.latitude}, {$data.longitude}{else}53.199449, 45.020121{/if}{literal}], {
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
{/literal}



	<form action="" method="post" enctype="multipart/form-data">
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
		
			<tr>
				<td>Название:</td>
				<td><textarea type="text" name="name">{$data.name}</textarea></td>
			</tr>	
			
			<tr>
				<td>Описание:</td>
				<td><textarea name="description" class="tiny content">{$data.description}</textarea></td>
			</tr>
			
			<tr>
				<td>Расположение на карте:</td>
				<td>
					<div id="map"></div>
				</td>
			</tr>
			
			<tr>
				<td>Текст в <br />сплывающей подсказке<br />на карте:</td>
				<td>
					<textarea type="text" name="name_on_map" class="tiny">{$data.name_on_map}</textarea>
				</td>
			</tr>
						
			<tr>
				<td>Тайтл:</td>
				<td><textarea name="title">{$data.title}</textarea></td>
			</tr>
			
			<tr>
				<td></td>
				<td>				
					<input type="hidden" name="submitted" value="1" />
					<input type="hidden" id="latitude" name="latitude" value="{$data.latitude}" />
					<input type="hidden" id="longitude" name="longitude" value="{$data.longitude}" />
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
{/capture}

{include file="admin/common/base_page.tpl"}