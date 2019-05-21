<?php
/**
 * 用户密码修改文件
**/
require './check_login.php';
if(isset($_GET['id'])){
  $id = (int)$_GET['id'];
  $Result = $db->query("SELECT * FROM `forward` WHERE `uid`='{$USER['id']}' AND `id`='$id'");
  if($Result->num_rows < 1){
    $result = array(
      'status' => '2',
      'msg' => '未找到该域名'
    );
  }else{
    $Res = $Result->fetch_array(MYSQLI_ASSOC);
  }

  if(!isset($result) && isset($_POST['mode'])){
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
          $url = $db->real_escape_string($_POST['url']);
          $mode = (int)$_POST['mode'];
          
          $Res['url'] = $url;
          $Res['mode'] = $mode;
          
          $sql = "UPDATE `forward` SET `url`='$url', `mode`='$mode' WHERE `id`='$id' AND `uid`='{$USER['id']}'";
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
          $url = $db->real_escape_string($_POST['url']);
          $mode = (int)$_POST['mode'];
          $title = $db->real_escape_string($_POST['title']);
          $keywords = $db->real_escape_string($_POST['keywords']);
          $description = $db->real_escape_string($_POST['description']);
          
          $Res['url'] = $url;
          $Res['mode'] = $mode;
          $Res['title'] = $title;
          $Res['keywords'] = $keywords;
          $Res['description'] = $description;
          
          $sql = "UPDATE `forward` SET `url`='$url', `mode`='$mode', `title`='$title', `keywords`='$keywords', `description`='$description' WHERE `id`='$id' AND `uid`='{$USER['id']}'";
        }
      break;
    }
    
    if(!isset($result)){
      if($db->query($sql)){
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
  }
}else{
  $result = array(
    'status' => '2',
    'msg' => '请选择要编辑的域名'
  );
}
isset($Res) && $SM->assign('Res', $Res);
isset($result) && $SM->assign('result', $result);
$SM->display('user_forward_edit.tpl');
