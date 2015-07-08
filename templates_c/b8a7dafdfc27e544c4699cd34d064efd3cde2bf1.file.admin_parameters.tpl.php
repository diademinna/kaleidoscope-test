<?php /* Smarty version Smarty3-b7, created on 2015-07-08 18:00:37
         compiled from ".\templates\rebuild/admin_parameters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5891559d3b1571f851-40322666%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8a7dafdfc27e544c4699cd34d064efd3cde2bf1' => 
    array (
      0 => '.\\templates\\rebuild/admin_parameters.tpl',
      1 => 1436367632,
    ),
  ),
  'nocache_hash' => '5891559d3b1571f851-40322666',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<label class="col-sm-2 control-label">Параметры* :</label>
<div class="col-sm-10">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_filtr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
        <div class="checkbox">
           <input id="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('cur')->value['select']){?> checked="checked"<?php }?> type="checkbox" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" name="id_param[<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
]"><label class="label_checkbox"  for="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</label>
        </div>
    <?php }} ?>
</div>