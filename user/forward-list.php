<?php
/**
 * 域名转发列表
**/
require './check_login.php';
$page['no'] = isset($_GET['page'])&&$_GET['page']>=1 ? (int)$_GET['page'] : 1; //第几页
$page['number'] = isset($_COOKIE['page_number']) ? (int)$_COOKIE['page_number'] : 20; //每页条数
$start_num = ($page['no']-1) * $page['number'];
if(isset($_GET['kw'])){
  $kw=daddslashes($_GET['kw']);
  $sql = " `uid`='{$USER['id']}' and `domain` LIKE '%{$kw}%'";
  $page['link'] = '&kw='.urlencode($kw);
}else{
  $sql = " `uid`='{$USER['id']}'";
}
$Result = $db->query($sqls = "SELECT * FROM `forward` WHERE{$sql} order by time desc LIMIT $start_num, {$page['number']}");
if($Result->num_rows > 0){
  $mode = array('显性转发', '隐性转发');
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
    'msg' => $page['no']==1?'你帐户上好像还没有域名哦':'你的域名好像没那么多'
  );
  $SM->assign('result', $result);
}
$SM->assign('config', $config);
$SM->display('user_forward_list.tpl');
