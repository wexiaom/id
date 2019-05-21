<?php
/**
 * 全局引用文件
**/
// 开启Session会话
session_start();

// 定义时区
date_default_timezone_set('Asia/Shanghai');

// 程序常量
define('ROOT', dirname(__FILE__));
define('author', 'jwj');

// 错误日志
//ini_set("display_errors", 'off');
error_reporting(0);
//ini_set('error_log',ROOT.'/error.log');

require ROOT.'/security.php';

// 配置信息
if(file_exists(ROOT.'/config.php') && file_exists(ROOT.'/config.ser.php')){
  require ROOT.'/config.php';
  $config = unserialize(substr(file_get_contents(ROOT.'/config.ser.php'),14));
  $db = new mysqli($db_conf['host'], $db_conf['user'], $db_conf['pass'], $db_conf['name'], $db_conf['port']);
  $db->connect_errno && die('MySQL Connect Error('.$db->connect_errno.'):'.$db->connect_error);
  $db->query("set names 'utf8'");
}else{
  header('Content-type:text/html;charset=utf-8');
  echo '你还没安装！<a href="./install/">点此安装</a>';
  exit();
}

// 文件引用
if($config['txprotect']==1)require ROOT.'/txprotect.php';
require ROOT.'/inc/function.php';
require ROOT.'/libs/Smarty.class.php';
require ROOT.'/Smarty_init.php';
require ROOT.'/jump.php';
