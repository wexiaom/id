<?php
/**
 * 用户登陆
**/
require '../main.inc.php';
if(isset($_POST['email'], $_POST['pass'])){
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $result = array(
      'status' => 0,
      'msg' => '邮箱地址无效'
    );
  }else{
    $email = $db->real_escape_string($_POST['email']);
    if(!$Result = $db->query("SELECT * FROM `user` WHERE `email`='$email'")){
      $result = array(
        'status' => 0,
        'msg' => '登陆失败<br/>Error:'.$db->error
      );
    }elseif($Result->num_rows < 1){
      $result = array(
        'status' => 0,
        'msg' => '该邮箱还未注册'
      );
    }else{
      $Res = $Result->fetch_array(MYSQLI_ASSOC);
      if($Res['pass']!=md5($_POST['pass'])){
        $result = array(
          'status' => 0,
          'msg' => '密码错误'
        );
      }elseif($Res['status'] != '1'){
        $result = array(
          'status' => 0,
          'msg' => null
        );
        switch($Res['status']){
          case '0':
            $result['msg'] = '您的帐户尚未激活';
          break;
          case '2':
            $result['msg'] = '您的帐户已被封禁';
          break;
          default:
            $result['msg'] = '未知帐户状态';
        }
      }else{
        setcookie('user_id', $Res['id'], time()+3600*24*15, '/', null);
        setcookie('user_key', md5($email.$Res['time'].$Res['pass']), time()+3600*24*15, '/', null, false, true);
        $result = array(
          'status' => '1',
          'msg' => '登陆成功'
        );
      }
    }
  }
}elseif(isset($_GET['logout'])){
  setcookie('user_id', null, time()+3600, '/');
  setcookie('user_key', null, time()-3600, '/');
  $result = array(
    'status' => '0',
    'msg' => '您已成功注销本次登陆'
  );
}
isset($result) && $SM->assign('result', $result);
$SM->display('login.tpl');
unset($_SESSION['digit']);
