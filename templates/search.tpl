{capture name="content"}
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Страница поиска
        </div>
        <br />
        <div class='find-word__stroka'>Вы искали: <span class='find-word'>{$smarty.get.submitted}</span></div>


	{if $error}
		{$error}
	{else if}
        {if $result}
            {foreach from=$result item=cur}
                <div class='search-item'>
                    <div class='search-item__name'><a href="{$cur.route}">{$cur.result_name}</a></div>
                {$cur.result_text}
                </div>
            {/foreach}
        {else}
                Ничего не найдено <br />
        {/if}

	{/if}
    </div>	
	
{/capture}

{include file="common/base_page.tpl"}