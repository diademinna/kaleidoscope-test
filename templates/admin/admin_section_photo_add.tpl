{capture name="content_name"}
	Добавить/Редактировать Изображения
{/capture}

{capture name="content"}
	{literal}
		<script type="text/javascript">
			function del(id_section, id_image){
				if(confirm("Вы уверены?")) {
					xajax_deleteImage(id_section, id_image);
				}
			}
				
			$(function(){
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
	{/literal}
	
	<form action="" method="post" enctype="multipart/form-data">
		
		{include file="common/errors_block.tpl"}
		
		<table class="edit" width="100%">
			<tr>
				<td><a href="/admin/section/list/{$parent_id}/{if $get_param}{$get_param}{/if}" class="back"><span></span>НАЗАД</a><br><br></td>
				<td>
					{if $smarty.get.save}<b style="color:#4BB43F;">СОХРАНЕНО</b><br>{/if}
				</td>
			</tr>
			
			<tr>
				<td>Название:</td>
				<td><textarea class="sm"  name="name_img" id="name_img" ></textarea></td>
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
					<input type="hidden" name="id_section" id="id_section" value="{$id_section}" />
					{*<input type="hidden" name="submitted" value="1" />					
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">*}
				</td>
			</tr>
		</table>
	</form>		
				
				
	{literal}
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
			this.setPostParams({"id_from_swfupload": $("#id_section").val(),								
								"type_resize": $("#type_resize").val(),
								"name_img": $("#name_img").val()
								});
			return true;
		}
		
		window.onload = function() {
			
			var settings = {
				flash_url : "/js/SWFUpload/swfupload.swf",
				upload_url: "/admin/section_photo/add/{/literal}{$page}{literal}/{/literal}{$id_section}{literal}/?swfupload=1",
				//post_params: { "id_from_swfupload": '{/literal}{$id_section}{literal}'},
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
	{/literal}
	
	
	{if $data_photo}	
	
		<hr class="sep" />
	
		<h1>Фотогалерея</h1>
		
		<div class="sort_list gall_block">
				
			<ul id="sortable"  class="sort">
				{foreach from=$data_photo item=cur name=loop}
					
					<li id="item_{$cur.id}">
						<form id="form_item_{$id_section}" name="form_img_{$id_section}" action="" method="post">
							<div style="width:50%;"><div class="padd">
									<a href="/uploaded/section/{$cur.id_section}/{$cur.id}.{$cur.ext}" target="_blank"><img src="/uploaded/section/{$cur.id_section}/{$cur.id}_sm.{$cur.ext}" alt="{$cur.name}" title="{$cur.name}" class="photo" /></a>
								<img class="pointer" src="/img/admin/del.png" onclick="del('{$cur.id_section}','{$cur.id}');" title="Удалить изображение" alt="Удалить изображение" style="cursor:pointer;" /><br><br>
							</div></div>

							<div style="width:50%;"><div class="padd">									
								<textarea  id="name_img_{$cur.id}" name="name_img_{$cur.id}" >{$cur.name}</textarea>
								<a href="" onclick="xajax_reSaveName(document.getElementById('name_img_{$cur.id}').value, {$cur.id}); return false;"><img class="pointer" src="/img/admin/save.png" title="Сохранить название" alt="Сохранить название" /></a>								
							</div></div>

							<div class="clean"></div>
						</form>
					</li>					
				{/foreach}
			</ul>
			
		</div>
			
	{/if}
	

{/capture}

{include file="admin/common/base_page.tpl"}