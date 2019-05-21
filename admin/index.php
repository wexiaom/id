<?php
/**
 * 管理员后台
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $SM->assign('user_num', $db->query("SELECT `id` FROM `user`")->num_rows);
  $SM->assign('domain_num', $db->query("SELECT `id` FROM `forward`")->num_rows);
}else{
  header('Location: ../user');
  exit;
}
$SM->display('admin_index.tpl');
