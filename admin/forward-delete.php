<?php
/**
 * 域名转发记录删除
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $id = (int)$_GET['id'];
  if($db->query("DELETE FROM `forward` WHERE `id`='$id'")){
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
  $SM->assign('result', $result);
}else{
  header("Location: ../user/");
  exit;
}
$SM->display('admin_forward_delete.tpl');
