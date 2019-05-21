<?php
/**
 * 用户删除
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $id = (int)$_GET['id'];
  if(!isset($_GET['id']) || empty($_GET['id'])){
    $result = array(
      'status' => '0',
      'msg' => '请选择要删除的用户'
    );
  }elseif($id == $USER['id']){
    $result = array(
      'status' => '0',
      'msg' => '你不能删除自己'
    );
  }elseif($id == '1'){
    $result = array(
      'status' => '0',
      'msg' => '该帐户不能删除'
    );
  }elseif($USER['admin']=='2' && in_array($id, $config['admin_list'])){
    $result = array(
      'status' => '0',
      'msg' => '你无权删除该帐户'
    );
  }elseif($db->query("DELETE FROM `user` WHERE `id`='$id'")){
    $result = array(
      'status' => '1',
      'msg' => '删除成功'
    );
  }else{
    $result = array(
      'status' => '0',
      'msg' => '删除失败'
    );
  }
}else{
  header("Location: ../user/");
  exit;
}
$SM->assign('result', $result);
$SM->display('admin_user_delete.tpl');
