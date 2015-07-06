{capture name="content"}
		
	{literal}
		<script type="text/javascript">
			function checkBeforeSubmit(formData) {
				var errors = new Array();
				var counter = 0;

				if (!formData.fio.value) errors[counter++] = 'Не заполнено поле: Ф.И.О.';
				if (!formData.phone.value) errors[counter++] = 'Не заполнено поле: Телефон';
							
//				if (!formData.email.value).val()) {
//					errors[counter++] = 'Не заполнено поле: Email';
//				}
//				else if (!formData.email.value.match(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/)) {
//					errors[counter++] = 'Неправильный формат поля Email';
//				}

				if (errors.length) {
					$('#errors_block_'+formData.id_vacancy.value).html(errors.join('<br />'));
					//window.location.hash = "#forma_block";  // чтобы страница прыгнула на ошибку
					//$('html, body').stop().animate({scrollLeft: 0, scrollTop:$('#forma_block').offset().top}, 1000);
					return false;
				}
				else {
					return true;
				}
			}
			
			$(document).ready(function(){
				$(".forma_open").click(function(){
					if ($(this).siblings('.item_forma').css('display')=='none') {
						$(this).siblings('.item_forma').fadeIn('slow');
					}
					else {
						$(this).siblings('.item_forma').fadeOut('fast');
					}
					return false;
				});		
			});

		</script>
	{/literal}

	<h1>Вакансии</h1>
	
	<div class="vacancy">	
		{if !$notes AND !$errors}
			{foreach from=$data_vacancy item=cur}
				<div class="item">
					<div class="name">{$cur.name} <span class="date">[{$cur.date|date_format:"%d.%m.%Y"}]</span></div>
					<div class="text">{$cur.text}</div>
					<br />
					<div class="forma_open"><a href="#">Откликнуться на вакансию</a></div>
					<br />
					<div class="item_forma item_forma_{$cur.id}" style="display:none;">

							<form name="forma_{$cur.id}" method="POST" action="" enctype="multipart/form-data" onsubmit="return checkBeforeSubmit(this);">

								<div class="error" id="errors_block_{$cur.id}"></div>

								<table class="forma">
									<tr>
										<td colspan="2"><i>Поля, помеченные знаком <span class="red">*</span>, являются обязательными для заполнения.</i><br /></td>
									</tr>

									<tr>
										<td>ФИО: <span class="red">*</span></td>
										<td><input type="text" name="fio" value="" class="content_input" /></td>
									</tr>
									<tr>
										<td>Телефон: <span class="red">*</span></td>
										<td><input type="text" name="phone" value="" class="content_input" /></td>
									</tr>
									<tr>
										<td>Эл. почта: </td>
										<td><input type="text" name="email" value="" class="content_input" /></td>
									</tr>

									<tr>
										<td>Прикрепить резюме:<br />(не более 5 Mb)</td>
										<td><input type="file" name="user_file"/>
										</td>
									</tr>					

									<tr>
										<td>Сообщение: </td>
										<td><textarea rows="5" name="message" scrolling="no" class="content_input"></textarea></td>
									</tr>

									<tr>
										<td></td>
										<td>				
											<input type="hidden" name="submitted" value="1"/>
											<input type="hidden" name="id_vacancy" value="{$cur.id}"/>
											<input type="image" src="/img/btn_send.png" name="submit">
										</td>
									</tr>
								</table>

							</form>

					</div>


				</div>
				<br /><br />
			{/foreach}

			{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
			
			
		{else}
	     	{include file="common/notify_block.tpl"}{include file="common/errors_block.tpl"}
	    {/if}
	</div>
	
	
	{if !$notes AND !$errors AND !$data_vacancy}На данный момент вакансии отсутствуют.{/if}

		
{/capture}

{include file="common/base_page.tpl"}