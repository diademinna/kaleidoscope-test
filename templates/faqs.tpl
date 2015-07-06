{capture name="content"}

	<h1>Вопрос-Ответ</h1>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.question').toggle(function(){
					$(this).next(".answer").slideDown('middle');
				}, function(){
					$(this).next(".answer").slideUp('middle');
				return false;
			});
		});
	</script>
	
	{foreach from=$data_faqs item=cur name=loop}
		<div class="faq_item">
			<div class="question">
				{$cur.fio} {if $cur.date}от ({$cur.date|date_format:"%d.%m.%Y"}){/if} <br />
				{$cur.question}
			</div>			
			<div class="answer" style="display:none;">{$cur.answer}</div>
		</div>
	{/foreach}	
	<div class="clear"></div>
	
	{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
	
	{*
		.faq_item{border:2px solid #fff; border-radius:10px 10px 10px 10px; box-shadow: 0px 0px 3px #777; padding:25px 30px 25px 64px; background:transparent url(/img/faq_ico.png) no-repeat scroll 19px 22px;}
		.faq_item .question{color:#d00000; font-size:15px; cursor:pointer; border-bottom:1px dotted #d00000; display:inline;}
		.faq_item .answer{color:#333; font-size:13px; margin:22px 0 0 0;}
	*}
	
	<p>Если у вас возникли вопросы, вы можете их задать ниже в форме:</p><br/>
	
	<div id="faq_form">
		{if $errors}{include file="common/errors_block.tpl"}{/if}
		{if $notes}{include file="common/notify_block.tpl"}{/if}
		
		<form action="#faq_form" method="POST" enctype="multipart/form-data">
		 	
		 	<table class="forma">
				<tr>
					<td colspan="2"><i>Поля, помеченные знаком <span class="red">*</span>, являются обязательными для заполнения.</i><br></td>
				</tr>
				<tr>
					<td>ФИО: <span class="red">*</span></td>
					<td><input type="text" name="fio" value="{if $data_form.fio}{$data_form.fio}{/if}"></td>
				</tr>
				<tr>
					<td>Эл. почта: <span class="red">*</span></td>
					<td><input type="text" name="email" value="{if $data_form.email}{$data_form.email}{/if}"></td>
				</tr>
				<tr>
					<td>Ваш вопрос: <span class="red">*</span></td>
					<td><textarea name="question" scrolling="no">{if $data_form.question}{$data_form.question}{/if}</textarea></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input name="submit" type="image" src="/img/btn_send.png" />
						<input type="hidden" value="1" name="submitted">
					</td>
				</tr>
			</table>
		 	
		</form>
		
	</div>

{/capture}
{include file="common/base_page.tpl"}