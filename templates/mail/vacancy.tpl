ВАКАНСИИ<br/><br/>

Вакансия: {$tdata.vacancy_name} <br/>
Описание вакансии: {$tdata.vacancy_text}<br/><br/>

------------------------------------<br/>
ДАННЫЕ СОИСКАТЕЛЯ<br/>
ФИО: {$tdata.fio} <br/>
{if $tdata.phone}Телефон: {$tdata.phone} <br/>{/if}
{if $tdata.email}E-mail: {$tdata.email} <br/>{/if}
{if $tdata.ext}Прикрепленный файл: {$tdata.BASE_URL}uploaded/vacancy/{$tdata.id_new}.{$tdata.ext} <br/>{/if}
{if $tdata.message}Сообщение: {$tdata.message} <br/>{/if}