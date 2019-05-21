<?php
/**
 * 域名详情文件
**/
require '../user/check_login.php';
require ROOT.'/inc/idna_convert.class.php';
if(isset($_GET['id'])){
  $id = (int)$_GET['id'];
  $Result = $db->query("SELECT * FROM `forward` WHERE `id`='$id'");
  if($Result->num_rows < 1){
    $result = array(
      'status' => '2',
      'msg' => '未找到该域名'
    );
  }else{
    $Res = $Result->fetch_array(MYSQLI_ASSOC);
    $Res['time'] = date('Y-m-d H:i:s', $Res['time']);
  }
}else{
  $result = array(
    'status' => '2',
    'msg' => '请返回选择要查看的域名'
  );
}

isset($Res) && $SM->assign('Res', $Res);
isset($result) && $SM->assign('result', $result);
$SM->display('admin_forward_info.tpl');