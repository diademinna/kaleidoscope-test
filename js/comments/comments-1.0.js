/* добавление комментов незарегиным юзерам */


// ДОБАВЛЯЕМ ФОРМУ на ЭКРАН
// id_blog - номер темы
// id_comm - номер коммента (если 0 то ответ на тему.)
// mode - first, last, internal  - заведен на всякий случай
function AddFormaComm(id_blog, id_comm, mode){
	var flag_close = 0; 
	
	// если пытаемся закрыть
	if(mode=="internal"){
		if( ($('#add_forma_comm_block_'+id_comm).css("display")) == "block" ){  // при закрытии 
			$('#add_forma_comm_block_'+id_comm).fadeOut();
			flag_close = 1; // мы свернули форму добавления комента
		}
	}	
	
	// если не пытались закрыть значит открываем форму
	if(flag_close==0){  // подгрузить форму если она не подгружена.
		// сначала закрываем возможно открытые.
		$('ul.comment_list .add_forma_comm_block').fadeOut();
		
		// подгружаем и открываем текущюю форму для ответа.
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/add_forma_comm/",
			async: false,
			data:{
				id_blog:id_blog,
				id_comm:id_comm,
				mode:mode
			},
			success: function(data){
				jQuery.parseJSON(data);
				
				if(mode=="internal"){  // значит отвечают на сообщение
					$('#add_forma_comm_block_'+id_comm).html(data.data_ajax).fadeIn();
				}
			}
		});
	}
	
	return false;
}



// добавляем коммент в базу. по натию на кнопку формы ОТПРАВИТь
function SendComment(id_blog, id_comm, mode, formData) {

	var flag_error = ""; // при возврате из аякса, показывает были ли там ошибки
	var errors = new Array();
	var counter = 0;
	var id_new=0; // флаг показывающий номер нового добавленного комента
	
	if (!formData.name.value) errors[counter++] = 'Не заполнено поле: Ваше Имя';
	if (!formData.text.value) errors[counter++] = 'Не заполнено поле: Сообщение';
	
	 
	
	if (!formData.kcaptcha.value){
		errors[counter++] = 'Не заполнено поле: Проверочный код';
	}
	else{
		// проверка капчи
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/check_captcha/",
			async: false,
			data:  {
				text_kcaptcha: formData.kcaptcha.value
			},
			success: function(data){
				jQuery.parseJSON(data); // возращают ok или error
				if(data.data_ajax=="error"){						
					errors[counter++] = 'Не правильно заполнено поле: Проверочный код';
				}
			}
		});
	}
	
	if (errors.length) {
		var in_block; 
		if(id_comm){
			in_block = id_comm;
		}
		else{
			in_block = 'last'
		}		
		$('#error_block_'+in_block).html(errors.join('<br />')+'<br /><br />');
		return false;
	}
	else{
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/send_comment/",
			async: false,
			data:  {
				id_blog: id_blog,
				id_comm: id_comm,
				mode: mode,
				name: formData.name.value,
				text: formData.text.value
			},
			success: function(data){
				jQuery.parseJSON(data); // возращают номер доб. записи.

				if(data.data_ajax=="error"){						
					flag_error = 1;
				}
				else{
					id_new = data.data_ajax2; // добавили комент с этим номером
				}
			}
		});
		
		if(flag_error==1){
			//alert ("Пользователь с таким именем уже зарегистрирован. Выберите другое имя.");
			alert ("Ошибка добавления.");
			return false;
		}
		
		if(mode=="internal"){
			$('#add_forma_comm_block_'+id_comm).fadeOut().css('display','none');  //скрываем форму
		}
		
		// чистим поля формы
		$('.add_forma_comm_block input[name="name"]').val('');
		$('.add_forma_comm_block textarea[name="text"]').val('');
		$('.error_comm').empty(); // чистим ошибки
				
		// обновляем ветку
		GetComment(id_blog, id_new);
	}
	
	return false;
}

// достаем комменты. после добавления нового коммента
// id_blog - номер блога в который добавили комент
// id_new - номер добавленного комента
function GetComment(id_blog, id_new){

	$.ajax({
		type: "POST",
		dataType: "json",
		url: "/get_comment/",
		async: false,
		data:{
			id_blog:id_blog
		},
		success: function(data){
			jQuery.parseJSON(data);
			$('#comments_block').html(data.data_ajax);
			$('#comm_'+id_new).fadeIn(1000);
		}
	});

	return false;
}
