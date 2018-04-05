<?php

require_once("Smarty/libs/Smarty.class.php");

$smarty = new Smarty();
$smarty->escape_html = true;

// Nur notwendig, wenn andere Namen gewünscht
//$Smarty->template_dir = "new_templates_dir";
//$Smarty->compile_dir = "new_templates_c";

$smarty->assign("name", "John Doe");
$smarty->assign("message", "I'm back baby!");
$smarty->display("message.tpl");
