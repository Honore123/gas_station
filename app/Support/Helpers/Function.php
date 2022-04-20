<?php
function setActive($path, $active = 'active')
{
    return call_user_func_array('Request::is',(array) $path) ? $active:'';
}
function menuOpen($path, $menuOpen = 'menu-open'){
    return call_user_func_array('Request::is',(array)$path) ? $menuOpen:'';
}
