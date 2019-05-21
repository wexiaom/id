<?php
/**
 * 帐户激活
**/
require '../main.inc.php';
if($config['smtp']['type'] == 0){
  $result = array(
    'status' => '0',
    'msg' => '已关闭邮件发送，无法进行此操作'
  );
}elseif(isset($_POST['email'], $_POST['captcha'])){
  if(empty($_SESSION['digit']) || trim($_POST['captcha'])!=$_SESSION['digit']){
    $result = array(
      'status' => '0',
      'msg' => '验证码错误'
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
        'msg' => '未找到与该邮箱想关联的帐户'
      );
    }else{
      $Res = $Result->fetch_array(MYSQLI_ASSOC);
      $time = time();
      require ROOT.'/inc/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->CharSet = 'utf-8';
      //$mail->SMTPDebug = 3; //启用详细调试输出
      $mail->isSMTP(); //设置邮件使用SMTP
      $mail->Host = $config['smtp']['host']; 
      $mail->SMTPAuth = true; //启用SMTP认证
      $mail->Username = $config['smtp']['user'];
      $mail->Password = $config['smtp']['pass'];
      $mail->SMTPSecure = $config['smtp']['pass']?'ssl':'';
      $mail->Port = $config['smtp']['port'];
      $mail->From = $config['smtp']['from'];
      $mail->FromName = $config['smtp']['name'];
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = '密码重置确认';
      $replace = array(
        '{host}' => $_SERVER['HTTP_HOST'],
        '{email}' => $email,
        '{key}' => md5($md5=$Res['pass'].$Res['time'].$SAFE_KEY.$time),
        '{time}' => $time
      );
      $mail->Body    = strtr(file_get_contents(ROOT.'/templates/mail_password_reset.tpl'), $replace);
      $mail->AltBody = '此邮件需使用支持HTML显示的邮件客户端查看';
      if(!$mail->send()){
        $result = array(
          'status' => '0',
          'msg' => $mail->ErrorInfo
        );
      }else{
        $result = array(
          'status' => '1',
          'msg' => '密码重置邮件已发送至您的邮箱，请前往邮箱确认密码重置申请'
        );
      }
    }
  }
}elseif(isset($_GET['do']) && $_GET['do']=='confirm'){
  if(!isset($_GET['email'], $_GET['time'], $_GET['key'])){
    $result = array(
      'status' => '0',
      'msg' => '缺少参数'
    );
  }elseif(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
    $result = array(
      'status' => '0',
      'msg' => '邮箱地址无效'
    );
  }elseif(ceil((time()-$_GET['time'])/3600/24) > 7){
    $result = array(
      'status' => '0',
      'msg' => '链接已过期，请重新重置密码'
    );
  }else{
    $email = $db->real_escape_string($_GET['email']);
    if(!$Result = $db->query("SELECT * FROM `user` WHERE `email`='$email'")){
      $result = array(
        'status' => '0',
        'msg' => '系统错误'
      );
    }elseif($Result->num_rows < 1){
      $result = array(
        'status' => '0',
        'msg' => '未找到与该邮箱想关联的帐户'
      );
    }else{
      $Res = $Result->fetch_array(MYSQLI_ASSOC);
      if(md5($Res['pass'].$Res['time'].$SAFE_KEY.$_GET['time']) != $_GET['key']){
        $result = array(
          'status' => '0',
          'msg' => '验证失败'
        );
      }else{
        $newpassword = substr(md5(time().$Res['pass']), rand(0,23), 8);
        if($db->query("UPDATE `user` SET `pass`=md5('$newpassword') WHERE `id`={$Res['id']}")){
          require ROOT.'/inc/PHPMailerAutoload.php';
          $mail = new PHPMailer;
          $mail->CharSet = 'utf-8';
          //$mail->SMTPDebug = 3; //启用详细调试输出
          $mail->isSMTP(); //设置邮件使用SMTP
          $mail->Host = $config['smtp']['host']; 
          $mail->SMTPAuth = true; //启用SMTP认证
          $mail->Username = $config['smtp']['user'];
          $mail->Password = $config['smtp']['pass'];
          $mail->SMTPSecure = $config['smtp']['pass']?'ssl':'';
          $mail->Port = $config['smtp']['port'];
          $mail->From = $config['smtp']['from'];
          $mail->FromName = $config['smtp']['name'];
          $mail->addAddress($email);
          $mail->isHTML(true);
          $mail->Subject = '密码重置成功';
          $replace = array(
            '{host}' => $_SERVER['HTTP_HOST'],
            '{email}' => $email,
            '{uid}' => $Res['id'],
            '{password}' => $newpassword
          );
          $mail->Body    = strtr(file_get_contents(ROOT.'/templates/mail_password_reseted.tpl'), $replace);
          $mail->AltBody = '此邮件需使用支持HTML显示的邮件客户端查看';
          if(!$mail->send()){
            $result = array(
              'status' => '0',
              'msg' => $mail->ErrorInfo
            );
          }else{
            $result = array(
              'status' => '1',
              'msg' => '密码重置成功，新密码已发送至您的邮箱'
            );
          }
        }else{
          $result = array(
            'status' => '0',
            'msg' => '重置密码失败'
          );
        }
      }
    }
  }
}
isset($result) && $SM->assign('result', $result);
$SM->display('user_password_reset.tpl');