<?php
require "config/config.php";
require "lib/stats.class.php";

$stats = new Stats;
$cals = $stats->worstFoodsByCalories();

$smarty->assign("cals", $cals);
$smarty->clear_cache('index');
$smarty->display("index.tpl");
?>