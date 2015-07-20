Поступил заказ с сайта<br/><br/>

Логин покупателя: {$tdata.login}<br/><br />
Имя покупателя: {$tdata.name}<br/><br />
Контактный телефон: {$tdata.phone}<br/><br />
Комментарий: {$tdata.text}<br/><br />
Город: {$tdata.city}<br/><br />
Товары:<br/>
{foreach from=$tdata.products item=cur}
    Название продукта: {$cur.name_product}<br/>
    Количество: {$cur.count}<br/>
    Цена за 1 шт: {$cur.price} руб.<br /> <br />
{/foreach}
