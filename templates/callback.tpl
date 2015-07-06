{capture name="content"}
	
{literal}
	<script type="text/javascript">
    function checkBeforeSubmit() {
        var errors = new Array();
        var counter = 0;
        
        if (!$('#forma_block input[name="fio"]').val()) errors[counter++] = 'Не заполнено поле: Ф.И.О.';
	   
        if (!$('#forma_block input[name="email"]').val()) {
        	errors[counter++] = 'Не заполнено поле: Email';
        }
        else if (!$('#forma_block input[name="email"]').val().match(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/)) {
        	errors[counter++] = 'Неправильный формат поля: Email';
    	}
			
		if (!$('#forma_block textarea[name="text"]').val()) errors[counter++] = 'Не заполнено поле: Сообщение';
		
        if (errors.length) {
            $('#forma_block .errors_block').html(errors.join('<br/>'));
            window.location.hash = "#forma_block";  // чтобы страница прыгнула на ошибку
            return false;
        }
        else {
        	return true;
        }
    }
	</script>
{/literal}
	

	<div id="forma_block">
	
		<h1>Обратная связь</h1>
		{if !$notes AND !$errors}
			<div class="errors_block"></div>
		
			<form name="form_callback" method="POST" action="/callback/" onsubmit="return checkBeforeSubmit();">
			     <table width="100%" class="forma">
					<tr>
					  <td colspan="2"><i>Поля, помеченные знаком <span class="red">*</span>, являются обязательными для заполнения.</i></td>
					</tr>					  
					<tr>
						<td>Ф.И.О.: <span class="red">*</span></td>
						<td><input type="text" name="fio" value="" /></td>
					</tr>
					<tr>
						<td>Телефон: </td>
						<td><input type="text" name="tel" value="" /></td>
					</tr>
					<tr>
						<td>Эл. почта: <span class="red">*</span></td>
						<td><input type="text" name="email" value="" /></td>
					</tr>
					<tr>
						<td>Сообщение: <span class="red">*</span></td>
						<td><textarea name="text" id="text"></textarea></td>
					</tr>					
					<tr>
					  <td></td>
					  <td>
						  <input type="image" src="/img/btn_send.png">
						  <input type="hidden" name="submitted" value="1">
					  </td>
					</tr>
				</table>
	        </form>
	            
	    {else}
	     	{include file="common/notify_block.tpl"}{include file="common/errors_block.tpl"}
	    {/if}

	</div>	
			
{/capture}

{include file="common/base_page.tpl"}