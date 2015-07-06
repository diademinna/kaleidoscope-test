{if isset($errors) && count($errors) > 0}
	<div class="errors_block" style="color:#d70000;">
		<ul>
			{foreach from=$errors item=error}
				<li style="background:none; list-style-type:disc;">{$error}</li>
			{/foreach}
		</ul>
	</div>
{/if}
