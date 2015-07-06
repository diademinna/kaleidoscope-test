{capture name="content"}

	{literal}
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init); // Как только будет загружен API и готов DOM, выполняем инициализацию

        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с заданным id ("map")
            var myMap = new ymaps.Map('map', {
                // При инициализации карты, обязательно нужно указать ее центр и коэффициент масштабирования
                center: [{/literal}{if $data_contacts.latitude && $data_contacts.longitude}{$data_contacts.latitude}, {$data_contacts.longitude}{else}53.199449, 45.020121{/if}{literal}], // Метка
//                center: [53.199449, 45.020121], // Пенза
                zoom: 15
            });

		
            // Для добавления элемента управления на карту используется поле controls, ссылающееся на коллекцию элементов управления картой.  Добавление элемента в коллекцию производится с помощью метода add().
            // В метод add можно передать строковый идентификатор элемента управления и его параметры.
            myMap.controls                
                .add('zoomControl') // Кнопка изменения масштаба
                .add('typeSelector') // Список типов карты
                .add('smallZoomControl', { right: 5, top: 75 }) // Кнопка изменения масштаба - компактный вариант.
                .add('mapTools') // Стандартный набор кнопок

            // Также в метод add можно передать экземпляр класса, реализующего определенный элемент управления.
            // Например, линейка масштаба ('scaleLine')
            myMap.controls.add(new ymaps.control.ScaleLine())
           		
			
			myPlacemark = new ymaps.Placemark([{/literal}{if $data_contacts.latitude && $data_contacts.longitude}{$data_contacts.latitude}, {$data_contacts.longitude}{else}53.199449, 45.020121{/if}{literal}], 
				{balloonContentBody: '{/literal}{$data_contacts.name_on_map|escape:'quotes'}{literal}'}
				
			);
				
//			myPlacemark.options.set({
//				iconImageHref: '/img/map_ico.png',
//				iconImageSize: [60, 94],
//				iconImageOffset: [-29, -94]
//			});
				
			myMap.geoObjects.add(myPlacemark);
			myPlacemark.balloon.open();  // открыть сразу балун
			
        }
    </script>
	{/literal}


	<h1>{$data_contacts.name}</h1>
	
	<div class="user_content">
		{$data_contacts.description}
	</div>
	
	<div id="map" style="width:500px;height:400px;"></div>
	
{/capture}


{include file="common/base_page.tpl"}