{capture name="content"}
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
        {foreach from=$data_contacts item=cur name=loop}
            <div class="container-contact">
                <div class="container-contact_description">
                    {if $cur.address}
                    <div class="container-contact_item">
                        <span><i class="fa fa-home"></i></span>{$cur.address}
                    </div>
                    {/if}
                    {if $cur.phone}
                    <div class="container-contact_item">
                        <span><i class="fa fa-phone"></i></span>{$cur.phone}
                    </div>
                    {/if}
                </div>
                <div class="container-contact_map">
                    {literal}
                        <script type="text/javascript">
                        ymaps.ready(init); // Как только будет загружен API и готов DOM, выполняем инициализацию
                        function init () {
                            var myMap = new ymaps.Map('map_{/literal}{$smarty.foreach.loop.iteration}{literal}', {
                            // При инициализации карты, обязательно нужно указать ее центр и коэффициент масштабирования
                            center: [{/literal}{if $cur.latitude && $cur.longitude}{$cur.latitude}, {$cur.longitude}{else}53.199449, 45.020121{/if}{literal}], // Метка
//							center: [53.199449, 45.020121], // Пенза
                            zoom: 15
                        });
                        myMap.controls   
                        myPlacemark = new ymaps.Placemark([{/literal}{if $cur.latitude && $cur.longitude}{$cur.latitude}, {$cur.longitude}{else}53.199449, 45.020121{/if}{literal}], 
                                                    {balloonContentBody: '{/literal}{$cur.name_on_map}{literal}'}

                            );

                            myMap.geoObjects.add(myPlacemark);
                            //myPlacemark.balloon.open();  // открыть сразу балун

                    }
                    </script>
                {/literal}   
                <div id="map_{$smarty.foreach.loop.iteration}" class="map" style="width:458px; height:300px;"></div>
            </div>
            <div class="clear"></div>
        </div>  
        {/foreach}
    </div>
{/capture}


{include file="common/base_page.tpl"}