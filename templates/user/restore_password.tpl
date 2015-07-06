{capture name="content"}
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Восстановление пароля
        </div>
        <br />
        {include file="common/errors_block.tpl"}<br/>
        <form action="" method="post">
            <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
                <div class="form-login-row">
                    <div class="form-login-label big">Ваш E-mail: </div>
                    <div class="form-login-input"><input type="text" name="email" value="{$email}" /></div>
                    <div class="clear"></div>
                </div>
                <div class="form-login-row">
                    <input type="hidden" name="submitted" value="1" />
                    <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
                </div>
            </div>
        </form>
        <br/><br/>
	<p style="text-align:center;font-size:14px;font-weight:bold;">{if $result}{$result}{/if}</p>
	<br/><br/>
    </div>

	
		
	
	

{/capture}

{include file="common/base_page.tpl"}