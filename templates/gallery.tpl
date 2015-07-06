{capture name="content"}

	{if $data_gallery} {* СПИСОК ЭЛЕМЕНТОВ *}
	
		<h1>Галерея</h1>
		
		<div class="gallery_block">
			<div class="gallery">
		
				{foreach from=$data_gallery item=cur name=loop}
					<div class="item">
						<a href="/gallery/{$cur.id}/"><img src="/uploaded/gallery/{$cur.id}_sm.{$cur.ext}" /></a>
						<div class="name"><a href="/gallery/{$cur.id}/">{$cur.name}</a></div>
						{if $smarty.foreach.loop.iteration%4==0}<div class="clear"></div>{/if}
					</div>
				{/foreach}
				<div class="clear"></div>
			</div>
			
			{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}
			
		</div>
			
			
		{*
		
		.gallery_block .gallery .item{width:291px; margin: 0 13px 32px; display: inline-block;}
		.gallery_block .gallery .item img {border:5px solid #E6E6E6; border-radius: 6px 6px 6px 6px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.55);}

		.gallery_block .gallery .item .name{padding:9px 0 0 0; color:#111111;  font-size:15px;}
		.gallery_block .gallery .item .name a{color: #111111; font-family:OpenSans-CondensedBold; font-size:17px; -webkit-transition:opacity 0.3s ease-in-out 0s; text-decoration:none;
			   -moz-transition:color 0.3s linear 0s;
				 -o-transition:color 0.3s linear 0s;
					transition:color 0.3s linear 0s;
		}
		.gallery_block .gallery .item .name a:hover{color:#FA0179;}

		.gallery_block .gallery .item.vert{width:200px; margin: 0 18px 32px;}
		.gallery_block .gallery .item.vert a{text-decoration:none;}
		
		*}
			
		
	{else} {* ОДИН ЭЛЕМЕНТ *}
	
		<h1><a href="/gallery/">Галерея</a> / {$data_item.name}</h1>
		
		{if $data_item.text}
			<div class="gallery_item">
			{*
				{if $data_item.ext}
					<a onclick="return hs.expand(this, config1)" href="/uploaded/gallery/{$data_item.id}.{$data_item.ext}">
						<img src="/uploaded/gallery/{$data_item.id}_sm.{$data_item.ext}" />
					</a>
				{/if}
			*}	
				{$data_item.text}<br/>
			</div>
			<div class="clear"></div>
		{/if}
		
		
		
		<div class="gallery_block">
			{if $data_photo_goriz || $data_photo_vert}    {* ФОТОГАЛЕРЕЯ *}
				<div class="gallery">
					<center>
						{if $data_photo_goriz}
							{foreach from=$data_photo_goriz item=cur name="loop_g"}
								<div class="item">
									<a href="/uploaded/gallery/{$cur.id_gallery}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/gallery/{$cur.id_gallery}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
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
									<a href="/uploaded/gallery/{$cur.id_gallery}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/gallery/{$cur.id_gallery}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" />
									</a>
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
		</div>
		
		
		
	{/if}
		
{/capture}

{include file="common/base_page.tpl"}