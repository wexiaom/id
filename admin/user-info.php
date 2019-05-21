<?php
/**
 * 用户详情信息
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $id = (int)$_GET['id'];
  $Result = $db->query("SELECT * FROM `user` WHERE `id`='$id'");
  if($Result->num_rows > 0){
    $Res_status = array('0'=>'待激活','1'=>'正常','2'=>'封禁');
    $Res = $Result->fetch_array(MYSQLI_ASSOC);
    $Res['time'] = date('Y-m-d H:i:s', $Res['time']);
    $Res['status'] = $Res_status[$Res['status']];
    $SM->assign('Res', $Res);
  }else{
    $result = array(
      'status' => '0',
      'msg' => '要查看的用户不存在'
    );
  }
}else{
  header('Location: ../user');
  exit;
}
isset($result) && $SM->assign('result', $result);
$SM->display('admin_user_info.tpl');