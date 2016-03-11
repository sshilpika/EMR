<?php
function html($text)
{
return htmlspecialchars($text, ENT_QUOTES,'UTF-8');
}
function htnlout($text){
echo html($text);
}