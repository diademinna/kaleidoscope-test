{capture name="content"}
    {if $data_actions} {* Список элементов *}
        <div class="container-login">
            <div class="navigation">
                <a href="/"><i class="fa fa-home"></i></a>
                <i class="fa fa-chevron-right"></i>Акции
            </div>
            
            {foreach from=$data_actions item=cur}
                ffdss
            {/foreach}
            {if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
            
        </div>
		
		
	{else} {* Один элемент *}

		<h1>{$data_item.name}</h1>
		
		{if $data_item}
			<div class="actions_one">
				<div class="date">Дата: {$data_item.date|date_format:"%d.%m.%Y"}</div>
				{if $data_item.ext}
					<div class="img"><a onclick="return hs.expand(this, config1)" href="/uploaded/actions/{$data_item.id}.{$data_item.ext}" align="left"><img src="/uploaded/actions/{$data_item.id}_sm.{$data_item.ext}" /></a></div>
				{/if}
				<div class="text user_content">{$data_item.text}</div>
			</div>
			<div class="clear"></div>
		{/if}	
		
		
		
		
	{/if}
		
{/capture}

{include file="common/base_page.tpl"}