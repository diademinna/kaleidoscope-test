{capture name="content_name"}
	Редактировать - Пользователи
{/capture}

{capture name="content"}
<div class="ibox-title">
    <h5>Форма для добавления / редактирования профиля пользователя</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {include file="common/errors_block.tpl"}
        <div class="form-group">
            <label class="col-sm-2 control-label">Имя :</label>
            <div class="col-sm-10">
                <input name="name" class="form-control" type="text" value="{$data.name}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Фамилия :</label>
            <div class="col-sm-10">
                <input name="last_name" class="form-control" type="text" value="{$data.last_name}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Логин :</label>
            <div class="col-sm-10">
                <input name="login" class="form-control" type="text" value="{$data.login}" />
            </div>
        </div>
        {if $action=="edit"}
        <div class="form-group">
            <label class="col-sm-2 control-label">Пароль (свертка) :</label>
            <div class="col-sm-10">
                <input name="password" id="password" readonly class="form-control" type="password" value="{$data.password}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Установить Новый пароль :</label>
            <div class="col-sm-10">
                <input name="new_password" id="new_password" class="form-control" value="{$data.new_password}" />
            </div>
        </div>
        {else}
        <div class="form-group">
            <label class="col-sm-2 control-label">Пароль :</label>
            <div class="col-sm-10">
                <input name="password" id="password" class="form-control" value="{$data.password}" />
            </div>
        </div>
        {/if}
        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" value="{$data.email}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Телефон :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" value="{$data.phone}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Город :</label>
            <div class="col-sm-10">
                <input name="city" class="form-control" value="{$data.city}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Адрес :</label>
            <div class="col-sm-10">
                <input name="address" class="form-control" value="{$data.address}" />
            </div>
        </div>
        {if $action=="edit"}
            <div class="form-group">
                <label class="col-sm-2 control-label">Дата регистрации:<br />(2012-12-31)</label>
                <div class="col-sm-10"><textarea name="date" id="date">{$data.date}</textarea></div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Последний визит:<br />(2012-12-31)</label>
                <div class="col-sm-10"><textarea name="last_visit" id="last_visit" readonly>{$data.last_visit}</textarea></div>
            </div>
           <!--- <div class="form-group">
                <div class="checkbox">
                    <label class="col-sm-2 control-label">Активность :</label>
                    <div class="col-sm-10"><input id="male{$cur.id}" type="checkbox" name="my_checkbox" value="{$data.activate}" {if $data.activate==1}checked{/if}>
                    <label class="label_checkbox" for="male{$cur.id}"></label></div>
                </div>
            </div>-->
        {/if}
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="submitted" value="1" />
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
        <input type="hidden" name="action" value="{$action}">
        <input type="hidden" name="id" value="{$data.id}">
    </form>
</div>
			
{/capture}

{include file="admin/common/base_page.tpl"}