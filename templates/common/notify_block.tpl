{if isset($notes) && count($notes) > 0}
	<br />
	<div class="notify">
		<ul>
			{foreach from=$notes item=note}
			  <li><b>{$note}</b></li>
			{/foreach}
		</ul>
	</div>
{/if}