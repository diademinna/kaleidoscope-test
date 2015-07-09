<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>АДМИНКА</title>
	<link href="/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/css/admin/style.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>

	<!--  v1.11  -  для датапикера datepicker и sortable -->
	<link type="text/css" href="/js/ui/css/jquery-ui.css" rel="stylesheet" />
	<link type="text/css" href="/css/admin/font-awesome.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/js/ui/jquery-ui.min.js"></script>


	{$ajaxCode}

	{include file="common/tinymce.tpl"}

</head>

<body class="pace-done">
    <script>
    $(document).ready(function(){
            $("#side-menu li").click(function(){
                    if( $(this).attr("class") != "nav-header")
                    {
                            $("#side-menu li").removeClass('active');
                            $(this).addClass('active');
                    }
            });
    });
    </script>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul id="side-menu" class="nav metismenu">
                    <li class="nav-header" style="">
                        <div class="dropdown profile-element">
                            <span>
                                <img class="img-circle" src="/img/admin/admin.png" alt="image" />
                            </span>
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" style="" aria-expanded="false">
                                <span class="clear" >
                                    <span class="block m-t-xs">
                                            <strong class="font-bold">Администратор</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li{if $unit=="category"} class="active"{/if}>
                        <a href="/admin/category/list/">
                                <i class="fa fa-archive"></i>
                                <span class="nav-label">Все категории</span>
                        </a>
                    </li>
                    <li{if $unit=="main_category"} class="active"{/if}>
                        <a href="/admin/main_category/list/">
                            <i class="fa fa-star"></i>
                            <span class="nav-label">Категории на главной</span>
                        </a>
                    </li>
                    <li{if $unit=="product"} class="active"{/if}>
                        <a href="/admin/product/list/">
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-label">Товары</span>
                        </a>
                    </li>
                    <li{if $unit=="user"} class="active"{/if}>
                        <a href="/admin/user/list/">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Покупатели</span>
                        </a>
                    </li>
                    <li{if $unit=="orders"} class="active"{/if}>
                        <a href="/admin/orders/list/">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-label">Заказы</span>
                        </a>
                    </li>
                    <li{if $unit=="parameter"} class="active"{/if}>
                        <a href="/admin/parameter/list/">
                            <i class="fa fa-wrench"></i>
                            <span class="nav-label">Параметры для категорий</span>
                        </a>
                    </li>
                    <li{if $unit=="actions"} class="active"{/if}>
                        <a href="/admin/actions/list/">
                            <i class="fa fa-gift"></i>
                            <span class="nav-label">Акции</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg" >
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" style="margin-bottom: 0" role="navigation">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Добро пожаловать в раздел администрирования</span>
                        </li>
                        <li>
                            <a target="_blank" href="/">
                                    <i class="fa fa-sign-out"></i>На сайт
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{$smarty.capture.content_name}</h2>
                    {if $mass_navigation}
                        <ol class="breadcrumb">
                            {if $unit=='parameter'}
                                <li><a href="/admin/parameter/list/">Все параметры</a></li>
                            {else}
                                <li><a href="/admin/category/list/">Все категории</a></li>
                            {/if}
                            
                            {foreach from=$mass_navigation item=cur name=loop}
                                {if $smarty.foreach.loop.last}
                                    <li class="active">
                                        <strong>{$cur.name}</strong>
                                    </li>
                                {else}
                                    <li>
                                        {if $unit=='parameter'}
                                            <a href="/admin/parameter/list/{$cur.id}/">{$cur.name}</a>
                                        {else}
                                            <a href="/admin/category/list/{$cur.id}/">{$cur.name}</a>
                                        {/if}
                                    </li>
                                {/if}
                            {/foreach}
                        </ol>
                    {/if}
                </div>
            </div>
            {$smarty.capture.content}
        </div>



	</div>
<!--
<div class="c_top">
	<div class="name"><a href="/">На сайт</a></div>
	<div class="help_ico"><a href="/admin/help/"> Помощь</a></div>
	<div class="clean"></div>
</div>



<table class="main">
	<tr>
		<td class="left">

			<ul class="menu">

				<li><a href="/admin/category/list/">Каталог</a></li>
				<li><a href="/admin/brand/list/">Бренды для каталога</a></li>


				<li><a href="/admin/section/list/">Одноуровневые разделы</a></li>


				<li><a href="/admin/pages/1/">О компании</a></li>


				<li><a href="/admin/content/list/">Контентные страницы</a></li>

				<li><a href="/admin/news/list/">Новости</a></li>


				<li><a href="/admin/gallery/list/">Галерея</a></li>


				<li><a href="/admin/faqs/list/">Вопрос-Ответ</a></li>


				<li><a href="/admin/contacts/">Контакты</a></li>


				<li><a href="/admin/user/list/">Пользователи</a></li>


				<li><a href="/admin/vacancy/list/">Вакансии</a></li>
				<li><a href="/admin/vacancy_user/list/">Вакансии (сообщения)</a></li>

				<li><a href="/admin/article/list/">Статьи</a></li>


				<li><a href="/admin/callback_user/list/">Обратная связь (сообщения)</a></li>

				<li><a href="/admin/blog/list/">Блоги</a></li>
				<li><a href="/admin/blog_comment/list/">Комментарии блогов</a></li>


			</ul>
		</td>
		<td class="right">
			<p class="zag">{$smarty.capture.content_name}</p>

			<div class="content">
				{$smarty.capture.content}
			</div>
		</td>
	</tr>
</table>
-->
</body>
</html>
