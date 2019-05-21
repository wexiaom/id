<?php
/**
 * 用户密码修改文件
**/
require './check_login.php';
if(isset($_POST['new_pass'], $_POST['new_password'], $_POST['password'])){
  if($_POST['new_pass'] != $_POST['new_password']){
    $result = array(
      'status' => '0',
      'msg' => '两次输入的新密码不一致'
    );
  }elseif($USER['pass'] != md5($_POST['password'])){
    $result = array(
      'status' => '0',
      'msg' => '密码错误'
    );
  }elseif($db->query("UPDATE `user` SET `pass`='".md5($_POST['new_pass'])."' WHERE `id`='{$USER['id']}'")){
    $result = array(
      'status' => '1',
      'msg' => '密码修改成功'
    );
  }else{
    $result = array(
      'status' => '1',
      'msg' => '修改失败'
    );
  }
  $SM->assign('result', $result);
}
$SM->display('user_password_edit.tpl');
