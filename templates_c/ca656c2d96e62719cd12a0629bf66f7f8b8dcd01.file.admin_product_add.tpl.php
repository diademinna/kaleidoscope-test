<?php /* Smarty version Smarty3-b7, created on 2015-07-07 13:55:15
         compiled from ".\templates\admin/admin_product_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11740559bb01326f117-63540606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca656c2d96e62719cd12a0629bf66f7f8b8dcd01' => 
    array (
      0 => '.\\templates\\admin/admin_product_add.tpl',
      1 => 1436266514,
    ),
  ),
  'nocache_hash' => '11740559bb01326f117-63540606',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Товары / <?php if ($_smarty_tpl->getVariable('data')->value['name']){?>Редактировать - <?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
<?php }else{ ?>Добавить продукт<?php }?>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>


<?php ob_start(); ?>

<div class="ibox-title">
	<h5>Форма для добавления / редактирования продукта</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <div class="errors_block id_category" style="color:#d70000; display: none;">
            <ul>
                <li>Не заполнено поле "Категория"</li>
            </ul>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Категория* :</label>
                <div class="col-sm-10">
                    <select class="form-control m-b" name="id_category">
                        <option value="0">--- Выберите ---</option>
                        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                            <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                                <optgroup label="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
">
                                    <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                        <option <?php if ($_smarty_tpl->getVariable('data')->value['id_category']==$_smarty_tpl->getVariable('cur2')->value['id']){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                    <?php }} ?>
                                </optgroup>
                            <?php }else{ ?>
                                <option <?php if ($_smarty_tpl->getVariable('data')->value['id_category']==$_smarty_tpl->getVariable('cur')->value['id']){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                            <?php }?>
                        <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Название* :</label>
                <div class="col-sm-10">
                        <input name="name" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4"> 
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Цена* :</label>
                                    <div class="col-sm-6">
                                         <div class="input-group m-b">
                                            <input name="price" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['price'];?>
" />
                                            <span class="input-group-addon">руб.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5"> 
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Старая цена:</label>
                                    <div class="col-sm-6">
                                         <div class="input-group m-b">
                                            <input name="old_price" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['old_price'];?>
" />
                                            <span class="input-group-addon">руб.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Контент <br />(если необходим):</label>
                <div class="col-sm-10">
                    <textarea name="text" class="tiny" type="text"><?php echo $_smarty_tpl->getVariable('data')->value['text'];?>
</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Изображение (превью):</label>
                <div class="col-sm-10">
                    <input  type="file" name="image" />

                    <br /><br />
                    <div id="photo">
                        <?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
                            <a href="/uploaded/product/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" class="photo" /></a>
                            &nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
'); return false;"></i>
                            <input type="hidden" name="ext" value="<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" />
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Тайтл:</label>
                <div class="col-sm-10">
                        <input name="title" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['title'];?>
" />
                </div>
            </div>
            <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" name="submitted" value="1" />
                            <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
            </div>
	</form>
</div>
<script>
    $(document).ready(function(){
        $('.errors_block.id_category').hide();
        if (!$('.form-group select[name="id_category"]').val() ||$('.form-group select[name="id_category"]').val()==0 )
        {
            $('.errors_block.id_category').show();
            return false;
        }
    });
    
</script>
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

