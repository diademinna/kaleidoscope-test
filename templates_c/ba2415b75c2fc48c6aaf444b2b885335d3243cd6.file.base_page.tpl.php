<?php /* Smarty version Smarty3-b7, created on 2015-07-15 14:45:26
         compiled from ".\templates\admin/common/base_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3154255a647d67439e5-33730613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba2415b75c2fc48c6aaf444b2b885335d3243cd6' => 
    array (
      0 => '.\\templates\\admin/common/base_page.tpl',
      1 => 1436960722,
    ),
  ),
  'nocache_hash' => '3154255a647d67439e5-33730613',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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


	<?php echo $_smarty_tpl->getVariable('ajaxCode')->value;?>


	<?php $_template = new Smarty_Internal_Template("common/tinymce.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


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
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="category"){?> class="active"<?php }?>>
                        <a href="/admin/category/list/">
                                <i class="fa fa-archive"></i>
                                <span class="nav-label">Все категории</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="main_category"){?> class="active"<?php }?>>
                        <a href="/admin/main_category/list/">
                            <i class="fa fa-star"></i>
                            <span class="nav-label">Категории на главной</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="product"){?> class="active"<?php }?>>
                        <a href="/admin/product/list/">
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-label">Товары</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="user"){?> class="active"<?php }?>>
                        <a href="/admin/user/list/">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Покупатели</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="orders"){?> class="active"<?php }?>>
                        <a href="/admin/orders/list/">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-label">Заказы</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="parameter"){?> class="active"<?php }?>>
                        <a href="/admin/parameter/list/">
                            <i class="fa fa-wrench"></i>
                            <span class="nav-label">Параметры для категорий</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="actions"){?> class="active"<?php }?>>
                        <a href="/admin/actions/list/">
                            <i class="fa fa-gift"></i>
                            <span class="nav-label">Акции</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="contacts"){?> class="active"<?php }?>>
                        <a href="/admin/contacts/list/">
                            <i class="fa fa-map-marker"></i>
                            <span class="nav-label">Контакты</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="review"){?> class="active"<?php }?>>
                        <a href="/admin/review/list/">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="nav-label">Отзывы</span>
                        </a>
                    </li>
                    <li<?php if ($_smarty_tpl->getVariable('unit')->value=="portfolio"){?> class="active"<?php }?>>
                        <a href="/admin/portfolio/list/">
                            <i class="fa fa-briefcase"></i>
                            <span class="nav-label">Портфолио</span>
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
                    <h2><?php echo $_smarty_tpl->smarty->_smarty_vars['capture']['content_name'];?>
</h2>
                    <?php if ($_smarty_tpl->getVariable('mass_navigation')->value){?>
                        <ol class="breadcrumb">
                            <?php if ($_smarty_tpl->getVariable('unit')->value=='parameter'){?>
                                <li><a href="/admin/parameter/list/">Все параметры</a></li>
                            <?php }else{ ?>
                                <li><a href="/admin/category/list/">Все категории</a></li>
                            <?php }?>
                            
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
                                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['last']){?>
                                    <li class="active">
                                        <strong><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</strong>
                                    </li>
                                <?php }else{ ?>
                                    <li>
                                        <?php if ($_smarty_tpl->getVariable('unit')->value=='parameter'){?>
                                            <a href="/admin/parameter/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                                        <?php }else{ ?>
                                            <a href="/admin/category/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                                        <?php }?>
                                    </li>
                                <?php }?>
                            <?php }} ?>
                        </ol>
                    <?php }?>
                </div>
            </div>
            <?php echo $_smarty_tpl->smarty->_smarty_vars['capture']['content'];?>

        </div>
    </div>
</body>
</html>
