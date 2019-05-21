<?php
/**
 * 用户信息编辑
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $id = (int)$_GET['id'];
  if(!isset($_GET['id']) || empty($_GET['id'])){
    $result = array(
      'status' => '0',
      'msg' => '请选择要编辑的用户'
    );
  }elseif($USER['admin']=='2' && in_array($id, $config['admin_list']) && $USER['id']!=$id){
    $result = array(
      'status' => '0',
      'msg' => '你无权编辑该帐户'
    );
  }else{
    $Result = $db->query("SELECT * FROM `user` WHERE `id`='$id'");
    if($Result->num_rows > 0){
      $Res = $Result->fetch_array(MYSQLI_ASSOC);
      if(isset($_POST['password'], $_POST['email'], $_POST['status'])){
        $Res['pass'] = empty($_POST['password']) ? $Res['pass'] : $db->real_escape_string($_POST['password']);
        $Res['email'] = empty($_POST['email']) ? $Res['email'] : $db->real_escape_string($_POST['email']);
        $Res['status'] = empty($_POST['status']) ? $Res['status'] : $db->real_escape_string($_POST['status']);
        if($db->query("UPDATE `user` SET `pass`='{$Res['pass']}', `email`='{$Res['email']}', `status`='{$Res['status']}' WHERE `id`='$id'")){
          $result = array(
            'status' => '1',
            'msg' => '修改成功'
          );
        }else{
          $result = array(
            'status' => '0',
            'msg' => '修改失败'
          );
        }
      }
      $SM->assign('Res', $Res);
    }else{
      $result = array(
        'status' => '2',
        'msg' => '用户不存在'
      );
    }
  }
}else{
  header("Location: ../user");
  exit;
}
isset($result) && $SM->assign('result', $result);
$SM->display('admin_user_edit.tpl');
