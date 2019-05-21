<?php
/**
 * 检查登陆
**/
require '../main.inc.php';
if(isset($_COOKIE['user_id'], $_COOKIE['user_key'])){
  $USER['id'] = (int)$_COOKIE['user_id'];
  $RESULT = $db->query("SELECT * FROM `user` WHERE `id`='{$USER['id']}'");
  if($RESULT->num_rows > 0){
    $USER = $RESULT->fetch_array(MYSQLI_ASSOC);
    if(md5($USER['email'].$USER['time'].$USER['pass']) != $_COOKIE['user_key']){
      $msg = '登陆超时，请重新登陆';
    }
    $USER['time'] = date('Y-m-d H:i:s',$USER['time']);
    $USER_STATUS = array('待验证', '正常', '封禁');
    $USER['status_text'] = $USER_STATUS[$USER['status']];
    if(in_array($USER['id'], $config['admin_list'])){
      $USER['admin'] = $USER['id']===1 ? 1 : 2;
    }
  }else{
    $msg = '帐户异常，请重新登陆';
  }
}else{
  $msg = '您还未登陆，请先登陆';
}
if(isset($msg)){
  header("Location: ../user/login.php?msg=".$msg);
  //$SM->assign('msg', $msg);
  //$SM->display('error.tpl');
  exit;
}
$SM->assign('user', $USER);
