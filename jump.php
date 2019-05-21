<?php
/**
 * 域名转发文件
**/
if(!defined('author')){
  exit('<!-- '.md5($_SERVER['HTTP_HOST'].$_SERVER['DOCUMENT_ROOT']).' -->');
}elseif(!isset($_SERVER['HTTP_HOST'])){
  $msg = '获取当前域名失败';
}elseif(!preg_match('@^[a-zA-Z0-9-.]{6,}$@', $_SERVER['HTTP_HOST'])){
  $msg = '我们无法识别当前域名';
}elseif(!in_array($_SERVER['HTTP_HOST'], $config['home_domain'])){
  $http_host = $db->real_escape_string($_SERVER['HTTP_HOST']);
  $result = $db->query("SELECT * FROM `forward` WHERE `domain`='$http_host'");
  if($result->num_rows > 0){
    $res = $result->fetch_array(MYSQLI_ASSOC);
	if($config['audit']==1 && $res['status']==0){
		$msg = '该域名暂未通过审核';
	}else{
		//域名转发方式
		switch($res['mode']){
		  case '0':
			header('Location: '.$res['url']);
		  break;
		  case '1':
			$SM->assign('res', $res);
			$SM->display('frame.tpl');
		  break;
		}
		exit;
	}
  }else{
    $msg = '未找到域名转发记录';
  }
}
if(isset($msg)){
  $SM->assign('msg', $msg);
  $SM->display('error.tpl');
  exit;
}
