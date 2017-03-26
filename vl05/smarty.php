<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

// Nur notwendig, wenn andere Namen gewünscht
//$smarty->template_dir = "new_templates_dir";
//$smarty->compile_dir = "new_templates_c";

$smarty->assign("name", "John Doe");
$smarty->assign("message", "I'm back baby!");
$smarty->display("message.tpl");
