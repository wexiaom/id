<?php
/**
 * 用户密码修改文件
**/
require './check_login.php';
if(isset($_GET['id'])){
  $id = (int)$_GET['id'];
  $Result = $db->query("SELECT `uid` FROM `forward` WHERE `id`='$id'");
  if($Result->num_rows < 1){
    $result = array(
      'status' => '0',
      'msg' => '域名不存在，可能已被删除或未曾添加'
    );
  }elseif($Result->fetch_object()->uid != $USER['id']){
    $result = array(
      'status' => '0',
      'msg' => '这不是你的域名，不能删除'
    );
  }elseif(!$db->query("DELETE FROM `forward` WHERE `uid`='{$USER['id']}' AND `id`='$id'")){
    $result = array(
      'status' => '0',
      'msg' => '删除失败'
    );
  }else{
    $result = array(
      'status' => '1',
      'msg' => '删除成功'
    );
  }
  
}else{
  $result = array(
    'status' => '2',
    'msg' => '请返回选择要删除的域名'
  );
}
$SM->assign('result', $result);
$SM->display('user_forward_delete.tpl');
