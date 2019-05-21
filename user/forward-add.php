<?php
/**
 * 域名添加文件
**/
require './check_login.php';
require ROOT.'/inc/idna_convert.class.php';
if(!$config['domain_add_switch']){
  $result = array(
    'status' => '0',
    'msg' => '域名添加已关闭'
  );
  $SM->assign('result', $result);
}elseif(isset($_POST['domain'], $_POST['mode'])){
  $idn = new idna_convert(array('idn_version'=>2008));
  $domain_en = $idn->encode(strtolower($_POST['domain']));
  if(!preg_match('@^[A-z0-9-.]{5,50}$@', $domain_en)){
    $result = array(
      'status' => '0',
      'msg' => '域名不合法'
    );
  }else{
    $result['status'] = false;
    switch($_POST['mode']){
      case '0':
        if(!isset($_POST['url'])){
          $result = array(
            'status' => '0',
            'msg' => '请输入要转发到的目标地址'
          );
        }elseif(!filter_var($_POST['url'], FILTER_VALIDATE_URL)){
          $result = array(
            'status' => '0',
            'msg' => '目标地址不合法'
          );
        }else{
          $result['status'] = true;
          $domain = $db->real_escape_string($domain_en);
          $url = $db->real_escape_string($_POST['url']);
          $mode = (int)$_POST['mode'];
          $sql = "INSERT INTO `forward` (`id`, `uid`, `domain`, `url`, `mode`, `time`) VALUES (null, {$USER['id']}, '$domain', '$url', '$mode', UNIX_TIMESTAMP())";
        }
      break;
      case '1':
        if(!isset($_POST['url'])){
          $result = array(
            'status' => '0',
            'msg' => '请输入要转发到的目标地址'
          );
        }elseif(!filter_var($_POST['url'], FILTER_VALIDATE_URL)){
          $result = array(
            'status' => '0',
            'msg' => '目标地址不合法'
          );
        }else{
          $result['status'] = true;
          $domain = $db->real_escape_string($domain_en);
          $url = $db->real_escape_string($_POST['url']);
          $mode = (int)$_POST['mode'];
          $title = $db->real_escape_string($_POST['title']);
          $keywords = $db->real_escape_string($_POST['keywords']);
          $description = $db->real_escape_string($_POST['description']);
          $sql = "INSERT INTO `forward` (`id`, `uid`, `domain`, `url`, `mode`, `title`, `keywords`, `description`, `time`) VALUES (null, {$USER['id']}, '$domain', '$url', '$mode', '$title', '$keywords', '$description', UNIX_TIMESTAMP())";
        }
      break;
    }
    
    if($result['status']===true && $db->query("SELECT `domain` FROM `forward` WHERE `domain`='$domain'")->num_rows>0){
      $result = array(
        'status' => '0',
        'msg' => '该域名已经被添加了'
      );
    }
    
    if($config['domain_add_check'] && $result['status']===true){
      $data = @file_get_contents('http://'.$domain_en.'/jump.php');
      if(!strstr($data, '<!-- '.md5($domain_en.$_SERVER['DOCUMENT_ROOT']).' -->')){
        $result = array(
          'status' => '0',
          'msg' => '检测失败，请检查您的域名是否已成功解析到我们的服务器'
        );
      }
    }
    
    if($result['status']===true){
      if(!$db->query($sql)){
        $result = array(
          'status' => '0',
          'msg' => '域名转发添加失败'
        );
      }else{
        $result = array(
          'status' => '1',
          'msg' => '域名转发添加成功'
        );
      }
    }
  }
  $SM->assign('result', $result);
}
$SM->display('user_forward_add.tpl');
