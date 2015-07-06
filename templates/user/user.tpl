{capture name="content"}
<div class="container-login">
    <div class="navigation">
        <a href="/"><i class="fa fa-home"></i></a>
        <i class="fa fa-chevron-right"></i>Редактирование профиля
    </div>
    <br />
    {include file="common/errors_block.tpl"}
    {if $smarty.get.note=='save'}<div style="text-align:center;font-size:14px;"><b>Сохранено</b></div><br />{/if}
    <form action="" method="post" enctype="multipart/form-data">
        <div class="login-new-heading_content" style="padding-bottom: 4px; border-bottom: none;">
            <div class="form-login-row">
                <div class="form-login-label big">Ваше имя: </div>
                <div class="form-login-input"><input type="text" name="name" value="{$data.name}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваша фамилия: </div>
                <div class="form-login-input"><input type="text" name="last_name" value="{$data.last_name}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Название компании: </div>
                <div class="form-login-input"><input type="text" name="name_company" value="{$data.name_company}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш E-mail: </div>
                <div class="form-login-input"><input type="text" name="email" value="{$data.email}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш телефон: </div>
                <div class="form-login-input"><input type="text" name="phone" value="{$data.phone}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш город: </div>
                <div class="form-login-input"><input type="text" name="city" value="{$data.city}" /></div>
                <div class="clear"></div>
            </div>
            <div class="form-login-row">
                <div class="form-login-label big">Ваш адрес: </div>
                <div class="form-login-input"><input type="text" name="address" value="{$data.address}" /></div>
                <div class="clear"></div>
            </div>
                <br />
            <div class="form-login-row">
                <input type="hidden" name="submitted" value="1" />
                <button class="button-in-cart" style="width:150px; text-align: center; border:none; padding:10px 0; margin-left:200px; cursor:pointer;"></i>Сохранить</button>
            </div>
        </div>
    </form>
</div>

		
				
		
				
		


{/capture}

{include file="common/base_page.tpl"}











