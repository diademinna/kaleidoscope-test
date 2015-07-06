Здравствуйте!<br/><br/>

Вы успешно зарегистрированы на сайте {$tdata.servak}, Ваш аккаунт создан.<br/><br/>

Для активации Вашего аккаунта, пожалуйста, перейдите по данному адресу http://{$tdata.servak}/activate/?checkSum={$tdata.checkSum}&id={$tdata.id}<br/>
Ссылка для активации вашего аккаунта будет доступна в течение трех суток.<br/><br/>

Ваши данные для авторизации <br/>
{if $tdata.login}Логин: {$tdata.login}{/if} <br/>
{if $tdata.password}Пароль: {$tdata.password}{/if}