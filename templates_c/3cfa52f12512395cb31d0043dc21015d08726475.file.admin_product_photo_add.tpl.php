<?php /* Smarty version Smarty3-b7, created on 2015-06-24 22:49:39
         compiled from ".\templates\admin/admin_product_photo_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5691558b09d35e7c97-54565940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cfa52f12512395cb31d0043dc21015d08726475' => 
    array (
      0 => '.\\templates\\admin/admin_product_photo_add.tpl',
      1 => 1435175378,
    ),
  ),
  'nocache_hash' => '5691558b09d35e7c97-54565940',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Добавить/Редактировать Изображения
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
	
		<script type="text/javascript">
			function del(id_product, id_image)	{
				if(confirm("Вы уверены?")) {
					xajax_deleteImage(id_product, id_image);
				}
			}
				
			$(function() {			
				$( "#sortable" ).sortable({
					opacity: 0.8,
					revert: true,
					axis:'y'
				});
			});		
			$(document).ready(function() { 
				$("#sortable").sortable({

					  update : function () { 
						var mass_sort = $('#sortable').sortable('toArray');				      
						xajax_Sort(mass_sort); 
					  }
				});
			});
		</script>
	
	
    <form action="" method="post" enctype="multipart/form-data">
	
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


        <table class="edit" width="100%">
            <tr>
                    <td width='150px'><a href="/admin/product/list/" class="back"><span></span><i class="fa fa-hand-o-left"></i> К СПИСКУ ПРОДУКТОВ</a><br><br></td>
                    <td>
                            <?php if ($_GET['save']){?><b style="color:#4BB43F;">СОХРАНЕНО</b><br><?php }?>
                    </td>
            </tr>	
            <tr>
                    <td>Название:</td>
                    <td>                        <textarea class="sm"  name="name_img" id="name_img" ></textarea></td>
            </tr>
            <tr>
                    <td>Мультизагрузка:<br/>
                            (возможен выбор<br/>более 1 фото)
                    </td>
                    <td>
                            <select name="type_resize" id="type_resize">
                                    <option value="1">Обрезать края</option>
                                    <option value="2">Добавлять пустые поля</option>
                            </select>
                            <br /><br />
                            <div id="spanButtonPlaceHolder"></div><br/>
                            <div id="divStatus"></div><br/>
                            <div id="fsUploadProgress" style="color:#777;"></div>
                            <a id="btnCancel" href="#cancel"></a>
                    </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="id_product" id="id_product" value="<?php echo $_smarty_tpl->getVariable('id_product')->value;?>
" />
                    
                </td>
            </tr>
            </table>
	</form>		
				
				
	
	<script type="text/javascript" src="/js/SWFUpload/swfupload.js"></script>
	<script type="text/javascript" src="/js/SWFUpload/swfupload.queue.js"></script>
	<script type="text/javascript" src="/js/SWFUpload/fileprogress.js"></script>
	<script type="text/javascript" src="/js/SWFUpload/handlers.js"></script>
	<script type="text/javascript">
		var swfu;
		var myQueueComplete = function () {
			window.location.reload();
		};
			
		function uploadStart() {	// функция вызывается перед загрузкой фоток				
			this.setPostParams({"id_from_swfupload": $("#id_product").val(),								
								"type_resize": $("#type_resize").val(),
								"name_img": $("#name_img").val()
								});
			return true;
		}
		
		window.onload = function() {
			
			var settings = {
				flash_url : "/js/SWFUpload/swfupload.swf",
				upload_url: "/admin/product_photo/add/<?php echo $_smarty_tpl->getVariable('id_product')->value;?>
/?swfupload=1",
				//post_params: { "id_from_swfupload": '<?php echo $_smarty_tpl->getVariable('id_product')->value;?>
'},
				file_size_limit : "15 MB",
				file_types : "*.jpg; *.png; *.jpeg; *.gif",
				file_types_description : "Images",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings	
				button_image_url: "/js/SWFUpload/button_bgr.png",
				button_width: 100,
				button_height: 30,
				button_text_left_padding: 21,
				button_text_top_padding: 4,
				button_text : "<span class=\"uploadBtn\">Обзор...</span>",
				button_text_style : ".uploadBtn {font-size:16px; font-family:Arial; background-color:#FF0000;}",
				button_placeholder_id: "spanButtonPlaceHolder",

				// The event handler functions are defined in handlers.js
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : myQueueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
		};
	</script>
	
	
	
	<?php if ($_smarty_tpl->getVariable('data_photo')->value){?>	
	
		<hr class="sep" />
	
		<h1>Фотогалерея</h1>
		
		<div class="sort_list gall">
				
                    <ul id="sortable"  class="sort" style="list-style:none;">
				<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_photo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
					
					<li id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
						<form id="form_item_<?php echo $_smarty_tpl->getVariable('id_product')->value;?>
" name="form_img_<?php echo $_smarty_tpl->getVariable('id_product')->value;?>
" action="" method="post">
                                                    <div class='row'>
							<div class='col-sm-4'>
                                                            <div class="padd">
									<a href="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id_product'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" target="_blank"><img src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id_product'];?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" alt="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" title="<?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
" class="photo" /></a>
								<img class="pointer" src="/img/admin/del.png" onclick="del('<?php echo $_smarty_tpl->getVariable('cur')->value['id_product'];?>
','<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
');" title="Удалить изображение" alt="Удалить изображение" style="cursor:pointer;" /><br><br>
							</div>
                                                        </div>

							<div class='col-sm-8'><div class="padd">									
								<textarea  id="name_img_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" name="name_img_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" ><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</textarea>
								<a href="" onclick="xajax_reSaveName(document.getElementById('name_img_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
').value, <?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
); return false;"><img class="pointer" src="/img/admin/save.png" title="Сохранить название" alt="Сохранить название" /></a>								
							</div></div>
                                                        </div>

						</form>
					</li>					
				<?php }} ?>
			</ul>
			
		</div>
			
	<?php }?>
	

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
