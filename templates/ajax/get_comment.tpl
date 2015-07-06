{if $flag_first_ul && !$flag_last_ul}<ul class="comment_list">
{else if $flag_last_ul}</ul>
{else}
<li id="comm_{$cur.id}" class="a{if $cur_count}{$cur_count}{/if}">
<div class="name">
	<div class="avatar"></div>
	<div class="user_name">{$cur.name}</div>
	<div class="date">{$cur.date|date_format:"%d.%m.%Y"} | <span>{$cur.date|date_format:"%H:%M"}</span></div>
	<div class="reply"><a onclick="AddFormaComm({$cur.id_blog}, {$cur.id}, 'internal'); return false;" href="">ответить</a></div>
</div>
<div class="text">{$cur.text}</div>
<div class="forma add_forma_comm_block" id="add_forma_comm_block_{$cur.id}" style="display:none;"></div>
</li>
{/if}