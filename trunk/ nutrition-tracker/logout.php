<?php
require("config/config.php");

unset($_SESSION['user_info']);
unset($_COOKIE['remember']);

$smarty->clear_cache('index.tpl');
$smarty->display('index.tpl');
?>