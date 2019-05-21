<?php
/**
 * 自定义函数
**/
function read_config($path){
  
}
function title($title, $text=null){
echo <<<HTML_TEXT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>{$title}</title>
  <meta name="keywords" content="零零网,零零工具,在线工具,网站工具,站长工具"/>
  <meta name="description" content="本站主要为站长及程序员提供一些便利的实用工具，方便网站建设和数据处理。网页源代码查看、HTML练习、whois查询、域名编码解码、字符编码解码、免费VPN申请等。"/>
  <link href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>
  <!--link href="http://127.0.0.1/css/bootstrap.min.css" rel="stylesheet"/-->
  <script src="http://libs.useso.com/js/jquery/2.1.1-rc2/jquery.min.js"></script>
  <script src="http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <!--script src="http://127.0.0.1/js/jquery.min.js"></script-->
  <!--script src="http://127.0.0.1/js//bootstrap.min.js"></script-->
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  {$text}
</head>
<body>

HTML_TEXT;
}

function footer(){
}

function daddslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}