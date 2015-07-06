{capture name="content_h1"}
	<h1>Теги</h1>
{/capture}

	
{capture name="content_navigation"}
	<div class="item">Теги</div>
{/capture}
	

{capture name="content"}

	<div class="blue_line">
		<div class="content content_padding content_min_height">
		<div class="tags_all_block">
			{foreach from=$data_blog_tag item=cur name=loop}
				<a href="/blog/tag/{$cur.id_blog_tag}/" class="tf{$cur.tf}">{$cur.tag_name}</a>  &nbsp;&nbsp;&nbsp;&nbsp; 
			{/foreach}
			<div class="clear"></div>
		</div>
		</div>
		</div>

{/capture}

{include file="common/base_page.tpl"}