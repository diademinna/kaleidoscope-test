{capture name="content"}

    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Смена пароля
        </div>
        <br />
        {include file="common/errors_block.tpl"}
        {if $smarty.get.note=='save'}
		<br/><br/><br/><div style="text-align:center;"><b>Пароль изменен!</b></div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	{else}
            <form action="" method="post">
                <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
                    <div class="form-login-row">
                        <div class="form-login-label big">Текущий пароль: </div>
                        <div class="form-login-input"><input type="text" name="cur_password" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <div class="form-login-label big">Новый пароль: </div>
                        <div class="form-login-input"><input type="password" name="new_password" value="{$new_password|htmlspecialchars}" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <div class="form-login-label big">Повтор нового пароля: </div>
                        <div class="form-login-input"><input type="password" name="new_password_rep" value="{$new_password_rep|htmlspecialchars}" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-login-row">
                        <input type="hidden" name="submitted" value="1" />
                        <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
                    </div>
                </div>
            </form>
        {/if}
    </div>

    
	
	
{/capture}

{include file="common/base_page.tpl"}