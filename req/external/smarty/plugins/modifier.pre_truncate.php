<?php
// удаляет все html теги и переводит html-сущности в обычные знаки
function smarty_modifier_pre_truncate($string)
{
    $string =strip_tags($string);
    return html_entity_decode($string);

} 

?>
