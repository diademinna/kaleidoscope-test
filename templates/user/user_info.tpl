{capture name="content"}
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Личный кабинет
        </div>
         <br />
         <div class="container-new_user">
            <table>
                <tr>
                    <td>Имя</td>
                    <td>Имя</td>
                </tr>
            </table>
         </div>
         <div class="clear"></div>
    </div>
	<h1>{if $user.id == $data.id}Личный кабинет{else}Профиль участника{/if}</h1>

	<div class="profile">
	
		<div class="prof_l">
			<div class="zag">{if $user.id == $data.id}Мой профиль{else}Профиль{/if}</div>
			<div class="login">{$data.login}</div>
			<div>{if $data.avatar}<img src="/uploaded/user/{$data.id}.{$data.avatar}?{$rand_new}" />{else}<img src="/img/no_avatar.png" />{/if}</div>
			{if $user.id == $data.id}<div><a href="/user/{$data.id}/">Загрузить аватар</a></div>{/if}	
		</div>		
		
		<div class="prof_r">
		
				<p>ФИО: {$data.name}</p>
				<p>E-mail: {$data.email}</p>			 	
				<p>Пол: {if $data.sex==1}мужской{elseif $data.sex==2}женский{else}не указан{/if}</p>
				{if $data.dob AND $data.dob!="0000-00-00"}<p>День рождения: {$data.dob|date_format:"%d-%m-%Y"}</p>{/if}
				{if $data.city}<p>Город: {$data.city}</p>{/if}				
				{if $data.site}<p>Сайт: <noindex><a href="{$data.site}" target="_blank" rel="nofollow">{$data.site}</a></noindex></p>{/if}
				{if $data.skype}<p>Skype: {$data.skype}</p>{/if}
				{if $data.icq}<p>ICQ: {$data.icq}</p>{/if}
				{if $data.tel}<p>Телефон: {$data.tel}</p>{/if}
				{if $data.address}<p>Адрес: {$data.address} </p>{/if}
				
				{if $data.about}<p>О себе: {$data.about}</p>{/if}
				
				<p>Дата регистрации: {$data.date|date_format:"%d-%m-%Y"}</p>
				<p>Дата последнего посещения: {$data.last_visit|date_format:"%d-%m-%Y"}</p>
				{if $user.id == $data.id}
					<p><a href="/user/{$data.id}/">Редактировать личные данные</a></p>
					<p><a href="/change_password/">Изменить пароль</a></p>
				{/if}
		</div>
		
	</div>

{/capture}

{include file="common/base_page.tpl"}