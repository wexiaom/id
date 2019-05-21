<?php
/**
 * 用户注册
**/
require './main.inc.php';
if(!$config['register_switch']){
  $SM->assign('msg', '抱歉，本站已暂时关闭注册');
  $SM->display('error.tpl');
  exit;
}
if(isset($_POST['email'], $_POST['pass'], $_POST['captcha'])){
  if(empty($_SESSION['digit']) || trim($_POST['captcha'])!=$_SESSION['digit']){
    $result = array(
      'status' => 0,
      'msg' => '验证码不正确'
    );
  }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $result = array(
      'status' => 0,
      'msg' => '邮箱地址无效'
    );
  }elseif(strlen($_POST['pass']) < 6){
    $result = array(
      'status' => 0,
      'msg' => '密码长度小于6'
    );
  }elseif(strlen($_POST['pass']) > 16){
    $result = array(
      'status' => 0,
      'msg' => '密码长度大于16'
    );
  }else{
    $email = $db->real_escape_string($_POST['email']);
    $pass = md5($_POST['pass']);
    $time = time();
    $status = $config['smtp']['type']==0 ? 1 : 0;
    if($db->query("SELECT `email` FROM `user` WHERE `email`='$email'")->num_rows > 0){
      $result = array(
        'status' => 0,
        'msg' => '邮箱 '.htmlentities($_POST['email']).' 已注册'
      );
    }elseif($db->query("INSERT INTO `user`(`id`, `email`, `pass`, `time`, `status`) VALUES (null, '$email', '$pass', $time, $status)")){
      $result = array(
        'status' => 1,
        'msg' => '注册成功'
      );
      if($config['smtp']['type']!=0){
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
          '{uid}' => $db->insert_id,
          '{email}' => $email,
          '{password}' => htmlentities($_POST['pass']),
          '{key}' => md5($db->insert_id.$time.$SAFE_KEY)
        );
        $mail->Body    = strtr(file_get_contents(ROOT.'/templates/mail_activation.tpl'), $replace);
        $mail->AltBody = '此邮件需使用支持HTML显示的邮件客户端查看';
        if(!$mail->send()){
          $result['mail'] = array(
            'status' => '0',
            'msg' => $mail->ErrorInfo
          );
        }else{
          $result['mail'] = array(
            'status' => '1',
            'msg' => '注册确认邮件已发送至您的邮箱，请点击邮件内的激活链接激活您的帐户'
          );
        }
      }else{
        $result['mail'] = array(
          'status' => '0',
          'msg' => '已关闭邮件发送'
        );
      }
    }else{
      $result = array(
        'status' => 0,
        'msg' => '注册失败'
      );
    }
  }
  $SM->assign('result', $result);
}
$SM->display('register.tpl');
unset($_SESSION['digit']);
