<?php
require_once 'util/BBCode.class.php';
function smarty_modifier_bbcode($string, $enableCut = false, $blog_id = false) {
    return BBCode::forBlog($string, $enableCut, $blog_id);
}