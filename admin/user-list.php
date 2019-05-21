<?php
/**
 * 用户列表
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $page['no'] = isset($_GET['page'])&&$_GET['page']>=1 ? (int)$_GET['page'] : 1;
  $page['number'] = 20;
  $start_num = ($page['no']-1) * $page['number'];
  $Result = $db->query($sql="SELECT * FROM `user` LIMIT $start_num, {$page['number']}");
  if($Result->num_rows > 0){
    $rows_status = array('0'=>'待激活','1'=>'正常','2'=>'封禁');
    while($Res = $Result->fetch_array(MYSQLI_ASSOC)){
      $Res['time'] = date('Y-m-d H:i:s', $Res['time']);
      $Res['status'] = $rows_status[$Res['status']];
      $rows[] = $Res;
    }
    $SM->assign('rows', $rows);
    $page['rows'] = $db->query("SELECT `id` FROM `user`")->num_rows; //总条数
    $page['pages'] = ceil($page['rows']/$page['number']<1?1:$page['rows']/$page['number']); //总页数
    $SM->assign('page', $page);
  }else{
    $result = array(
      'status' => '0',
      'msg' => '目前还没有已注册用户'
    );
  }
}else{
  header('Location: ../user');
  exit;
}
isset($result) && $SM->assign('result', $result);
$SM->display('admin_user_list.tpl');
