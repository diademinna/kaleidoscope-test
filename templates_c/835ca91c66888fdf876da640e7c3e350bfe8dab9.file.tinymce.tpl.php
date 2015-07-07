<?php /* Smarty version Smarty3-b7, created on 2015-07-07 11:35:10
         compiled from ".\templates\common/tinymce.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24807559a64b01150b2-41354281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '835ca91c66888fdf876da640e7c3e350bfe8dab9' => 
    array (
      0 => '.\\templates\\common/tinymce.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '24807559a64b01150b2-41354281',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('simple_tinymce')->value==1){?>
	
	<script language="javascript" type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			editor_selector : "tiny",
			theme : "simple"
		});
	</script>
		
<?php }elseif($_smarty_tpl->getVariable('tinymce')->value==1){?>
	
	<script language="javascript" type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript">
	
	tinyMCE.init({
			mode : "textareas",
			elements : "ajaxfilemanager",
			theme : "advanced",
			editor_selector : "tiny",			 
	        height : "350",
	        width : "700",
			theme_advanced_font_sizes : "8px, 9px,10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px, 26px, 28px, 30px, 32px, 36px, 40px",
			
			//  ПОЛНЫЙ TINY
			plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,preelementfix",
			
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	        theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : 'bottom',
			theme_advanced_resizing : true,	
			theme_advanced_resize_horizontal : true,
			theme_advanced_resizing_use_cookie : false,  // чтобы не писал в куки высоту. иначе высота скачет!
			//theme_advanced_resizing_min_height :250,   // высота окна с формой!
			//theme_advanced_source_editor_height : 200,  // высота кода html
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			apply_source_formatting : true,  // текст в коде отображается отформатированным	
			forced_root_block : false, // чтобы в тексте не появлялся <P>
			force_br_newlines : true, // чтобы в тексте не появлялся <P>
			force_p_newlines : false, // чтобы в тексте не появлялся <P>
			//relative_urls : true,  //  относительный путь
			relative_urls : false,  // абсол. путь
			remove_script_host : false // абсол. путь
		});
	
		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "../../../../js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";  // вроде даже не надо.
			var view = 'detail';
			switch (type) {
				case "image":
				view = 'thumbnail';
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
                width: 782,
                height: 840,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
		}		
	</script>
	
<?php }?>
