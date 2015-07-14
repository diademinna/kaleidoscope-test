{capture name="content"}
    {if $data_actions} {* Список элементов *}
        <div class="container-login">
            <div class="navigation">
                <a href="/"><i class="fa fa-home"></i></a>
                <i class="fa fa-chevron-right"></i>Акции
            </div>
            <br />
            {foreach from=$data_actions item=cur name=loop}
                <div class="container-action{if $smarty.foreach.loop.iteration%2 == 0} last{/if}">
                    
                   <div class="container-action_image"><img src="/uploaded/actions/{$cur.id}_sm.{$cur.ext}" /></div>
                   <div class="action-description">
                        <div class="action-description_name">
                            <a href="/actions/{$cur.id}/">{$cur.name}</a>
                        </div>
                        {if $cur.date_end}
                            <div style="margin-bottom: 5px; color:#9d9d9d; font-size: 12px;">Действует до: <b>{$cur.date_end|date_format:"%d.%m.%Y"}</b></div>
                        {/if}
                        <div class="container-action-text">
                        {if $cur.anons}
                            {$cur.anons|truncate:90:"..."}
                        {else}
                            {$cur.text|truncate:90:"..."}
                        {/if}
                        </div>
                        <div class="action-more"><a href="/actions/{$cur.id}/">Подробнее</a></div>
                   </div>
                    <div class="clear"></div>
                </div>
            {/foreach}
            <div class="clear"></div>
            {if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
        </div>
		
		
	{else} {* Один элемент *}

            <div class="container-login">
                <div class="navigation">
                    <a href="/"><i class="fa fa-home"></i></a>
                    <i class="fa fa-chevron-right"></i><a href="/actions/">Акции</a>
                    <i class="fa fa-chevron-right"></i>{$data_item.name}
                </div>
                  <br />
                <div style="float:left;width:488px; margin-right:20px;">
                    <div class="action-image">
                        <img src="/uploaded/actions/{$data_item.id}_sm.{$data_item.ext}" />
                    </div>
                    <div class="action-desciption">
                        <div class="action-description__name">{$data_item.name}</div>
                        <div class="action-description__date_end">Действует до:<span>{$data_item.date_end|date_format:"%d.%m.%Y"}</span></div>
                    </div>
                    <div class="clear"></div>
                    <div class="bgr-dark_red title-block" style="margin-top:30px;">описание</div>
                    <div class="action_category">
                        Действует на товары из следующих категорий:
                        {foreach from=$data_actions_category item=cur}
                            <div class="action-category"><a href="/category/{$cur.id_category}/">{$cur.name_category}</a></div>
                        {/foreach}
                        <br />
                        {$data_item.text}
                    </div>
                </div>
                {if $data_last_actions}
                <div style="float:left;">
                    {foreach from=$data_last_actions item=cur}
                         <div class="container-action last" style="float: none;">
                    
                            <div class="container-action_image"><img src="/uploaded/actions/{$cur.id}_sm.{$cur.ext}" /></div>
                            <div class="action-description">
                                 <div class="action-description_name">
                                     <a href="/actions/{$cur.id}/">{$cur.name}</a>
                                 </div>
                                 {if $cur.date_end}
                                     <div style="margin-bottom: 5px; color:#9d9d9d; font-size: 12px;">Действует до: <b>{$cur.date_end|date_format:"%d.%m.%Y"}</b></div>
                                 {/if}
                                 <div class="container-action-text">
                                 {if $cur.anons}
                                     {$cur.anons|truncate:90:"..."}
                                 {else}
                                     {$cur.text|truncate:90:"..."}
                                 {/if}
                                 </div>
                                 <div class="action-more"><a href="/actions/{$cur.id}/">Подробнее</a></div>
                            </div>
                             <div class="clear"></div>
                         </div>
                    {/foreach}
                </div>
                {/if}
                <div class="clear"></div>
                  
            </div>
		
		
		
		
	{/if}
		
{/capture}

{include file="common/base_page.tpl"}