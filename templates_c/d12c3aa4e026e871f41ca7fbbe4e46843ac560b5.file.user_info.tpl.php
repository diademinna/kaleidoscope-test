<?php /* Smarty version Smarty3-b7, created on 2015-06-30 09:37:42
         compiled from ".\templates\user/user_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9017559239367641a3-20176059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd12c3aa4e026e871f41ca7fbbe4e46843ac560b5' => 
    array (
      0 => '.\\templates\\user/user_info.tpl',
      1 => 1435646229,
    ),
  ),
  'nocache_hash' => '9017559239367641a3-20176059',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><?php ob_start(); ?>
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Личный кабинет
        </div>
         <br />
         <div class="container-new_user">
            <table>
                <tr>
                    <td>Имя</td>
                    <td>Имя</td>
                </tr>
            </table>
         </div>
         <div class="clear"></div>
    </div>
	<h1><?php if ($_smarty_tpl->getVariable('user')->value['id']==$_smarty_tpl->getVariable('data')->value['id']){?>Личный кабинет<?php }else{ ?>Профиль участника<?php }?></h1>

	<div class="profile">
	
		<div class="prof_l">
			<div class="zag"><?php if ($_smarty_tpl->getVariable('user')->value['id']==$_smarty_tpl->getVariable('data')->value['id']){?>Мой профиль<?php }else{ ?>Профиль<?php }?></div>
			<div class="login"><?php echo $_smarty_tpl->getVariable('data')->value['login'];?>
</div>
			<div><?php if ($_smarty_tpl->getVariable('data')->value['avatar']){?><img src="/uploaded/user/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data')->value['avatar'];?>
?<?php echo $_smarty_tpl->getVariable('rand_new')->value;?>
" /><?php }else{ ?><img src="/img/no_avatar.png" /><?php }?></div>
			<?php if ($_smarty_tpl->getVariable('user')->value['id']==$_smarty_tpl->getVariable('data')->value['id']){?><div><a href="/user/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
/">Загрузить аватар</a></div><?php }?>	
		</div>		
		
		<div class="prof_r">
		
				<p>ФИО: <?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
</p>
				<p>E-mail: <?php echo $_smarty_tpl->getVariable('data')->value['email'];?>
</p>			 	
				<p>Пол: <?php if ($_smarty_tpl->getVariable('data')->value['sex']==1){?>мужской<?php }elseif($_smarty_tpl->getVariable('data')->value['sex']==2){?>женский<?php }else{ ?>не указан<?php }?></p>
				<?php if ($_smarty_tpl->getVariable('data')->value['dob']&&$_smarty_tpl->getVariable('data')->value['dob']!="0000-00-00"){?><p>День рождения: <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('data')->value['dob'],"%d-%m-%Y");?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('data')->value['city']){?><p>Город: <?php echo $_smarty_tpl->getVariable('data')->value['city'];?>
</p><?php }?>				
				<?php if ($_smarty_tpl->getVariable('data')->value['site']){?><p>Сайт: <noindex><a href="<?php echo $_smarty_tpl->getVariable('data')->value['site'];?>
" target="_blank" rel="nofollow"><?php echo $_smarty_tpl->getVariable('data')->value['site'];?>
</a></noindex></p><?php }?>
				<?php if ($_smarty_tpl->getVariable('data')->value['skype']){?><p>Skype: <?php echo $_smarty_tpl->getVariable('data')->value['skype'];?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('data')->value['icq']){?><p>ICQ: <?php echo $_smarty_tpl->getVariable('data')->value['icq'];?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('data')->value['tel']){?><p>Телефон: <?php echo $_smarty_tpl->getVariable('data')->value['tel'];?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('data')->value['address']){?><p>Адрес: <?php echo $_smarty_tpl->getVariable('data')->value['address'];?>
 </p><?php }?>
				
				<?php if ($_smarty_tpl->getVariable('data')->value['about']){?><p>О себе: <?php echo $_smarty_tpl->getVariable('data')->value['about'];?>
</p><?php }?>
				
				<p>Дата регистрации: <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('data')->value['date'],"%d-%m-%Y");?>
</p>
				<p>Дата последнего посещения: <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('data')->value['last_visit'],"%d-%m-%Y");?>
</p>
				<?php if ($_smarty_tpl->getVariable('user')->value['id']==$_smarty_tpl->getVariable('data')->value['id']){?>
					<p><a href="/user/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
/">Редактировать личные данные</a></p>
					<p><a href="/change_password/">Изменить пароль</a></p>
				<?php }?>
		</div>
		
	</div>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
