<?php
/**
 * 邮件发送类
**/
class phpmailer{
  var $error = null;
  var $mail = null;
  function  __construct($host, $user, $pass, $port=25, $secure=''){
    require ROOT.'/inc/PHPMailerAutoload.php';
    $this->mail = new PHPMailer;
    $this->mail->isSMTP(); //设置邮件使用SMTP
    $this->mail->Host = $host;
    $this->mail->SMTPAuth = true; //启用SMTP认证
    $this->mail->Username = $user;
    $this->mail->Password = $pass;
    $this->mail->SMTPSecure = $secure;
    $this->mail->Port = $port;
  }
  function Form($email, $name=''){
    $this->mail->From = $email;
    $this->mail->FromName = $name;
  }
  function To($email){
    $this->mail->addAddress($email);
  }
  function Body($title, $name, $replace=array()){
    $this->mail->isHTML(true);
    $this->mail->Subject = $title;
    $this->mail->Body    = strtr(file_get_contents(ROOT.'/templates/'.$name), $replace);
    $this->mail->AltBody = '此邮件需使用支持HTML显示的邮件客户端查看';
  }
  function Send(){
    if(!$mail->send()){
      $this->error = $mail->ErrorInfo;
      return false;
    }else{
      return true;
    }
  }
}