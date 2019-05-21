<?php
/**
 * 帐户激活
**/
require '../main.inc.php';
if(isset($_GET['uid'], $_GET['key'])){
  $id = (int)$_GET['uid'];
  if(!$Result = $db->query("SELECT * FROM `user` WHERE `id`=$id")){
    $result = array(
      'status' => '0',
      'msg' => '系统错误'
    );
  }elseif($Result->num_rows < 1){
    $result = array(
      'status' => '0',
      'msg' => '该帐户尚未注册'
    );
  }else{
    $Res = $Result->fetch_array(MYSQLI_ASSOC);
    if($Res['status'] != '0'){
      $result = array(
        'status' => '0',
        'msg' => '该帐户已被激活'
      );
    }elseif(md5($Res['id'].$Res['time'].$SAFE_KEY) != $_GET['key']){
      $result = array(
        'status' => '0',
        'msg' => '验证失败'
      );
    }elseif(!$db->query("UPDATE `user` SET `status`=1 WHERE `id`=$id")){
      $result = array(
        'status' => '0',
        'msg' => '帐户激活失败'
      );
    }else{
      $result = array(
        'status' => '1',
        'msg' => '帐户激活成功'
      );
    }
  }
}elseif(isset($_POST['email'])){
  if($config['smtp']['type'] == 0){
    $result = array(
      'status' => '0',
      'msg' => '已关闭邮件发送，无法进行此操作'
    );
  }elseif(empty($_SESSION['digit']) || trim($_POST['captcha'])!=$_SESSION['digit']){
    $result = array(
      'status' => '0',
      'msg' => '验证码不正确'
    );
  }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $result = array(
      'status' => '0',
      'msg' => '邮箱地址无效'
    );
  }else{
    $email = $db->real_escape_string($_POST['email']);
    if(!$Result = $db->query("SELECT * FROM `user` WHERE `email`='$email'")){
      $result = array(
        'status' => '0',
        'msg' => '系统错误'
      );
    }elseif($Result->num_rows < 1){
      $result = array(
        'status' => '0',
        'msg' => '该帐户尚未注册'
      );
    }else{
      $Res = $Result->fetch_array(MYSQLI_ASSOC);
      if($Res['status'] != '0'){
        $result = array(
          'status' => '0',
          'msg' => '该帐户已被激活'
        );
      }else{
        require ROOT.'/inc/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        //$mail->SMTPDebug = 3; //启用详细调试输出
        $mail->isSMTP(); //设置邮件使用SMTP
        $mail->Host = $config['smtp']['host']; 
        $mail->SMTPAuth = true; //启用SMTP认证
        $mail->Username = $config['smtp']['user'];
        $mail->Password = $config['smtp']['pass'];
        $mail->SMTPSecure = $config['smtp']['ssl']?'ssl':false;
        $mail->Port = $config['smtp']['port'];
        $mail->From = $config['smtp']['from'];
        $mail->FromName = $config['smtp']['name'];
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = '帐户注册确认邮件';
        $replace = array(
          '{host}' => $_SERVER['HTTP_HOST'],
          '{uid}' => $Res['id'],
          '{email}' => $email,
          '{password}' => '*重发注册邮件不显示',
          '{key}' => md5($Res['id'].$Res['time'].$SAFE_KEY)
        );
        $mail->Body    = strtr(file_get_contents(ROOT.'/templates/mail_activation.tpl'), $replace);
        $mail->AltBody = '此邮件需使用支持HTML显示的邮件客户端查看';
        if(!$mail->send()){
          $result = array(
            'status' => '0',
            'msg' => $mail->ErrorInfo
          );
        }else{
          $result = array(
            'status' => '1',
            'msg' => '注册确认邮件已重发至您的邮箱，请点击邮件内的激活链接激活您的帐户'
          );
        }
      }
    }
  }
}else{
  $result = array(
    'status' => '0',
    'msg' => '缺少必要参数'
  );
}
$SM->assign('result', $result);
$SM->display('user_active.tpl');
unset($_SESSION['digit']);