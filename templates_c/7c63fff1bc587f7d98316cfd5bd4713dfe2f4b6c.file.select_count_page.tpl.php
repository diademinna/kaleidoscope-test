<?php /* Smarty version Smarty3-b7, created on 2015-06-16 00:07:23
         compiled from ".\templates\admin/common/select_count_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17999557f3e8b436bb4-84349211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c63fff1bc587f7d98316cfd5bd4713dfe2f4b6c' => 
    array (
      0 => '.\\templates\\admin/common/select_count_page.tpl',
      1 => 1434379334,
    ),
  ),
  'nocache_hash' => '17999557f3e8b436bb4-84349211',
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