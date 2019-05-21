<?php
/**
 * 用户中心
**/
require './check_login.php';
$SM->assign('forward', $db->query("SELECT * FROM `forward` WHERE `uid`='{$USER['id']}'"));
$SM->display('user_index.tpl');
