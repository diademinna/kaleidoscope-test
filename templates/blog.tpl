{capture name="content"}
	
	
	{if $flag_tag}  {* H1 *}
		<h1>Тег: {$data_tag_name}</h1>
	{else}	
		{if $flag_1ur} {* 1 уровень - список всех новостей в выбранном блоге *}
			<h1>{$data_blog.name}</h1>
		{elseif $flag_2ur} {* 2 уровень - выбранная новость *}
			<h1 style="font-size: 24px;">{$data_item.name}</h1>
		{/if}
	{/if}
	
	
	
	<div class="navigation"> {* NAVIGATION *}
		<div class="item"><a href="/">Главная</a></div>
		<div class="sep"></div>
		{if $flag_tag}
			<div class="item"><a href="/tags/">Все теги</a></div>
			<div class="sep"></div>
			<div class="item">{$data_tag_name}</div>
		{else}
			{if $flag_1ur} {* 1 уровень - список всех новостей в выбранном блоге *}				
				<div class="item">{$data_blog.name}</div>
			{elseif $flag_2ur} {* 2 уровень - выбранная новость *}
				<div class="item"><a href="/blog/{$data_blog.url}/">{$data_blog.name}</a></div>
				<div class="sep"></div>
				<div class="item">{$data_item.name}</div>
			{/if}
		{/if}
		<div class="clear"></div>
	</div>
	
	<br />
		
	<div class="content content_padding">

		<div class="col_left">  {* ЛЕВАЯ КОЛОНКА - новости *}
			<div class="news_block">

				{if $flag_1ur}  {* СПИСОК ВСЕХ НОВОСТЕЙ В ВЫБРАННОМ БЛОГЕ *}

					{foreach from=$data_subblog item=cur name=loop}
						{assign var="cur_blog" value=$cur.id}
						<div class="item blog">
							<div class="name">{$cur.name}</div>
							{if $cur.ext}
								{if $cur.anons}<a href="/blog/{if $flag_tag}{$cur.url_parent}{else}{$data_blog.url}{/if}/{$cur.url}/" class="img"><img src="/uploaded/blog/{$cur.id}_sm.{$cur.ext}"></a>{else}<img src="/uploaded/blog/{$cur.id}_sm.{$cur.ext}">{/if}
							{/if}
							<div class="text_block">
								<div class="anons">{if $cur.anons}{$cur.anons}{else}{$cur.text}{/if}</div>
								<div class="info">
									<div class="info_row"><span>Дата:</span> {$cur.date|date_format:"%d "}
	{assign var="num_month" value={$cur.date|date_format:"%m"}} {$MN.$num_month} '{$cur.date|date_format:"%y"}</div>
									<div class="info_row"><span>Комментарии:</span> {$data_blog_comment_count.$cur_blog|default:'0'}</div>
									{if $cur.anons}<div class="more"><a href="/blog/{if $flag_tag}{$cur.url_parent}{else}{$data_blog.url}{/if}/{$cur.url}/">подробнее <span>&nbsp;</span></a></div>{/if}
									
									<div class="tags_block">
										{foreach from=$data_blog_tag.$cur_blog item=cur2}
											<a href="/blog/tag/{$cur2.id}/">{$cur2.name}</a> | 
										{/foreach}
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<br /><br />
					{/foreach}

					{if $pager_string}<div class="pager_string">{$pager_string}</div>{/if}


				{elseif $flag_2ur}  {* ВЫБРАННАЯ НОВОСТЬ *}

					{if $data_item}

						<div class="blog_one">
							<div class="name">{$data_item.name}</div>
							{if $data_item.ext}
								<a onclick="return hs.expand(this)" href="/uploaded/blog/{$data_item.id}.{$data_item.ext}" class="img"><img src="/uploaded/blog/{$data_item.id}_sm.{$data_item.ext}" /></a>
							{/if}

							<div class="text_block">
								<div class="info">
									<div class="info_row"><span>Дата:</span> {$data_item.date|date_format:"%d "}
	{assign var="num_month" value={$data_item.date|date_format:"%m"}} {$MN.$num_month} '{$data_item.date|date_format:"%y"}</div>
									<div class="info_row"><span>Комментарии:</span> {$data_blog_comment_count}</div>
									<div class="clear"></div>
								</div>
								<div class="text user_content">{$data_item.text}</div>

								{if $data_photo_goriz || $data_photo_vert}  {* ФОТОГАЛЕРЕЯ *}
									<div class="gallery">
										<center>
											{if $data_photo_goriz}
												{foreach from=$data_photo_goriz item=cur name=loop_g}
													<div class="item">
														<a href="/uploaded/blog/{$cur.id_blog}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/blog/{$cur.id_blog}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
														<div class="highslide-caption">{$cur.name}</div>
														{if $cur.name}<div class="name">{$cur.name}</div>{/if}
													</div>
													{if $smarty.foreach.loop_g.iteration%3==0}<div class="clear"></div>{/if}
												{/foreach}
												<div class="clear"></div>
											{/if}

											{if $data_photo_vert}
												{foreach from=$data_photo_vert item=cur name="loop_v"}
													<div class="item vert">
														<a href="/uploaded/blog/{$cur.id_blog}/{$cur.id}.{$cur.ext}" onclick="return hs.expand(this, config1)"><img src="/uploaded/blog/{$cur.id_blog}/{$cur.id}_sm.{$cur.ext}" title="{$cur.name}" /></a>
														<div class="highslide-caption">{$cur.name}</div>
														{if $cur.name}<div class="name">{$cur.name}</div>{/if}
													</div>
													{if $smarty.foreach.loop_v.iteration%4==0}<div class="clear"></div>{/if}
												{/foreach}
												<div class="clear"></div>
											{/if}
										</center>
									</div>
								{/if}

								<div class="text user_content">{$data_item.text2}</div>

								<div class="clear"></div>
							</div>

							<br /><br />
							
							<div class="tags_block">
								<div class="start_tag">Теги: </div>
								{foreach from=$data_blog_tag item=cur name=loop}
									<a href="/blog/tag/{$cur.id}/">{$cur.name}</a>
								{/foreach}
							</div>


						</div>
						<div class="clear"></div>


						{*  ----------- COMMENT  ---------------- *}
						<script type="text/javascript" src="/js/comments/comments-1.0.js"></script>

						<script type="text/javascript" src="/js/scroll_to/jquery.scrollTo-min.js"></script>
						<script type="text/javascript">
							$(document).ready(function(){
								jQuery('.link_add_comment').click(function() {
									jQuery.scrollTo('#forma_comments', 350);
								});
							});
						</script>
						<br /><br />

						<div class="zag_comm" id="comments">Комментарии</div>
						{if $blog_comment}<div class="link_add_comment">Добавить комментарий</div>{/if}
						<div class="clear"></div>

						<div id="comments_block">
							{$blog_comment}
						</div>

						<br />
						<div class="forma_comments" id="forma_comments">
							<div class="zag_comm" style="font-size:20px;">Добавьте свой комментарий</div>
							<div class="clear"></div>
							<div class="forma add_forma_comm_block">
								{include file="ajax/add_forma_comm.tpl"}
							</div>
						</div>					
						<div class="clear"></div>			


						{* COMMENT - end *}

					{/if}

				{/if}  {* ВЫБРАННАЯ НОВОСТЬ - end *}

			</div>
		</div>


		<div class="col_right"> {* ПРАВАЯ КОЛОНКА - вспомогательная *}

			<div class="gray_col">
				<div class="text_block">
					<div class="zag">Теги</div>
					<div class="text tags_block tags_all_block">{include file="rebuild/static_tags.tpl"}<div class="more"><a href="/tags/">все теги</a></div></div>
				</div>

				<div class="sep"></div>


				{if $data_blog_last_news}
					<div class="text_block">
						<div class="zag">Советуем почитать</div>
						<div class="text">

							<div class="news_block_right">
								{foreach from=$data_blog_last_news item=cur name=loop}
									{assign var="cur_blog" value=$cur.id}
									<div class="item">
										<div class="date">{$cur.date|date_format:"%d "}{assign var="num_month" value={$cur.date|date_format:"%m"}} {$MN.$num_month} '{$cur.date|date_format:"%y"}</div>
										{if $cur.ext}

											<div class="img_block" style="background:transparent url('/uploaded/blog/{$cur.id}_sm.{$cur.ext}') no-repeat scroll 0 center; background-size:232px auto;"><a href="/blog/{$cur.url_parent}/{$cur.url}/" class="img"></a></div>
										{/if}
										<div class="text_block">
											<div class="name">{$cur.name}</div>
											<div class="more"><a href="/blog/{$cur.url_parent}/{$cur.url}/">подробнее <span>&nbsp;</span></a></div>
										</div>
									</div>
								{/foreach}
							</div>

						</div>
					</div>
				{/if}

			</div>

		</div>

		<div class="clear"></div>

	</div>


{/capture}

{include file="common/base_page.tpl"}