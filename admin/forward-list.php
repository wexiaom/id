<?php
/**
 * 域名转发列表
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  if($_GET['mod']=='change'){
    $id = (int)$_GET['id'];
	if($db->query("UPDATE `forward` SET `status`='1' WHERE `id`='$id'")){
       exit("<script language='javascript'>alert('修改成功！');history.go(-1);</script>");
    }else{
       exit("<script language='javascript'>alert('修改失败！');history.go(-1);</script>");
    }
  }
  $page['no'] = isset($_GET['page'])&&$_GET['page']>=1 ? (int)$_GET['page'] : 1; //第几页
  $page['number'] = isset($_COOKIE['page_number']) ? (int)$_COOKIE['page_number'] : 20; //每页条数
  $start_num = ($page['no']-1) * $page['number'];
  if(isset($_GET['uid'])){
    $uid = (int)$_GET['uid'];
    $sql = " `uid`='$uid'";
	$page['link'] = '&uid='.$uid;
  }elseif($_GET['mod']=='no'){
    $sql = " `status`='0'";
	$page['link'] = '&mod=no';
  }elseif($_GET['mod']=='yes'){
    $sql = " `status`='1'";
	$page['link'] = '&mod=yes';
  }elseif(isset($_GET['kw'])){
	$kw=daddslashes($_GET['kw']);
    $sql = " `domain` LIKE '%{$kw}%'";
	$page['link'] = '&kw='.urlencode($kw);
  }else{
	$sql = " 1";
  }
  $sqls = "SELECT * FROM `forward` WHERE{$sql} order by time desc LIMIT $start_num, {$page['number']}";
  $Result = $db->query($sqls);
  if($Result->num_rows > 0){
    $mode = array('显性转发', '隐性转发', '页面停放');
    while($Res = $Result->fetch_array(MYSQLI_ASSOC)){
      $Res['mode'] = $mode[$Res['mode']];
      $Res['time'] = date('Y-m-d', $Res['time']);
      $rows[] = $Res;
    }
    $SM->assign('rows', $rows);
    $page['rows'] = $db->query("SELECT `id` FROM `forward` WHERE{$sql}")->num_rows; //总条数
    $page['pages'] = ceil($page['rows']/$page['number']<1?1:$page['rows']/$page['number']); //总页数
    $SM->assign('page', $page);
  }else{
    $result = array(
      'status' => '0',
      'msg' => $page['no']==1?'暂无域名转发记录':'好像没那么多'
    );
    $SM->assign('result', $result);
  }
}else{
  header("Location: ../user/");
  exit;
}
$SM->assign('config', $config);
$SM->display('admin_forward_list.tpl');
