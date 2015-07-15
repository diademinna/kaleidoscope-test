{capture name="content"}

    {if $data_portfolio} {* СПИСОК ЭЛЕМЕНТОВ *}

<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Портфолио
    </div>
    <br />
    <div class="portfolio-list">
        {foreach from=$data_portfolio item=cur name=loop}
            <div class="portfolio-list__item{if $smarty.foreach.loop.iteration%3 == 0} last{/if}">
                <div class='portfolio-list-item__image'><a href="/portfolio/{$cur.id}/"><img src="/uploaded/portfolio/{$cur.id}_sm.{$cur.ext}" /></a></div>
                <div class="portfolio-list-item__name"><a href="/portfolio/{$cur.id}/">{$cur.name}</a></div>
                <div class='portfolio-list-item__anons'>{$cur.anons}</div>
            </div>
             {if $smarty.foreach.loop.iteration%3==0}<div class="clear"></div>{/if}
        {/foreach}
        <div class="clear"></div>
        <div class="clear"></div>
        {if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
    </div>
</div>

    {else} {* ОДИН ЭЛЕМЕНТ *}
	
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i><a href='/portfolio/'>Портфолио</a>
            <i class="fa fa-chevron-right"></i>{$data_item.name}
        </div>
        <br />
    </div>
		
    <div class="portfolio-list">
        <div class='portfolio-text'>{$data_item.text}</div>
        {if $data_photo_goriz || $data_photo_vert}    {* ФОТОГАЛЕРЕЯ *}
            {if $data_photo_goriz}
                {foreach from=$data_photo_goriz item=cur name="loop_g"}
                    <div class="portfolio-list__item{if $smarty.foreach.loop_g.iteration%3 == 0} last{/if}">
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a></div>
                        <div class="highslide-caption">{$cur.name}</div>						
                        <div class="name">{$cur.name}</div>
                    </div>
                    {if $smarty.foreach.loop_g.iteration%3==0}<div class="clear"></div>{/if}
                {/foreach}
                <div class="clear"></div>
            {/if}
            {if $data_photo_vert}
                {foreach from=$data_photo_vert item=cur name="loop_v"}
                    <div class="portfolio-list__item vert{if $smarty.foreach.loop_v.iteration%4 == 0} last{/if}">							
                        <div class='portfolio-list-item__image'><a href="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/portfolio/{$cur.id_portfolio}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></div>
                        </a>
                        <div class="highslide-caption">{$cur.name}</div>						
                        <div class="name">{$cur.name}</div>
                    </div>
                    {if $smarty.foreach.loop_v.iteration%4==0}<div class="clear"></div>{/if}
                {/foreach}
                <div class="clear"></div>
            {/if}
        {/if}
    </div>
{/if}
		
{/capture}

{include file="common/base_page.tpl"}