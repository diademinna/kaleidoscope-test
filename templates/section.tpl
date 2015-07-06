{capture name="content"}
	
	{if $data_subsection} {* ПОДРАЗДЕЛ раздела *}
			
		
	{else}  {* ПРОСТО СТРАНИЦА *}
		
		{* перекладывает данные чтобы не дублировать верстку *}
		{assign var="data_subsection" value=$data_section}
		
	{/if}
	
	<h1>{$data_subsection.name}</h1>
	
	<div class="standart_block user_content">
		{if $data_subsection.ext}
			<div class="img"><a onclick="return hs.expand(this, config1)" onfocus="this.blur()" href="/uploaded/section/{$data_subsection.id}.{$data_subsection.ext}" align="left"><img src="/uploaded/section/{$data_subsection.id}_sm.{$data_subsection.ext}" class="border" /></a></div>
		{/if}
		
		{$data_subsection.text}
	</div>
	<div class="clear"></div>
	
	
	{if $data_photo_goriz || $data_photo_vert}    {* ФОТОГАЛЕРЕЯ *}
		<br />
		<div class="gallery">
			<center>
				{if $data_photo_goriz}
					{foreach from=$data_photo_goriz item=cur name="loop_g"}
						<div class="item">
							<a href="/uploaded/section/{$cur.id_section}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/section/{$cur.id_section}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
							<div class="highslide-caption">{$cur.name}</div>						
							<div class="name">{$cur.name}</div>					
						</div>
						{if $smarty.foreach.loop_g.iteration%2==0}<div class="clear"></div>{/if}
					{/foreach}
					<div class="clear"></div>
				{/if}

				{if $data_photo_vert}
					{foreach from=$data_photo_vert item=cur name="loop_v"}
						<div class="item vert">							
							<a href="/uploaded/section/{$cur.id_section}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/section/{$cur.id_section}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" />
							</a>
							<div class="highslide-caption">{$cur.name}</div>						
							<div class="name">{$cur.name}</div>						
						</div>
						{if $smarty.foreach.loop_v.iteration%3==0}<div class="clear"></div>{/if}
					{/foreach}
					<div class="clear"></div>
				{/if}
			</center>
		</div>
	{/if}
		
		
		{*		
			.standart_block .img{float:left; padding:0; margin:0 30px 10px 0;}
			.standart_block .img img{margin:0;}
			.standart_block .text{margin:0 0 20px 0;}


			.gallery .item{display:inline-block; font-size:0; letter-spacing:-1px; line-height:0; margin:0 13px 32px 13px; position:relative; text-align:center; width:291px; vertical-align:top;}
			.gallery .item img{margin:0; padding:0; border:5px solid #E6E6E6; border-radius:4px 4px 4px 4px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.55);}
			.gallery .item img:hover{}
			.gallery .item .name{letter-spacing:0; line-height:14px; font-size:14px; color:#111111; padding:10px 0 0 0;}
			.gallery .item.vert{margin: 0 18px 32px 18px; width:200px;}
		*}
	
{/capture}

{include file="common/base_page.tpl"}