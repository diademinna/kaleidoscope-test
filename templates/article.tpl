{capture name="content"}

	{if $data_article} {* Список элементов *}
	
		<h1>Статьи</h1>
		
		{foreach from=$data_article item=cur name=loop}
				<div class="article_item">
					
					{*<div class="img">*}
						{if $cur.ext}
							<a href="/uploaded/article/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1);" onfocus="this.blur()"><img src="/uploaded/article/{$cur.id}_sm.{$cur.ext}" class="img" align="left" /></a>
							<div class="highslide-caption"><b>{$cur.name}</b></div>
						{else}
							<img src="/img/no_photo.png" class="img" align="left" />
						{/if}
					{*</div>*}
					
					<div class="info">
						<div class="name">{$cur.name}</div>
						<div class="anons">{$cur.anons}</div>
						<div class="more"><a href="/article/{$cur.id}/">подробнее</a></div>
					</div>
					
					<div class="clear"></div>
				</div>
		{/foreach}
		<div class="clear"></div>
		
		{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
		
	{else} {* Один элемент *}

		<div class="navigation"><a href="/">Главная</a>  <a href="/article/">Статьи</a></div>
		<h1>{$data_item.name}</h1>
		
		{if $data_item}
			<div class="article_item_one">
				
				<div class="img">
					{if $data_item.ext}
						<a onclick="return hs.expand(this)" href="/uploaded/article/{$data_item.id}.{$data_item.ext}"><img src="/uploaded/article/{$data_item.id}_sm.{$data_item.ext}" align="left" /></a>
					{/if}
				</div>

				<div class="user_content">{$data_item.text}</div>
			</div>
			<div class="clear"></div>
			
					
			
			{if $data_photo_goriz || $data_photo_vert}  {* ФОТОГАЛЕРЕЯ *}
				<div class="gallery">
					<center>
						{if $data_photo_goriz}
							{foreach from=$data_photo_goriz item=cur name="loop_g"}
								<div class="item">
									<a href="/uploaded/article/{$cur.id_article}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/article/{$cur.id_article}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
									<div class="highslide-caption">{$cur.name}</div>
									<div class="name">{$cur.name}</div>
								</div>
								{if $smarty.foreach.loop_g.iteration%3==0}<div class="clear"></div>{/if}
							{/foreach}
							<div class="clear"></div>
						{/if}
						
						{if $data_photo_vert}
							{foreach from=$data_photo_vert item=cur name="loop_v"}
								<div class="item vert">
									<a href="/uploaded/article/{$cur.id_article}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/article/{$cur.id_article}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
									<div class="highslide-caption">{$cur.name}</div>
									<div class="name">{$cur.name}</div>
								</div>
								{if $smarty.foreach.loop_v.iteration%4==0}<div class="clear"></div>{/if}
							{/foreach}
							<div class="clear"></div>
						{/if}
					</center>
				</div>
			{/if}

			
		{/if}
		
		
	{/if}
		
{/capture}

{include file="common/base_page.tpl"}