{capture name="content"}

	{if $data_news} {* Список элементов *}
			
		<h1>Новости</h1>
		
		<div class="news">
			{foreach from=$data_news item=cur}
				<div class="news_item">
					<div class="name">{if $cur.anons}<a href="/news/{$cur.id}/">{$cur.name}</a>{else}{$cur.name}{/if} </div>
					
					{if $cur.ext}
						<div class="img"><a onclick="return hs.expand(this, config1)" onfocus="this.blur()" href="/uploaded/news/{$cur.id}.{$cur.ext}" align="left"><img src="/uploaded/news/{$cur.id}_sm.{$cur.ext}" /></a></div>
					{/if}
					
					<div class="date">Дата: {$cur.date|date_format:"%d.%m.%Y"}</div>
					
					{if $cur.anons}
						<div class="text user_content">{$cur.anons}</div>
						<div class="more"><a href="/news/{$cur.id}/">подробнее</a></div>
					{else}
						<div class="text user_content">{$cur.text}</div>
					{/if}
				</div>
				<div class="clear"></div>
				
				
				
				{if $cur.photo_goriz || $cur.photo_vert}  {* ФОТОГАЛЕРЕЯ *}
					<div class="gallery">
						<center>
							{if $cur.photo_goriz}
								{foreach from=$cur.photo_goriz item=cur_g  name=loop_g}
									<div class="item">
										<a href="/uploaded/news/{$cur_g.id_news}/{$cur_g.id}.{$cur_g.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/news/{$cur_g.id_news}/{$cur_g.id}_sm.{$cur_g.ext}" title="{$cur_g.name}" /></a>
										<div class="highslide-caption">{$cur_g.name}</div>
										<div class="name">{$cur_g.name}</div>
									</div>
									{if $smarty.foreach.loop_g.iteration%3==0}<div class="clear"></div>{/if}
								{/foreach}
								<div class="clear"></div>
							{/if}

							{if $cur.photo_vert}
								{foreach from=$cur.photo_vert item=cur_v  name=loop_v}
									<div class="item vert">
										<a href="/uploaded/news/{$cur_v.id_news}/{$cur_v.id}.{$cur_v.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/news/{$cur_v.id_news}/{$cur_v.id}_sm.{$cur_v.ext}" title="{$cur_v.name}" /></a>								
										<div class="highslide-caption">{$cur_v.name}</div>
										<div class="name">{$cur_v.name}</div>
									</div>
									{if $smarty.foreach.loop_v.iteration%4==0}<div class="clear"></div>{/if}
								{/foreach}
								<div class="clear"></div>
							{/if}
						</center>
					</div>
				{/if}
				
				
				
				
				{*				
				.gallery{}
				.gallery .item{display:inline-block; font-size:0; letter-spacing:-1px; line-height:0; margin:0 9px 12px 9px; position:relative; text-align:center; width:283px; vertical-align:top;}
				.gallery .item img{margin:0; padding:0; border:9px solid #f7f2ef; border-radius:4px 4px 4px 4px; box-shadow:0 2px 5px rgba(0,0,0,.3);}
				.gallery .item img:hover{}
				.gallery .item .name{letter-spacing:0; line-height:14px; font-size:14px; padding:5px 0 6px 0;}
				.gallery .item.vert{margin:0 7px 12px 7px; position:relative; width:210px;}
				*}
				
				
				
			{/foreach}
			
			{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
		</div>
		
		{*
			.news .news_item{margin:20px 0 6px 0;}
			.news .news_item .img{float:left; padding:4px 22px 10px 0;}
			.news .news_item .img img{border:3px solid #fff; border-radius:3px 3px 3px 3px; box-shadow: 0px 0px 3px #777;}
			.news .news_item .name{padding:0 0 10px 0; font-size:16px;}
			.news .news_item .name a{font-weight:bold; text-decoration:none; font-size:16px;}
			.news .news_item .name a:hover{text-decoration:underline;}
			.news .news_item .date{color:#868686; padding:0 0 6px 0; font-size:12px;}
			.news .news_item .text{min-height:50px;  margin:0 0 12px 0;}
			.news .news_item .more{text-align:right;}
			.news .news_item .more a{}
			.news .news_item .more a:hover{}
		*}
		
		
	{else} {* Один элемент *}

		<h1>{$data_item.name}</h1>
		
		{if $data_item}
			<div class="news_one">
				<div class="date">Дата: {$data_item.date|date_format:"%d.%m.%Y"}</div>
				{if $data_item.ext}
					<div class="img"><a onclick="return hs.expand(this, config1)" href="/uploaded/news/{$data_item.id}.{$data_item.ext}" align="left"><img src="/uploaded/news/{$data_item.id}_sm.{$data_item.ext}" /></a></div>
				{/if}
				<div class="text user_content">{$data_item.text}</div>
			</div>
			<div class="clear"></div>
		{/if}
		
		
		
		{if $data_photo_goriz || $data_photo_vert}  {* ФОТОГАЛЕРЕЯ *}
			<div class="gallery">
				<center>
					{if $data_photo_goriz}
						{foreach from=$data_photo_goriz item=cur name=loop_g}
							<div class="item">
								<a href="/uploaded/news/{$cur.id_news}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/news/{$cur.id_news}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
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
								<a href="/uploaded/news/{$cur.id_news}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/news/{$cur.id_news}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
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
			
		
		{*		
			.news_one .img{float:left; padding:4px 22px 10px 0;}
			.news_one .img img{border:3px solid #fff; border-radius:3px 3px 3px 3px; box-shadow: 0px 0px 3px #777;}
			.news_one .name{padding:0 0 10px 0; font-size:16px;}
			.news_one .date{color:#868686; padding:12px 0 12px 0; font-size:12px;}
			.news_one .text{margin:0 0 20px 0;}
		*}
		
		
	{/if}
		
{/capture}

{include file="common/base_page.tpl"}