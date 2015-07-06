{foreach from=$rand_blog_tag item=cur name=loop}
<a href="/blog/tag/{$cur.id_blog_tag}/" class="tf{$cur.tf}">{$cur.tag_name}</a> &nbsp;&nbsp;&nbsp;&nbsp;
{/foreach}