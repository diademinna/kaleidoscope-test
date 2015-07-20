<?php /* Smarty version Smarty3-b7, created on 2015-07-18 21:11:16
         compiled from "./templates/admin/common/select_count_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211766459055aa96c42b6e51-13082171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1135e5735058409c6db6fc95a92145534eb323cb' => 
    array (
      0 => './templates/admin/common/select_count_page.tpl',
      1 => 1437229356,
    ),
  ),
  'nocache_hash' => '211766459055aa96c42b6e51-13082171',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<option value="2" <?php if ($_GET['count_page']==2){?>selected<?php }?>>2</option>
<option value="10" <?php if ($_GET['count_page']==10){?>selected<?php }?>>10</option>
<option value="20" <?php if ($_GET['count_page']==20||!$_GET['count_page']){?>selected<?php }?>>20</option>
<option value="30" <?php if ($_GET['count_page']==30){?>selected<?php }?>>30</option>
<option value="40" <?php if ($_GET['count_page']==40){?>selected<?php }?>>40</option>
<option value="50" <?php if ($_GET['count_page']==50){?>selected<?php }?>>50</option>
<option value="100" <?php if ($_GET['count_page']==100){?>selected<?php }?>>100</option>
<option value="200" <?php if ($_GET['count_page']==200){?>selected<?php }?>>200</option>