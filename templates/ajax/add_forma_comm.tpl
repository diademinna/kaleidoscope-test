<div class="error_comm" id="error_block_{if $id_comm}{$id_comm}{else}last{/if}"></div>
<form action="" method="post" enctype="multipart/form-data" onsubmit="return SendComment({$data_item.id}, {if $id_comm}{$id_comm}{else}0{/if}, {if $mode}'{$mode}'{else}'last'{/if}, this);">
	<div class="field_name">Ваше имя</div>
	<div class="field_val"><input type="text" name="name" value="" /></div>
	<div class="field_name">Сообщение</div>
	<div class="field_val"><textarea name="text"></textarea></div>
	<div class="field_name">Проверочный код</div>
	<div class="field_val"><div class="captcha"><img src="/kcaptcha/"/></div><div class="captcha_inp"><input type="text" name="kcaptcha" /></div><div class="clear"></div></div>
	<button class="btn"><span>отправить</span></button>
</form>