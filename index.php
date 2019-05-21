<?php
require './main.inc.php';
isset($_COOKIE) && $SM->assign('_COOKIE', $_COOKIE);
$SM->display('index.tpl');